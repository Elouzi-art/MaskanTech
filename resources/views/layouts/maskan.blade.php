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

        /* ===== NAVBAR ===== */
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
    @yield('head')
</head>
<body>

    {{-- NAVBAR --}}
    <nav class="mk-nav">
        <a class="mk-logo" href="/">
            <div class="mk-logo-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                    <path d="M9 21V12h6v9"/>
                </svg>
            </div>
            <span class="mk-logo-text">Maskan<span>Tech</span></span>
        </a>
        <div class="mk-nav-links">
    <a href="/biens">Logements</a>
    <a href="/etudiants">Étudiants</a>
    <a href="/proprietaires">Propriétaires</a>
    <a href="/a-propos">À propos</a>
    <a href="/login">Connexion</a>
    <a href="/register" class="mk-nav-cta">S'inscrire</a>
</div>
    </nav>

    {{-- CONTENU --}}
    @yield('content')

    {{-- FOOTER --}}
    <footer class="mk-footer">
    <div class="mk-footer-logo">Maskan<span>Tech</span></div>
    <div style="display:flex;gap:32px;">
        <a href="/biens" style="color:#444;font-size:13px;text-decoration:none;">Logements</a>
        <a href="/etudiants" style="color:#444;font-size:13px;text-decoration:none;">Étudiants</a>
        <a href="/proprietaires" style="color:#444;font-size:13px;text-decoration:none;">Propriétaires</a>
        <a href="/blog" style="color:#444;font-size:13px;text-decoration:none;">Blog</a>
        <a href="/a-propos" style="color:#444;font-size:13px;text-decoration:none;">À propos</a>
        <a href="/contact" style="color:#444;font-size:13px;text-decoration:none;">Contact</a>
    </div>
    <div class="mk-footer-copy">© 2026 — Hajar Tanani & Salmane Elouzi</div>
</footer>

    @yield('scripts')

</body>
</html>