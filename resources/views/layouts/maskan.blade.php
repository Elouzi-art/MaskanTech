<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'MaskanTech — Trouvez votre logement au Maroc')</title>
    <link rel="icon" type="image/svg+xml"
        href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><rect width='32' height='32' rx='7' fill='%23C8873A'/><path d='M6 14L16 7l10 7v10a1 1 0 01-1 1H7a1 1 0 01-1-1V14z' fill='none' stroke='white' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'/><path d='M13 22v-6h6v6' fill='none' stroke='white' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'/></svg>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap"
        rel="stylesheet">

    {{-- CORRECTION B : Alpine.js pour la galerie photos (show.blade.php) --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        /* ===== VARIABLES ===== */
        :root {
            --gold: #C8873A;
            --gold-light: #E8A855;
            --gold-dark: #b07530;
            --gold-bg: #fdf6ee;
            --gold-border: #f0d9b5;
            --dark: #1a1a1a;
            --dark-2: #111;
            --gray: #888;
            --gray-light: #f0ede8;
            --gray-border: #e8e3db;
            --white: #ffffff;
            --font-display: 'Playfair Display', serif;
            --font-body: 'DM Sans', sans-serif;
            --radius-sm: 6px;
            --radius-md: 8px;
            --radius-lg: 12px;
            --shadow: 0 8px 40px rgba(0, 0, 0, 0.1);
        }

        /* ===== RESET ===== */
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-body);
            background: var(--white);
            color: var(--dark);
            line-height: 1.6;
        }

        a {
            text-decoration: none;
        }

        img {
            display: block;
            max-width: 100%;
        }

        button,
        input,
        select,
        textarea {
            font-family: var(--font-body);
        }

        /* ===== NAVBAR ===== */
        .mk-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 48px;
            background: rgba(255, 255, 255, 0.97);
            border-bottom: 1px solid var(--gray-light);
            position: sticky;
            top: 0;
            z-index: 200;
            backdrop-filter: blur(8px);
        }

        .mk-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .mk-logo-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .mk-logo-icon svg {
            width: 20px;
            height: 20px;
        }

        .mk-logo-text {
            font-family: var(--font-display);
            font-size: 20px;
            font-weight: 700;
            color: var(--dark);
        }

        .mk-logo-text span {
            color: var(--gold);
        }

        .mk-nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .mk-nav-links a {
            font-size: 14px;
            color: #555;
            text-decoration: none;
            transition: color 0.2s;
            white-space: nowrap;
        }

        .mk-nav-links a:hover {
            color: var(--gold);
        }

        .mk-nav-cta {
            background: var(--dark) !important;
            color: var(--white) !important;
            padding: 9px 20px !important;
            border-radius: var(--radius-sm) !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            transition: background 0.2s !important;
        }

        .mk-nav-cta:hover {
            background: var(--gold) !important;
        }

        /* Dropdown utilisateur connecté */
        .mk-nav-user {
            position: relative;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .mk-nav-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .mk-nav-name {
            font-size: 13px;
            color: #333;
            font-weight: 500;
        }

        .mk-nav-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background: #fff;
            border: 1px solid var(--gray-border);
            border-radius: var(--radius-lg);
            padding: 8px;
            min-width: 210px;
            box-shadow: var(--shadow);
            display: none;
            z-index: 300;
        }

        .mk-nav-user:hover .mk-nav-dropdown {
            display: block;
        }

        .mk-nav-dropdown a,
        .mk-nav-dropdown button {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 10px 12px;
            font-size: 13px;
            color: #444;
            border-radius: var(--radius-md);
            border: none;
            background: none;
            cursor: pointer;
            text-align: left;
            transition: background 0.15s, color 0.15s;
        }

        .mk-nav-dropdown a:hover,
        .mk-nav-dropdown button:hover {
            background: var(--gold-bg);
            color: var(--gold);
        }

        .mk-nav-dropdown .sep {
            height: 1px;
            background: var(--gray-light);
            margin: 6px 0;
        }

        /* ===== BUTTONS ===== */
        .mk-btn-gold {
            background: var(--gold);
            color: var(--white);
            padding: 13px 28px;
            border-radius: var(--radius-md);
            font-size: 14px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
            display: inline-block;
        }

        .mk-btn-gold:hover {
            background: var(--gold-dark);
            color: var(--white);
        }

        .mk-btn-dark {
            background: var(--dark);
            color: var(--white);
            padding: 13px 28px;
            border-radius: var(--radius-md);
            font-size: 14px;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
            display: inline-block;
        }

        .mk-btn-dark:hover {
            background: var(--gold);
            color: var(--white);
        }

        .mk-btn-outline {
            border: 1.5px solid var(--gold);
            color: var(--gold);
            padding: 12px 28px;
            border-radius: var(--radius-md);
            font-size: 14px;
            font-weight: 500;
            background: transparent;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-block;
        }

        .mk-btn-outline:hover {
            background: var(--gold);
            color: var(--white);
        }

        /* ===== FORM ELEMENTS ===== */
        .mk-form-group {
            margin-bottom: 18px;
        }

        .mk-form-group label {
            font-size: 12px;
            color: #666;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-weight: 500;
            display: block;
            margin-bottom: 7px;
        }

        .mk-form-group input,
        .mk-form-group select,
        .mk-form-group textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid var(--gray-border);
            border-radius: var(--radius-md);
            font-size: 14px;
            color: var(--dark);
            outline: none;
            transition: border-color 0.2s;
            background: var(--white);
        }

        .mk-form-group input:focus,
        .mk-form-group select:focus,
        .mk-form-group textarea:focus {
            border-color: var(--gold);
        }

        .mk-form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        /* ===== SECTIONS ===== */
        .mk-section {
            padding: 72px 80px;
        }

        .mk-section-sm {
            padding: 48px 80px;
        }

        .mk-section-alt {
            background: #fafaf8;
        }

        .mk-section-tag {
            font-size: 11px;
            color: var(--gold);
            letter-spacing: 2.5px;
            text-transform: uppercase;
            font-weight: 500;
            margin-bottom: 10px;
            display: block;
        }

        .mk-section-h2 {
            font-family: var(--font-display);
            font-size: 36px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 40px;
            line-height: 1.2;
        }

        /* ===== CARDS ===== */
        .mk-card {
            border-radius: var(--radius-lg);
            overflow: hidden;
            border: 1px solid #ede9e3;
            background: #fff;
            transition: transform 0.25s, box-shadow 0.25s;
        }

        .mk-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow);
        }

        /* ===== BADGE ===== */
        .mk-badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 500;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .mk-badge-gold {
            background: var(--gold-bg);
            color: var(--gold);
        }

        .mk-badge-blue {
            background: #e6f1fb;
            color: #185FA5;
        }

        .mk-badge-green {
            background: #eaf3de;
            color: #27500A;
        }

        .mk-badge-red {
            background: #fff0f0;
            color: #dc3545;
        }

        /* ===== FLASH MESSAGES ===== */
        .mk-flash {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 9999;
            max-width: 380px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .mk-flash-item {
            padding: 14px 20px;
            border-radius: var(--radius-md);
            font-size: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
            animation: slideIn 0.3s ease;
        }

        .mk-flash-success {
            background: #fff;
            border-left: 4px solid #27500A;
            color: #27500A;
        }

        .mk-flash-error {
            background: #fff;
            border-left: 4px solid #dc3545;
            color: #dc3545;
        }

        @keyframes slideIn {
            from {
                transform: translateX(20px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        /* ===== FOOTER ===== */
        .mk-footer {
            background: var(--dark-2);
            padding: 40px 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }

        .mk-footer-logo {
            font-family: var(--font-display);
            font-size: 20px;
            color: var(--white);
        }

        .mk-footer-logo span {
            color: var(--gold);
        }

        .mk-footer-links {
            display: flex;
            gap: 28px;
            flex-wrap: wrap;
        }

        .mk-footer-links a {
            color: #555;
            font-size: 13px;
            text-decoration: none;
            transition: color 0.2s;
        }

        .mk-footer-links a:hover {
            color: var(--gold);
        }

        .mk-footer-copy {
            font-size: 12px;
            color: #444;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .mk-nav {
                padding: 14px 28px;
            }

            .mk-section {
                padding: 56px 32px;
            }

            .mk-footer {
                padding: 40px 32px;
            }
        }

        @media (max-width: 768px) {
            .mk-nav-links {
                display: none;
            }

            .mk-section {
                padding: 40px 20px;
            }

            .mk-section-h2 {
                font-size: 26px;
            }

            .mk-footer {
                flex-direction: column;
                gap: 20px;
                text-align: center;
            }
        }

            {
                {
                -- CORRECTION A: @yield('styles') pour injecter le CSS de chaque page --
            }
        }

        @yield('styles')
    </style>
    @yield('head')
</head>

<body>

    {{-- FLASH MESSAGES --}}
    <div class="mk-flash" id="mk-flash">
        @if(session('success'))
            <div class="mk-flash-item mk-flash-success">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="mk-flash-item mk-flash-error">✕ {{ session('error') }}</div>
        @endif
        @if(session('status'))
            <div class="mk-flash-item mk-flash-success">✓ {{ session('status') }}</div>
        @endif
    </div>

    {{-- NAVBAR --}}
    <nav class="mk-nav">
        <a class="mk-logo" href="{{ route('home') }}">
            <div class="mk-logo-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z" />
                    <path d="M9 21V12h6v9" />
                </svg>
            </div>
            <span class="mk-logo-text">Maskan<span>Tech</span></span>
        </a>

        {{-- CORRECTION 2 : Navbar dynamique selon l'état d'authentification --}}
        <div class="mk-nav-links">
            <a href="{{ route('properties.index') }}">Logements</a>
            <a href="{{ route('students') }}">Étudiants</a>
            <a href="{{ route('owners') }}">Propriétaires</a>
            <a href="{{ route('about') }}">À propos</a>
            <a href="{{ route('contact') }}">Contact</a>

            @auth
                {{-- Utilisateur connecté : avatar + dropdown --}}
                <div class="mk-nav-user">
                    <div class="mk-nav-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <span class="mk-nav-name">{{ auth()->user()->name }}</span>

                    <div class="mk-nav-dropdown">
                        <a href="{{ route('dashboard') }}">🏠 Dashboard</a>
                        <a href="{{ route('profile.edit') }}">⚙️ Mon profil</a>
                        <a href="{{ route('favorites.index') }}">❤️ Mes favoris</a>
                        <a href="{{ route('appointments.index') }}">📅 Rendez-vous</a>
                        <a href="{{ route('messages.index') }}">
                            💬 Messages
                            @php $unread = auth()->user()->unread_messages_count ?? 0; @endphp
                            @if($unread > 0)
                                <span
                                    style="background:var(--gold);color:#fff;font-size:10px;padding:1px 7px;border-radius:10px;margin-left:auto;">{{ $unread }}</span>
                            @endif
                        </a>
                        @if(auth()->user()->isAdmin())
                            <div class="sep"></div>
                            <a href="{{ route('admin.users') }}" style="color:#dc3545;">🛡️ Administration</a>
                        @endif
                        @can('create', App\Models\Property::class)
                            <div class="sep"></div>
                            <a href="{{ route('properties.create') }}">➕ Publier un bien</a>
                        @endcan
                        <div class="sep"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">🚪 Déconnexion</button>
                        </form>
                    </div>
                </div>
            @else
                {{-- Visiteur : connexion / inscription --}}
                <a href="{{ route('login') }}">Connexion</a>
                <a href="{{ route('register') }}" class="mk-nav-cta">S'inscrire</a>
            @endauth
        </div>
    </nav>

    {{-- CONTENU --}}
    @yield('content')

    {{-- FOOTER --}}
    {{-- CORRECTION 3 : liens footer via route() --}}
    <footer class="mk-footer">
        <div class="mk-footer-logo">Maskan<span>Tech</span></div>
        <div class="mk-footer-links">
            <a href="{{ route('properties.index') }}">Logements</a>
            <a href="{{ route('students') }}">Étudiants</a>
            <a href="{{ route('owners') }}">Propriétaires</a>
            <a href="{{ route('blog') }}">Blog</a>
            <a href="{{ route('about') }}">À propos</a>
            <a href="{{ route('contact') }}">Contact</a>
        </div>
        <div class="mk-footer-copy">© {{ date('Y') }} — MaskanTech</div>
    </footer>

    {{-- SCRIPTS --}}
    <script>
        // Auto-hide flash messages après 4 secondes
        setTimeout(() => {
            const flash = document.getElementById('mk-flash');
            if (flash) flash.style.display = 'none';
        }, 4000);
    </script>

    @yield('scripts')
    @stack('scripts')

</body>

</html>