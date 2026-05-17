<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Administration — MaskanTech')</title>

    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><rect width='32' height='32' rx='7' fill='%23C8873A'/><path d='M6 14L16 7l10 7v10a1 1 0 01-1 1H7a1 1 0 01-1-1V14z' fill='none' stroke='white' stroke-width='2.2'/><path d='M13 22v-6h6v6' fill='none' stroke='white' stroke-width='2.2'/></svg>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --sidebar-bg:  #2D1B4E;
            --sidebar-w:   260px;
            --gold:        #C8873A;
            --gold-light:  #E8A855;
            --content-bg:  #f8f7f4;
            --white:       #ffffff;
            --dark:        #1a1a1a;
            --font-display:'Playfair Display', Georgia, serif;
            --font-body:   'DM Sans', -apple-system, sans-serif;
            --radius-md:   8px;
            --radius-lg:   12px;
            --shadow:      0 4px 24px rgba(0,0,0,0.08);
        }
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: var(--font-body);
            background: var(--content-bg);
            color: var(--dark);
            display: flex;
            min-height: 100vh;
        }

        /* ═══ SIDEBAR ═══ */
        .adm-sidebar {
            width: var(--sidebar-w);
            min-width: var(--sidebar-w);
            background: var(--sidebar-bg);
            min-height: 100vh;
            position: fixed;
            top: 0; left: 0;
            display: flex; flex-direction: column;
            z-index: 50;
            overflow-y: auto;
        }

        /* Logo */
        .adm-logo {
            padding: 24px 20px 20px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .adm-logo-text {
            font-family: var(--font-display);
            font-size: 19px; font-weight: 700; color: var(--white);
            letter-spacing: -0.2px;
        }
        .adm-logo-text span { color: var(--gold); }
        .adm-logo-badge {
            display: inline-block;
            margin-top: 4px;
            font-size: 9px; font-weight: 600;
            letter-spacing: 2px; text-transform: uppercase;
            padding: 2px 8px; border-radius: 10px;
            background: rgba(220,53,69,0.25); color: #ff8080;
        }

        /* Nav */
        .adm-nav { flex: 1; padding: 16px 12px; }
        .adm-nav-section {
            font-size: 9px; color: rgba(255,255,255,0.28);
            letter-spacing: 2.5px; text-transform: uppercase;
            padding: 0 10px; margin: 18px 0 6px;
        }
        .adm-nav-link {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; border-radius: var(--radius-md);
            text-decoration: none; font-size: 13px;
            color: rgba(255,255,255,0.55);
            transition: all 0.2s; margin-bottom: 2px;
        }
        .adm-nav-link:hover { background: rgba(255,255,255,0.08); color: var(--white); }
        .adm-nav-link.active {
            background: rgba(200,135,58,0.2);
            color: var(--gold-light);
        }
        .adm-nav-icon { font-size: 16px; width: 18px; text-align: center; flex-shrink: 0; }
        .adm-nav-badge {
            margin-left: auto;
            background: var(--gold); color: var(--white);
            font-size: 10px; font-weight: 600;
            padding: 1px 7px; border-radius: 10px;
        }

        /* Bottom logout */
        .adm-sidebar-footer {
            padding: 12px;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .adm-sidebar-footer form button {
            display: flex; align-items: center; gap: 10px;
            width: 100%; padding: 10px 12px;
            border-radius: var(--radius-md);
            font-size: 13px; color: rgba(255,100,100,0.8);
            border: none; background: none; cursor: pointer;
            transition: all 0.2s; font-family: var(--font-body);
        }
        .adm-sidebar-footer form button:hover {
            background: rgba(220,53,69,0.15); color: #ff8080;
        }

        /* ═══ MAIN WRAPPER ═══ */
        .adm-wrapper { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; }

        /* ═══ TOPBAR ═══ */
        .adm-topbar {
            background: var(--white);
            border-bottom: 1px solid #e8e3db;
            padding: 14px 28px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 40;
        }
        .adm-topbar-left {}
        .adm-topbar-title {
            font-family: var(--font-display);
            font-size: 18px; font-weight: 700; color: var(--dark);
        }
        .adm-topbar-sub { font-size: 12px; color: #888; margin-top: 2px; }
        .adm-topbar-right { display: flex; align-items: center; gap: 14px; }
        .adm-topbar-site {
            font-size: 12px; color: var(--gold);
            text-decoration: none;
            border: 1px solid var(--gold);
            padding: 5px 12px; border-radius: 6px;
            transition: all 0.2s;
        }
        .adm-topbar-site:hover { background: var(--gold); color: var(--white); }
        .adm-user-chip {
            display: flex; align-items: center; gap: 8px;
        }
        .adm-user-name { font-size: 13px; color: #555; }
        .adm-user-avatar {
            width: 34px; height: 34px; border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 700; color: var(--white);
        }

        /* ═══ CONTENT ═══ */
        .adm-content { flex: 1; padding: 28px 32px; }

        /* ═══ FLASH ═══ */
        .adm-flash {
            position: fixed; top: 16px; right: 20px; z-index: 9999;
            display: flex; flex-direction: column; gap: 8px; max-width: 360px;
        }
        .adm-flash-item {
            padding: 12px 18px; border-radius: var(--radius-md);
            font-size: 13px; box-shadow: var(--shadow);
            animation: adm-slide 0.3s ease;
        }
        .adm-flash-ok  { background: var(--white); border-left: 4px solid #27500A; color: #27500A; }
        .adm-flash-err { background: var(--white); border-left: 4px solid #dc3545; color: #dc3545; }
        @keyframes adm-slide { from { transform: translateX(20px); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
    </style>
</head>
<body>

{{-- ═══ FLASH ═══ --}}
<div class="adm-flash" id="adm-flash">
    @if(session('success'))
        <div class="adm-flash-item adm-flash-ok">✓ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="adm-flash-item adm-flash-err">✕ {{ session('error') }}</div>
    @endif
</div>

{{-- ═══ SIDEBAR ═══ --}}
<aside class="adm-sidebar">
    <div class="adm-logo">
        <div class="adm-logo-text">Maskan<span>Tech</span></div>
        <div class="adm-logo-badge">Administration</div>
    </div>

    <nav class="adm-nav">
        <div class="adm-nav-section">Tableau de bord</div>
        <a href="{{ route('dashboard') }}"
           class="adm-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="adm-nav-icon">📊</span> Vue globale
        </a>

        <div class="adm-nav-section">Gestion</div>
        <a href="{{ route('admin.users') }}"
           class="adm-nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
            <span class="adm-nav-icon">👥</span> Utilisateurs
        </a>
        <a href="{{ route('admin.properties') }}"
           class="adm-nav-link {{ request()->routeIs('admin.properties') ? 'active' : '' }}">
            <span class="adm-nav-icon">🏘️</span> Annonces
        </a>
        <a href="{{ route('admin.contacts') }}"
           class="adm-nav-link {{ request()->routeIs('admin.contacts') ? 'active' : '' }}">
            <span class="adm-nav-icon">✉️</span> Contacts
            @php
                $unreadContacts = \App\Models\Contact::where('is_read', false)->count();
            @endphp
            @if($unreadContacts > 0)
                <span class="adm-nav-badge">{{ $unreadContacts }}</span>
            @endif
        </a>
        <a href="{{ route('appointments.index') }}"
           class="adm-nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
            <span class="adm-nav-icon">📅</span> Rendez-vous
        </a>
        <a href="{{ route('messages.index') }}"
           class="adm-nav-link {{ request()->routeIs('messages.*') ? 'active' : '' }}">
            <span class="adm-nav-icon">💬</span> Messages
        </a>

        <div class="adm-nav-section">Site</div>
        <a href="{{ route('properties.index') }}" class="adm-nav-link">
            <span class="adm-nav-icon">🌐</span> Voir le site
        </a>
        <a href="{{ route('profile.edit') }}"
           class="adm-nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
            <span class="adm-nav-icon">⚙️</span> Mon profil
        </a>
    </nav>

    <div class="adm-sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">
                <span style="font-size:15px;">🚪</span> Déconnexion
            </button>
        </form>
    </div>
</aside>

{{-- ═══ MAIN ═══ --}}
<div class="adm-wrapper">

    {{-- Topbar --}}
    <header class="adm-topbar">
        <div class="adm-topbar-left">
            <div class="adm-topbar-title">@yield('section_title', 'Administration')</div>
            <div class="adm-topbar-sub">@yield('section_sub', 'Panneau d\'administration MaskanTech')</div>
        </div>
        <div class="adm-topbar-right">
            <a href="{{ route('properties.index') }}" class="adm-topbar-site">🌐 Voir le site</a>
            @auth
            <div class="adm-user-chip">
                <span class="adm-user-name">{{ auth()->user()->name }}</span>
                <div class="adm-user-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
            </div>
            @endauth
        </div>
    </header>

    {{-- Content --}}
    <main class="adm-content">
        @yield('content')
    </main>
</div>

<script>
    setTimeout(() => {
        const f = document.getElementById('adm-flash');
        if (f) f.style.display = 'none';
    }, 5000);
</script>

@yield('scripts')
@stack('scripts')

</body>
</html>
