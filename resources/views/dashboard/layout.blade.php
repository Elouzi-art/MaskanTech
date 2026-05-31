@extends('layouts.maskan')

@section('styles')
/* DASHBOARD WRAP */
.dashboard-wrap {
    display: flex;
    min-height: calc(100vh - 73px);
}

/* SIDEBAR */
.dash-sidebar {
    width: 260px; min-width: 260px;
    background: #1a1a1a;
    padding: 32px 0;
    position: sticky; top: 73px;
    height: calc(100vh - 73px);
    overflow-y: auto;
}
.dash-user {
    padding: 0 24px 28px;
    border-bottom: 1px solid rgba(255,255,255,0.07);
    margin-bottom: 24px;
}
.dash-avatar {
    width: 52px; height: 52px; border-radius: 50%;
    background: linear-gradient(135deg, #C8873A, #E8A855);
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; font-weight: 700; color: #fff;
    margin-bottom: 12px;
}
.dash-name { font-size: 15px; font-weight: 500; color: #fff; }
.dash-role {
    display: inline-block; font-size: 11px; font-weight: 500;
    padding: 3px 10px; border-radius: 20px; margin-top: 6px;
}
.dash-role-tenant { background: rgba(255,255,255,0.1); color: rgba(255,255,255,0.6); }
.dash-role-student { background: rgba(24,95,165,0.3); color: #7ab3e0; }
.dash-role-owner { background: rgba(200,135,58,0.3); color: #E8A855; }
.dash-role-admin { background: rgba(220,50,50,0.3); color: #ff8080; }

/* NAV LINKS */
.dash-nav { padding: 0 12px; }
.dash-nav-section {
    font-size: 10px; color: rgba(255,255,255,0.3);
    letter-spacing: 2px; text-transform: uppercase;
    padding: 0 12px; margin-bottom: 8px; margin-top: 20px;
}
.dash-nav-link {
    display: flex; align-items: center; gap: 12px;
    padding: 11px 12px; border-radius: 8px;
    text-decoration: none; font-size: 14px; color: rgba(255,255,255,0.6);
    transition: all 0.2s; margin-bottom: 2px;
}
.dash-nav-link:hover { background: rgba(255,255,255,0.07); color: #fff; }
.dash-nav-link.active { background: rgba(200,135,58,0.2); color: #E8A855; }
.dash-nav-icon { font-size: 18px; width: 20px; text-align: center; }
.dash-nav-badge {
    margin-left: auto; background: #C8873A; color: #fff;
    font-size: 11px; font-weight: 600; padding: 2px 7px;
    border-radius: 10px;
}

/* MAIN */
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
.dash-section-link {
    font-size: 13px; color: #C8873A; text-decoration: none; font-weight: 500;
}
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
.dash-empty {
    text-align: center; padding: 48px 20px;
    color: #888; font-size: 14px;
}
.dash-empty-icon { font-size: 48px; margin-bottom: 16px; }
.dash-empty-text { margin-bottom: 20px; }
@endsection

@section('content')
<div class="dashboard-wrap">

    {{-- SIDEBAR --}}
    <div class="dash-sidebar">
        <div class="dash-user">
            <div class="dash-avatar">
                {{ auth()->check() ? strtoupper(substr(auth()->user()->name, 0, 2)) : 'U' }}
            </div>
            <div class="dash-name">
                {{ auth()->check() ? auth()->user()->name : 'Utilisateur' }}
            </div>
            @auth
                @if(auth()->user()->role === 'admin')
                    <span class="dash-role dash-role-admin">👑 Admin</span>
                @elseif(auth()->user()->role === 'owner')
                    <span class="dash-role dash-role-owner">🏠 Propriétaire</span>
                @elseif(auth()->user()->role === 'student')
                    <span class="dash-role dash-role-student">🎓 Étudiant</span>
                @else
                    <span class="dash-role dash-role-tenant">👤 Locataire</span>
                @endif
            @endauth
        </div>

        <div class="dash-nav">
            {{-- COMMUN À TOUS --}}
            <div class="dash-nav-section">Principal</div>
            {{-- COMMUN À TOUS --}}
<a href="/dashboard" class="dash-nav-link active">
    <span class="dash-nav-icon">🏠</span> Tableau de bord
</a>
<a href="/biens" class="dash-nav-link">
    <span class="dash-nav-icon">🔍</span> Rechercher
</a>
<a href="#" class="dash-nav-link">
    <span class="dash-nav-icon">❤️</span> Mes favoris
</a>

<a href="/messages" class="dash-nav-link">
    <span class="dash-nav-icon">💬</span> Messages
    <span class="dash-nav-badge">3</span>
</a>
<a href="/rendez-vous" class="dash-nav-link">
    <span class="dash-nav-icon">📅</span> Rendez-vous
</a>

{{-- PROPRIÉTAIRE --}}
<a href="#" class="dash-nav-link">
    <span class="dash-nav-icon">📋</span> Mes annonces
</a>
<a href="{{ route('properties.create') }}" class="dash-nav-link">
    <span class="dash-nav-icon">➕</span> Publier une annonce
</a>
<a href="#" class="dash-nav-link">
    <span class="dash-nav-icon">📊</span> Statistiques
</a>

{{-- ADMIN --}}
<a href="/admin" class="dash-nav-link">
    <span class="dash-nav-icon">👥</span> Utilisateurs
</a>
<a href="/biens" class="dash-nav-link">
    <span class="dash-nav-icon">🏘️</span> Toutes les annonces
</a>
<a href="#" class="dash-nav-link">
    <span class="dash-nav-icon">⚠️</span> Signalements
</a>

<a href="#" class="dash-nav-link">
    <span class="dash-nav-icon">⚙️</span> Paramètres
</a>
<form action="{{ route('logout') }}" method="POST" style="margin:0;">
    @csrf
    <button type="submit" class="dash-nav-link" style="color:#ff6b6b;width:100%;border:none;background:none;cursor:pointer;text-align:left;">
        <span class="dash-nav-icon">🚪</span> Déconnexion
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