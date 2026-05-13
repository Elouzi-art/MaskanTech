<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Liste des rendez-vous selon le rôle.
     */
    public function index()
    {
        $user = Auth::user();

        $appointments = match ($user->role) {
            'admin' => Appointment::with(['property', 'client', 'agent'])->latest()->paginate(20),
            'agent' => Appointment::where('agent_id', $user->id)
                            ->with(['property', 'client'])
                            ->latest()->paginate(20),
            default => $user->appointmentsAsClient()->with(['property', 'agent'])->latest()->paginate(20),
        };

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Enregistre une demande de visite (client uniquement).
     */
    public function store(AppointmentRequest $request)
    {
        $property = Property::findOrFail($request->property_id);

        Appointment::create([
            'property_id' => $property->id,
            'client_id'   => Auth::id(),
            'agent_id'    => $property->user_id,
            'date'        => $request->date,
            'time'        => $request->time,
            'message'     => $request->message,
            'status'      => 'pending',
        ]);

        // TODO: dispatch AppointmentRequested event → email agent + client

        return back()->with('success', 'Votre demande de visite a été envoyée.');
    }

    /**
     * Changer le statut (agent/admin).
     */
    public function updateStatus(Request $request, Appointment $appointment)
    {
        $request->validate(['status' => 'required|in:confirmed,refused,completed']);

        $user = Auth::user();

        // Seul l'agent concerné ou un admin peut modifier
        if ($user->isClient() || ($user->isAgent() && $appointment->agent_id !== $user->id)) {
            abort(403);
        }

        $appointment->update(['status' => $request->status]);

        // TODO: dispatch AppointmentStatusChanged event → email client

        return back()->with('success', 'Statut du rendez-vous mis à jour.');
    }

    /**
     * Suppression (client peut annuler si status = pending).
     */
    public function destroy(Appointment $appointment)
    {
        $user = Auth::user();

        if ($user->isClient() && $appointment->client_id !== $user->id) abort(403);
        if ($user->isAgent() && $appointment->agent_id !== $user->id) abort(403);

        $appointment->delete();

        return back()->with('success', 'Rendez-vous annulé.');
    }
}
