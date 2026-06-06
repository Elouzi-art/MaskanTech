@extends('layouts.maskan')

@push('styles')
<style>
/* ═══════════════════════════════════════
   DASHBOARD WRAP
═══════════════════════════════════════ */
.dashboard-wrap {
    display: flex;
    min-height: calc(100vh - 73px);
}

/* ═══════════════════════════════════════
   SIDEBAR
═══════════════════════════════════════ */
.dash-sidebar {
    width: 250px; min-width: 250px;
    background: #fff;
    border-right: 1px solid #ede9e3;
    padding: 28px 0;
    position: sticky; top: 73px;
    height: calc(100vh - 73px);
    overflow-y: auto;
}

/* USER BLOCK */
.dash-user {
    padding: 0 20px 24px;
    border-bottom: 1px solid #f0ede8;
    margin-bottom: 8px;
    text-align: left;
}
.dash-avatar-wrap { margin-bottom: 12px; }
.dash-avatar-img {
    width: 64px; height: 64px; border-radius: 50%;
    object-fit: cover; border: 3px solid #f0ede8;
    transition: opacity 0.2s;
}
.dash-avatar-img:hover { opacity: 0.85; }
.dash-avatar-initials {
    width: 64px; height: 64px; border-radius: 50%;
    background: linear-gradient(135deg, #C8873A, #E8A855);
    display: flex; align-items: center; justify-content: center;
    font-size: 22px; font-weight: 700; color: #fff;
    border: 3px solid #f0ede8;
}
.dash-name { font-size: 15px; font-weight: 600; color: #1a1a1a; margin-bottom: 6px; }
.dash-role {
    display: inline-flex; align-items: center; gap: 5px;
    font-size: 11px; font-weight: 500;
    padding: 3px 10px; border-radius: 20px;
}
.dash-role-tenant  { background: #f0ede8; color: #666; }
.dash-role-student { background: #e6f1fb; color: #185FA5; }
.dash-role-owner   { background: #fdf6ee; color: #C8873A; }
.dash-role-agent   { background: #eaf3de; color: #27500A; }
.dash-role-admin   { background: #fff0f0; color: #dc3545; }

/* NAV */
.dash-nav { padding: 0 12px; }
.dash-nav-section {
    font-size: 10px; color: #aaa;
    letter-spacing: 2px; text-transform: uppercase;
    font-weight: 600; padding: 16px 8px 6px;
}
.dash-nav-link {
    display: flex; align-items: center; gap: 12px;
    padding: 10px 12px; border-radius: 8px;
    text-decoration: none; font-size: 13.5px;
    color: #555; font-weight: 400;
    transition: all 0.15s; margin-bottom: 1px;
    background: none; border: none; cursor: pointer;
    width: 100%; text-align: left; font-family: 'DM Sans', sans-serif;
}
.dash-nav-link:hover { background: #fdf6ee; color: #C8873A; }
.dash-nav-link.active { background: #fdf6ee; color: #C8873A; font-weight: 500; }
.dash-nav-icon {
    width: 20px; height: 20px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    color: #aaa; transition: color 0.15s;
}
.dash-nav-link:hover .dash-nav-icon,
.dash-nav-link.active .dash-nav-icon { color: #C8873A; }
.dash-nav-badge {
    margin-left: auto; background: #C8873A; color: #fff;
    font-size: 10px; font-weight: 600; padding: 2px 7px;
    border-radius: 10px;
}
.dash-nav-logout { color: #dc3545 !important; }
.dash-nav-logout:hover { background: #fff0f0 !important; color: #dc3545 !important; }
.dash-nav-logout .dash-nav-icon { color: #dc3545 !important; }

/* ═══════════════════════════════════════
   MAIN CONTENT
═══════════════════════════════════════ */
.dash-main { flex: 1; padding: 36px 40px; background: #f8f7f4; }
.dash-header { margin-bottom: 32px; }
.dash-title {
    font-family: 'Playfair Display', serif;
    font-size: 28px; font-weight: 700; color: #1a1a1a;
}
.dash-subtitle { font-size: 14px; color: #888; margin-top: 4px; }

/* STATS CARDS */
.dash-stats { display: grid; grid-template-columns: repeat(4,1fr); gap: 20px; margin-bottom: 32px; }
.dash-stat-card {
    background: #fff; border: 1px solid #ede9e3;
    border-radius: 12px; padding: 24px;
    transition: transform 0.2s;
}
.dash-stat-card:hover { transform: translateY(-3px); }
.dash-stat-icon {
    width: 44px; height: 44px; border-radius: 10px;
    background: #fdf6ee; display: flex; align-items: center;
    justify-content: center; font-size: 20px; margin-bottom: 14px;
}
.dash-stat-value {
    font-family: 'Playfair Display', serif;
    font-size: 26px; font-weight: 700; color: #1a1a1a;
}
.dash-stat-label { font-size: 13px; color: #888; margin-top: 4px; }
.dash-stat-change { font-size: 12px; color: #27500A; margin-top: 6px; }

/* SECTIONS */
.dash-section {
    background: #fff; border: 1px solid #ede9e3;
    border-radius: 12px; padding: 24px; margin-bottom: 24px;
}
.dash-section-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 20px; padding-bottom: 16px;
    border-bottom: 1px solid #f0ede8;
}
.dash-section-title {
    font-family: 'Playfair Display', serif;
    font-size: 18px; font-weight: 700; color: #1a1a1a;
}
.dash-section-link { font-size: 13px; color: #C8873A; text-decoration: none; font-weight: 500; }
.dash-section-link:hover { text-decoration: underline; }

/* TABLE */
.dash-table { width: 100%; border-collapse: collapse; }
.dash-table th {
    font-size: 11px; color: #888; letter-spacing: 1.5px;
    text-transform: uppercase; font-weight: 500;
    padding: 10px 16px; text-align: left;
    border-bottom: 1px solid #f0ede8;
}
.dash-table td {
    padding: 14px 16px; font-size: 14px; color: #555;
    border-bottom: 1px solid #f8f7f4;
}
.dash-table tr:last-child td { border-bottom: none; }
.dash-table tr:hover td { background: #fafaf8; }

/* EMPTY STATE */
.dash-empty { text-align: center; padding: 48px 20px; color: #888; font-size: 14px; }
.dash-empty-icon { font-size: 48px; margin-bottom: 16px; }
.dash-empty-text { margin-bottom: 20px; }
</style>
@endpush

@section('content')
<div class="dashboard-wrap">

    {{-- ══════════════════════════════════════
         SIDEBAR
    ══════════════════════════════════════ --}}
    <div class="dash-sidebar">

        {{-- AVATAR + NOM + BADGE --}}
        <div class="dash-user">
            <div class="dash-avatar-wrap">
                <a href="{{ route('profile.edit') }}" style="text-decoration:none;">
                    @if(auth()->user()->avatar)
                        <img class="dash-avatar-img"
                             src="{{ Storage::url(auth()->user()->avatar) }}"
                             alt="{{ auth()->user()->name }}">
                    @else
                        <div class="dash-avatar-initials">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                    @endif
                </a>
            </div>

            <div class="dash-name">{{ auth()->user()->name }}</div>

            @if(auth()->user()->role === 'admin')
                <span class="dash-role dash-role-admin">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    Admin
                </span>
            @elseif(auth()->user()->role === 'owner')
                <span class="dash-role dash-role-owner">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/></svg>
                    Propriétaire
                </span>
            @elseif(auth()->user()->role === 'agent')
                <span class="dash-role dash-role-agent">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Agent
                </span>
            @elseif(auth()->user()->role === 'student')
                <span class="dash-role dash-role-student">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                    Étudiant
                </span>
            @else
                <span class="dash-role dash-role-tenant">
                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    Locataire
                </span>
            @endif
        </div>

        {{-- NAV --}}
        <div class="dash-nav">

            <div class="dash-nav-section">Principal</div>

            <a href="{{ route('dashboard') }}"
               class="dash-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <span class="dash-nav-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                </span>
                Tableau de bord
            </a>

            <a href="{{ route('properties.index') }}"
               class="dash-nav-link {{ request()->routeIs('properties.index') ? 'active' : '' }}">
                <span class="dash-nav-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/></svg>
                </span>
                Rechercher un logement
            </a>

            @if(in_array(auth()->user()->role, ['tenant', 'student']))
                <div class="dash-nav-section">Mon espace</div>

                <a href="{{ route('favorites.index') }}"
                   class="dash-nav-link {{ request()->routeIs('favorites.*') ? 'active' : '' }}">
                    <span class="dash-nav-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                    </span>
                    Mes favoris
                </a>

                <a href="{{ route('appointments.index') }}"
                   class="dash-nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
                    <span class="dash-nav-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    </span>
                    Mes rendez-vous
                </a>

                <a href="{{ route('messages.index') }}"
                   class="dash-nav-link {{ request()->routeIs('messages.*') ? 'active' : '' }}">
                    <span class="dash-nav-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                    </span>
                    Messages
                    @if(auth()->user()->unread_messages_count > 0)
                        <span class="dash-nav-badge">{{ auth()->user()->unread_messages_count }}</span>
                    @endif
                </a>
            @endif

            @if(in_array(auth()->user()->role, ['owner', 'agent', 'admin']))
                <div class="dash-nav-section">Mes annonces</div>

                <a href="{{ route('favorites.index') }}"
                   class="dash-nav-link {{ request()->routeIs('favorites.*') ? 'active' : '' }}">
                    <span class="dash-nav-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                    </span>
                    Mes favoris
                </a>

                <a href="{{ route('properties.index', ['my' => 1]) }}"
                   class="dash-nav-link">
                    <span class="dash-nav-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/><path d="M9 21V12h6v9"/></svg>
                    </span>
                    Mes annonces
                </a>

                <a href="{{ route('properties.create') }}"
                   class="dash-nav-link {{ request()->routeIs('properties.create','properties.edit') ? 'active' : '' }}">
                    <span class="dash-nav-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v8M8 12h8"/></svg>
                    </span>
                    Publier une annonce
                </a>

                <a href="{{ route('appointments.index') }}"
                   class="dash-nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
                    <span class="dash-nav-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    </span>
                    Rendez-vous reçus
                </a>

                <a href="{{ route('messages.index') }}"
                   class="dash-nav-link {{ request()->routeIs('messages.*') ? 'active' : '' }}">
                    <span class="dash-nav-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                    </span>
                    Messages
                    @if(auth()->user()->unread_messages_count > 0)
                        <span class="dash-nav-badge">{{ auth()->user()->unread_messages_count }}</span>
                    @endif
                </a>
            @endif

            @if(auth()->user()->isAdmin())
                <div class="dash-nav-section">Administration</div>

                <a href="{{ route('admin.users') }}"
                   class="dash-nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                    <span class="dash-nav-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                    </span>
                    Utilisateurs
                </a>

                <a href="{{ route('admin.properties') }}"
                   class="dash-nav-link {{ request()->routeIs('admin.properties*') ? 'active' : '' }}">
                    <span class="dash-nav-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/></svg>
                    </span>
                    Toutes les annonces
                </a>

                <a href="{{ route('admin.contacts') }}"
                   class="dash-nav-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}">
                    <span class="dash-nav-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </span>
                    Messages de contact
                </a>
            @endif

            <div class="dash-nav-section">Compte</div>

            <a href="{{ route('profile.edit') }}"
               class="dash-nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                <span class="dash-nav-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </span>
                Mon profil
            </a>

            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="dash-nav-link dash-nav-logout">
                    <span class="dash-nav-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/></svg>
                    </span>
                    Déconnexion
                </button>
            </form>

        </div>
    </div>

    {{-- CONTENU PRINCIPAL --}}
    <div class="dash-main">
        @yield('dashboard-content')
    </div>

</div>
@endsection