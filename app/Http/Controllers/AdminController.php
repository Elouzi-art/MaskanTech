<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // ── Dashboard ─────────────────────────────────────────────────────────

    public function dashboard()
    {
        $stats = [
            'users'      => User::count(),
            'properties' => Property::count(),
            'pending'    => Property::where('approval_status', 'pending')->count(),
            'owners'     => User::where('role', 'owner')->count(),
            'unverified' => User::where('role', 'owner')->where('is_verified', false)->count(),
            'contacts'   => Contact::where('is_read', false)->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    // ── Utilisateurs ──────────────────────────────────────────────────────

    public function users(Request $request)
    {
        $users = User::when($request->role, fn($q, $v) => $q->where('role', $v))
                     ->when($request->search, fn($q, $v) =>
                         $q->where(fn($s) =>
                             $s->where('name', 'like', "%$v%")
                               ->orWhere('email', 'like', "%$v%")
                         )
                     )
                     ->latest()
                     ->paginate(20);

        return view('admin.users', compact('users'));
    }

    public function showUser(User $user)
    {
        $user->load('properties');
        return view('admin.user-detail', compact('user'));
    }

    public function verifyOwner(User $user)
    {
        abort_if($user->role !== 'owner', 403, 'Cet utilisateur n\'est pas un propriétaire.');

        $user->update([
            'is_verified' => true,
            'verified_at' => now(),
        ]);

        return back()->with('success', "Propriétaire {$user->name} vérifié avec succès.");
    }

    public function unverifyOwner(User $user)
    {
        abort_if($user->role !== 'owner', 403);

        $user->update(['is_verified' => false, 'verified_at' => null]);

        return back()->with('success', 'Vérification retirée.');
    }

    public function destroyUser(User $user)
    {
        abort_if($user->id === auth()->id(), 403, 'Impossible de vous supprimer vous-même.');

        $user->delete();

        return back()->with('success', 'Utilisateur supprimé.');
    }

    // ── Annonces ──────────────────────────────────────────────────────────

    public function properties(Request $request)
    {
        $properties = Property::with('user')
            ->when($request->status, fn($q, $v) => $q->where('approval_status', $v))
            ->latest()
            ->paginate(20);

        return view('admin.properties', compact('properties'));
    }

    public function approveProperty(Property $property)
    {
        $property->update([
            'approval_status'  => 'approved',
            'rejection_reason' => null,
        ]);

        return back()->with('success', 'Annonce approuvée et publiée.');
    }

    public function rejectProperty(Request $request, Property $property)
    {
        $request->validate(['reason' => 'nullable|string|max:500']);

        $property->update([
            'approval_status'  => 'rejected',
            'rejection_reason' => $request->reason,
        ]);

        return back()->with('success', 'Annonce rejetée.');
    }

    public function destroyProperty(Property $property)
    {
        $property->delete();

        return back()->with('success', 'Annonce supprimée.');
    }

    // ── Messages de contact ───────────────────────────────────────────────

    public function contacts()
    {
        $contacts = Contact::latest()->paginate(20);

        // Marquer comme lus uniquement les messages affichés sur cette page
        $contacts->getCollection()
                 ->where('is_read', false)
                 ->each(fn($c) => $c->update(['is_read' => true]));

        return view('admin.contacts', compact('contacts'));
    }
}