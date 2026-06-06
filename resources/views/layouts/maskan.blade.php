<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MaskanTech — Trouvez votre logement au Maroc')</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><rect width='32' height='32' rx='7' fill='%23C8873A'/><path d='M6 14L16 7l10 7v10a1 1 0 01-1 1H7a1 1 0 01-1-1V14z' fill='none' stroke='white' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'/><path d='M13 22v-6h6v6' fill='none' stroke='white' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'/></svg>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        /* ===== VARIABLES ===== */
        :root {
            --gold: #C8873A;
            --gold-light: #E8A855;
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
            --shadow: 0 8px 40px rgba(0,0,0,0.1);
        }

        /* ===== RESET ===== */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: var(--font-body); background: var(--white); color: var(--dark); }

        /* ===== NAVBAR BASE ===== */
        .mk-nav {
            display: flex; align-items: center; justify-content: space-between;
            padding: 18px 48px;
            background: rgba(255,255,255,0.97);
            border-bottom: 1px solid var(--gray-light);
            position: sticky; top: 0; z-index: 100;
        }
        .mk-logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .mk-logo-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, var(--gold), var(--gold-light));
            border-radius: var(--radius-md);
            display: flex; align-items: center; justify-content: center;
        }
        .mk-logo-icon svg { width: 20px; height: 20px; }
        .mk-logo-text { font-family: var(--font-display); font-size: 20px; font-weight: 700; color: var(--dark); }
        .mk-logo-text span { color: var(--gold); }
        .mk-nav-links { display: flex; align-items: center; gap: 32px; }
        .mk-nav-links a { font-size: 14px; color: #555; text-decoration: none; transition: color 0.2s; }
        .mk-nav-links a:hover { color: var(--gold); }
        .mk-nav-cta {
            background: var(--dark); color: var(--white) !important;
            padding: 10px 22px; border-radius: var(--radius-sm);
            font-size: 13px; font-weight: 500; transition: background 0.2s !important;
        }
        .mk-nav-cta:hover { background: var(--gold) !important; }

        /* ===== USER DROPDOWN (connecté) ===== */
        .mk-user-menu { position: relative; }
        .mk-user-trigger {
            display: flex; align-items: center; gap: 10px;
            cursor: pointer; padding: 6px 10px;
            border-radius: var(--radius-md);
            border: 1.5px solid var(--gray-border);
            background: var(--white);
            transition: border-color 0.2s, background 0.2s;
            user-select: none;
        }
        .mk-user-trigger:hover { border-color: var(--gold); background: var(--gold-bg); }
        .mk-user-avatar {
            width: 34px; height: 34px; border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--gold-border);
            flex-shrink: 0;
        }
        .mk-user-info { display: flex; flex-direction: column; line-height: 1.2; }
        .mk-user-name { font-size: 13px; font-weight: 500; color: var(--dark); }
        .mk-user-role {
            font-size: 11px; color: var(--gold);
            text-transform: uppercase; letter-spacing: 0.5px;
        }
        .mk-user-chevron {
            width: 14px; height: 14px; color: #888;
            transition: transform 0.2s;
            flex-shrink: 0;
        }
        .mk-user-menu.open .mk-user-chevron { transform: rotate(180deg); }

        .mk-dropdown {
            position: absolute; top: calc(100% + 10px); right: 0;
            background: var(--white);
            border: 1px solid var(--gray-border);
            border-radius: var(--radius-lg);
            box-shadow: 0 12px 40px rgba(0,0,0,0.12);
            min-width: 220px;
            opacity: 0; visibility: hidden;
            transform: translateY(-8px);
            transition: opacity 0.2s, transform 0.2s, visibility 0.2s;
            z-index: 200;
            overflow: hidden;
        }
        .mk-user-menu.open .mk-dropdown {
            opacity: 1; visibility: visible; transform: translateY(0);
        }

        .mk-dropdown-header {
            padding: 14px 16px 12px;
            border-bottom: 1px solid var(--gray-light);
            background: var(--gold-bg);
        }
        .mk-dropdown-header .dd-name { font-size: 14px; font-weight: 500; color: var(--dark); }
        .mk-dropdown-header .dd-email { font-size: 12px; color: var(--gray); margin-top: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

        .mk-dropdown-body { padding: 6px 0; }
        .mk-dropdown-item {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 16px;
            font-size: 13px; color: #444;
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
        }
        .mk-dropdown-item:hover { background: var(--gold-bg); color: var(--gold); }
        .mk-dropdown-item svg { width: 16px; height: 16px; flex-shrink: 0; opacity: 0.7; }
        .mk-dropdown-item:hover svg { opacity: 1; }

        .mk-dropdown-divider { height: 1px; background: var(--gray-light); margin: 4px 0; }

        .mk-dropdown-item.danger { color: #c0392b; }
        .mk-dropdown-item.danger:hover { background: #fef2f2; color: #c0392b; }
        .mk-dropdown-item.danger svg { color: #c0392b; opacity: 0.8; }

        .mk-logout-form { margin: 0; }
        .mk-logout-btn {
            display: flex; align-items: center; gap: 10px;
            width: 100%; padding: 10px 16px;
            font-size: 13px; color: #c0392b;
            background: none; border: none; cursor: pointer;
            font-family: var(--font-body);
            text-align: left;
            transition: background 0.15s;
        }
        .mk-logout-btn:hover { background: #fef2f2; }
        .mk-logout-btn svg { width: 16px; height: 16px; flex-shrink: 0; opacity: 0.8; }

        /* ===== BUTTONS ===== */
        .mk-btn-gold {
            background: var(--gold); color: var(--white);
            padding: 14px 28px; border-radius: var(--radius-md);
            text-decoration: none; font-size: 14px; font-weight: 500;
            border: none; cursor: pointer; font-family: var(--font-body);
            transition: background 0.2s; display: inline-block;
        }
        .mk-btn-gold:hover { background: #b07530; }
        .mk-btn-dark {
            background: var(--dark); color: var(--white);
            padding: 14px 28px; border-radius: var(--radius-md);
            text-decoration: none; font-size: 14px; font-weight: 500;
            border: none; cursor: pointer; font-family: var(--font-body);
            transition: background 0.2s; display: inline-block;
        }
        .mk-btn-dark:hover { background: var(--gold); }
        .mk-btn-outline {
            border: 1.5px solid var(--gold); color: var(--gold);
            padding: 13px 28px; border-radius: var(--radius-md);
            text-decoration: none; font-size: 14px; font-weight: 500;
            background: transparent; cursor: pointer; font-family: var(--font-body);
            transition: all 0.2s; display: inline-block;
        }
        .mk-btn-outline:hover { background: var(--gold); color: var(--white); }

        /* ===== FORM ELEMENTS ===== */
        .mk-form-group { margin-bottom: 18px; }
        .mk-form-group label {
            font-size: 12px; color: #666; letter-spacing: 1px;
            text-transform: uppercase; font-weight: 500;
            display: block; margin-bottom: 7px;
        }
        .mk-form-group input, .mk-form-group select, .mk-form-group textarea {
            width: 100%; padding: 13px 16px;
            border: 1.5px solid var(--gray-border); border-radius: var(--radius-md);
            font-size: 14px; font-family: var(--font-body); color: var(--dark);
            outline: none; transition: border-color 0.2s; background: var(--white);
        }
        .mk-form-group input:focus,
        .mk-form-group select:focus,
        .mk-form-group textarea:focus { border-color: var(--gold); }
        .mk-form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

        /* ===== SECTION ===== */
        .mk-section { padding: 80px; }
        .mk-section-alt { background: #fafaf8; }
        .mk-section-tag {
            font-size: 11px; color: var(--gold); letter-spacing: 2.5px;
            text-transform: uppercase; font-weight: 500; margin-bottom: 10px;
        }
        .mk-section-h2 {
            font-family: var(--font-display); font-size: 38px;
            font-weight: 700; color: var(--dark);
            margin-bottom: 48px; line-height: 1.2;
        }

        /* ===== CARDS ===== */
        .mk-card {
            border-radius: var(--radius-lg); overflow: hidden;
            border: 1px solid #ede9e3;
            transition: transform 0.25s, box-shadow 0.25s;
        }
        .mk-card:hover { transform: translateY(-5px); box-shadow: var(--shadow); }

        /* ===== FOOTER ===== */
        .mk-footer {
            background: var(--dark-2); padding: 40px 80px;
            display: flex; justify-content: space-between; align-items: center;
        }
        .mk-footer-logo { font-family: var(--font-display); font-size: 20px; color: var(--white); }
        .mk-footer-logo span { color: var(--gold); }
        .mk-footer-copy { font-size: 13px; color: #444; }

        /* ===== FOOTER CONNECTÉ (épuré) ===== */
        .mk-footer-minimal {
            background: var(--dark-2);
            padding: 20px 48px;
            display: flex; justify-content: space-between; align-items: center;
            border-top: 1px solid #222;
        }
        .mk-footer-minimal .mk-footer-logo { font-size: 16px; }
        .mk-footer-minimal .mk-footer-copy { font-size: 12px; color: #333; }

        /* ===== BADGE ===== */
        .mk-badge {
            display: inline-block; font-size: 11px; font-weight: 500;
            padding: 4px 10px; border-radius: 20px;
        }
        .mk-badge-gold { background: var(--gold-bg); color: var(--gold); }
        .mk-badge-blue { background: #e6f1fb; color: #185FA5; }
        .mk-badge-green { background: #eaf3de; color: #27500A; }

        @yield('styles')
    </style>

    {{-- Styles additionnels via @push('styles') --}}
    @stack('styles')

    @yield('head')
</head>
<body>

    {{-- NAVBAR --}}
    @guest
    <nav class="mk-nav">
        <a class="mk-logo" href="{{ url('/') }}">
            <div class="mk-logo-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                    <path d="M9 21V12h6v9"/>
                </svg>
            </div>
            <span class="mk-logo-text">Maskan<span>Tech</span></span>
        </a>
        <div class="mk-nav-links">
            <a href="{{ url('/biens') }}">Logements</a>
            <a href="{{ url('/etudiants') }}">Étudiants</a>
            <a href="{{ url('/proprietaires') }}">Propriétaires</a>
            <a href="{{ url('/a-propos') }}">À propos</a>
            <a href="{{ route('login') }}">Connexion</a>
            <a href="{{ route('register') }}" class="mk-nav-cta">S'inscrire</a>
        </div>
    </nav>

    @else
    <nav class="mk-nav">
        <a class="mk-logo" href="{{ url('/') }}">
            <div class="mk-logo-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                    <path d="M9 21V12h6v9"/>
                </svg>
            </div>
            <span class="mk-logo-text">Maskan<span>Tech</span></span>
        </a>

        <div class="mk-nav-links">
            <a href="{{ url('/biens') }}">Logements</a>
            <a href="{{ url('/a-propos') }}">À propos</a>
            <a href="{{ url('/blog') }}">Blog</a>
            <a href="{{ url('/contact') }}">Contact</a>
            <a href="{{ route('dashboard') }}" style="color: var(--gold); font-weight: 500;">Tableau de bord</a>

            <div class="mk-user-menu" id="userMenu">
                <div class="mk-user-trigger" onclick="toggleUserMenu()">
                    <img
                        src="{{ auth()->user()->avatar_url }}"
                        alt="{{ auth()->user()->name }}"
                        class="mk-user-avatar"
                        onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=C8873A&color=fff&size=68'"
                    >
                    <div class="mk-user-info">
                        <span class="mk-user-name">{{ Str::limit(auth()->user()->name, 18) }}</span>
                        <span class="mk-user-role">{{ auth()->user()->role_label }}</span>
                    </div>
                    <svg class="mk-user-chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </div>

                <div class="mk-dropdown">
                    <div class="mk-dropdown-header">
                        <div class="dd-name">{{ auth()->user()->name }}</div>
                        <div class="dd-email">{{ auth()->user()->email }}</div>
                    </div>

                    <div class="mk-dropdown-body">
                        <a href="{{ route('dashboard') }}" class="mk-dropdown-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                            Tableau de bord
                        </a>

                        <a href="{{ route('profile.edit') }}" class="mk-dropdown-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                            Mon profil
                        </a>

                        @if(auth()->user()->canRent())
                        <a href="{{ route('favorites.index') }}" class="mk-dropdown-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                            Mes favoris
                        </a>
                        @endif

                        <a href="{{ route('messages.index') }}" class="mk-dropdown-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                            Messages
                            @if(auth()->user()->unread_messages_count > 0)
                                <span style="margin-left:auto;background:var(--gold);color:#fff;font-size:10px;font-weight:600;padding:2px 7px;border-radius:20px;">
                                    {{ auth()->user()->unread_messages_count }}
                                </span>
                            @endif
                        </a>

                        <a href="{{ route('appointments.index') }}" class="mk-dropdown-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            Rendez-vous
                        </a>

                        @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.users') }}" class="mk-dropdown-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                            Administration
                        </a>
                        @endif

                        <div class="mk-dropdown-divider"></div>

                        <form method="POST" action="{{ route('logout') }}" class="mk-logout-form">
                            @csrf
                            <button type="submit" class="mk-logout-btn">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    @endguest

    @yield('content')

    @guest
    <footer class="mk-footer">
        <div class="mk-footer-logo">Maskan<span>Tech</span></div>
        <div style="display:flex;gap:32px;">
            <a href="{{ url('/biens') }}" style="color:#444;font-size:13px;text-decoration:none;">Logements</a>
            <a href="{{ url('/etudiants') }}" style="color:#444;font-size:13px;text-decoration:none;">Étudiants</a>
            <a href="{{ url('/proprietaires') }}" style="color:#444;font-size:13px;text-decoration:none;">Propriétaires</a>
            <a href="{{ url('/blog') }}" style="color:#444;font-size:13px;text-decoration:none;">Blog</a>
            <a href="{{ url('/a-propos') }}" style="color:#444;font-size:13px;text-decoration:none;">À propos</a>
            <a href="{{ url('/contact') }}" style="color:#444;font-size:13px;text-decoration:none;">Contact</a>
        </div>
        <div class="mk-footer-copy">© {{ date('Y') }} — Hajar Tanani & Salmane Elouzi</div>
    </footer>

    @else
    <footer class="mk-footer-minimal">
        <div class="mk-footer-logo">Maskan<span>Tech</span></div>
        <div style="display:flex;gap:24px;align-items:center;">
            <a href="{{ url('/biens') }}" style="color:#444;font-size:12px;text-decoration:none;">Logements</a>
            <a href="{{ url('/contact') }}" style="color:#444;font-size:12px;text-decoration:none;">Contact</a>
            <a href="{{ url('/a-propos') }}" style="color:#444;font-size:12px;text-decoration:none;">À propos</a>
        </div>
        <div class="mk-footer-copy">© {{ date('Y') }} MaskanTech</div>
    </footer>
    @endguest

    @yield('scripts')
    @stack('scripts')

    @auth
    <script>
        function toggleUserMenu() {
            document.getElementById('userMenu').classList.toggle('open');
        }
        document.addEventListener('click', function(e) {
            const menu = document.getElementById('userMenu');
            if (menu && !menu.contains(e.target)) {
                menu.classList.remove('open');
            }
        });
    </script>
    @endauth

</body>
</html>