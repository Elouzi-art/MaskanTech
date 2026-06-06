<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Message;
use App\Models\Property;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // L'admin a son propre panel séparé
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return match ($user->role) {
            'agent'   => $this->agent(),
            'owner'   => $this->owner(),
            'student' => $this->student(),
            default   => $this->tenant(),
        };
    }

    private function agent()
    {
        $user = Auth::user();

        $myProperties = $user->properties()
            ->with('primaryImage')
            ->latest()
            ->paginate(10);

        $upcomingAppointments = Appointment::where('agent_id', $user->id)
            ->whereDate('date', '>=', now()->toDateString())
            ->where('status', 'confirmed')
            ->with('property', 'client')
            ->orderBy('date')
            ->limit(5)
            ->get();

        $stats = [
            'my_properties'   => $user->properties()->count(),
            'total_views'     => $user->properties()->sum('views_count'),
            'appointments'    => Appointment::where('agent_id', $user->id)
                                    ->whereMonth('created_at', now()->month)->count(),
            'favorites_count' => DB::table('favorites')
                                    ->whereIn('property_id', $user->properties()->pluck('id'))
                                    ->count(),
            'unread_messages' => $user->receivedMessages()->where('is_read', false)->count(),
        ];

        return view('dashboard.agent', compact('myProperties', 'upcomingAppointments', 'stats'));
    }

    private function owner()
    {
        $user = Auth::user();

        $myProperties = $user->properties()
            ->with('primaryImage')
            ->latest()
            ->paginate(10);

        $upcomingAppointments = Appointment::whereHas('property', fn($q) =>
            $q->where('user_id', $user->id)
        )
        ->whereDate('date', '>=', now()->toDateString())
        ->with(['property', 'client'])
        ->orderBy('date')
        ->limit(5)
        ->get();

        $recentMessages = Message::where('receiver_id', $user->id)
            ->with(['sender', 'property'])
            ->latest()
            ->limit(5)
            ->get();

        $stats = [
            'my_properties'   => $user->properties()->count(),
            'total_views'     => $user->properties()->sum('views_count'),
            'appointments'    => Appointment::whereHas('property', fn($q) =>
                                    $q->where('user_id', $user->id))->count(),
            'unread_messages' => Message::where('receiver_id', $user->id)
                                    ->where('is_read', false)->count(),
        ];

        return view('dashboard.owner', compact(
            'myProperties', 'upcomingAppointments', 'recentMessages', 'stats'
        ));
    }

    private function student()
    {
        $user = Auth::user();

        $favorites = $user->favorites()
            ->with('primaryImage')
            ->latest('favorites.created_at')
            ->limit(6)
            ->get();

        $myAppointments = $user->appointmentsAsClient()
            ->with(['property', 'agent'])
            ->latest()
            ->limit(10)
            ->get();

        $viewedIds      = session('recently_viewed', []);
        $recentlyViewed = Property::whereIn('id', $viewedIds)
            ->get()
            ->sortBy(fn($p) => array_search($p->id, $viewedIds));

        $stats = [
            'favorites'    => $user->favorites()->count(),
            'appointments' => $user->appointmentsAsClient()->count(),
            'messages'     => $user->sentMessages()->count(),
            'viewed'       => count($viewedIds),
        ];

        return view('dashboard.student', compact(
            'favorites', 'myAppointments', 'recentlyViewed', 'stats'
        ));
    }

    private function tenant()
    {
        $user = Auth::user();

        $favorites = $user->favorites()
            ->with('primaryImage')
            ->latest('favorites.created_at')
            ->limit(6)
            ->get();

        $myAppointments = $user->appointmentsAsClient()
            ->with(['property', 'agent'])
            ->latest()
            ->limit(10)
            ->get();

        $viewedIds      = session('recently_viewed', []);
        $recentlyViewed = Property::whereIn('id', $viewedIds)
            ->get()
            ->sortBy(fn($p) => array_search($p->id, $viewedIds));

        $stats = [
            'favorites'    => $user->favorites()->count(),
            'appointments' => $user->appointmentsAsClient()->count(),
            'messages'     => $user->sentMessages()->count(),
            'viewed'       => count($viewedIds),
        ];

        return view('dashboard.tenant', compact(
            'favorites', 'myAppointments', 'recentlyViewed', 'stats'
        ));
    }
}