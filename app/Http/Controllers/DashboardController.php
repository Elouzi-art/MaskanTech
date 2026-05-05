<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Favorite;       // ✅ import manquant
use App\Models\Message;        // ✅ import manquant
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return match (Auth::user()->role) {
            'admin'  => $this->admin(),
            'agent'  => $this->agent(),
            default  => $this->client(),
        };
    }

    // ── ADMIN ─────────────────────────────────────────────────────────────

    private function admin()
    {
        $stats = [
            'total_properties'     => Property::count(),
            'total_users'          => User::count(),
            'rented_properties'    => Property::where('status', 'rented')->count(),
            'appointments_month'   => Appointment::whereMonth('created_at', now()->month)->count(),
            'pending_appointments' => Appointment::where('status', 'pending')->count(),
            'unread_messages'      => Message::where('is_read', false)->count(),
            'active_agents'        => User::where('role', 'agent')->count(),
            'new_this_month'       => Property::whereMonth('created_at', now()->month)->count(),
            'total_students'       => User::where('role', 'student')->count(),
            'total_owners'         => User::where('role', 'owner')->count(),
        ];

        $months      = collect(range(11, 0))->map(fn($m) => now()->subMonths($m));
        $chartLabels = $months->map(fn($d) => $d->translatedFormat('M'))->toArray();
        $chartData   = $months->map(fn($d) =>
            Property::whereYear('created_at', $d->year)
                    ->whereMonth('created_at', $d->month)
                    ->count()
        )->toArray();

        $recentActivity = Property::with('user')
            ->latest()
            ->limit(20)
            ->get()
            ->map(fn($p) => (object)[
                'type'   => $p->status === 'rented' ? 'loué' : 'nouveau',
                'title'  => $p->title,
                'sub'    => $p->city . ' — ' . $p->user->name,
                'date'   => $p->created_at->diffForHumans(),
                'status' => $p->status,
            ]);

        $activeAgents = User::where('role', 'agent')->limit(10)->get();
        $alerts       = collect();

        return view('dashboard.admin', compact(
            'stats', 'chartLabels', 'chartData', 'recentActivity', 'activeAgents', 'alerts'
        ));
    }

    // ── AGENT ─────────────────────────────────────────────────────────────

    private function agent()
    {
        $user = Auth::user();

        $myProperties = $user->properties()
            ->with('primaryImage')
            ->latest()
            ->paginate(10);

        // ✅ Fix : pas de scope "upcoming" — on utilise whereDate
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
            'favorites_count' => Favorite::whereIn('property_id', $user->properties()->pluck('id'))->count(),
            'unread_messages' => $user->receivedMessages()->where('is_read', false)->count(),
        ];

        return view('dashboard.agent', compact('myProperties', 'upcomingAppointments', 'stats'));
    }

    // ── CLIENT / STUDENT / OWNER ──────────────────────────────────────────

    private function client()
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

        return view('dashboard.client', compact('favorites', 'myAppointments', 'recentlyViewed', 'stats'));
    }
}
