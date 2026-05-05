{{-- resources/views/layouts/guest.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MaskanTech — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: #0d0d0d;
            font-family: 'Courier New', monospace;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .mk-nav {
            background: #111111;
            border-bottom: 1px solid #222222;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            flex-shrink: 0;
        }

        .mk-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .mk-logo-box {
            width: 20px; height: 20px;
            border: 2px solid #fff;
            border-radius: 3px;
            display: flex; align-items: center; justify-content: center;
        }

        .mk-logo-name {
            font-weight: 700;
            font-size: 13px;
            letter-spacing: .15em;
            color: #ffffff;
        }

        .mk-logo-sub {
            font-size: 10px;
            color: #555;
            letter-spacing: .08em;
        }

        .mk-status {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 10px;
            letter-spacing: .08em;
        }

        .mk-dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: #22c55e;
            animation: pulse 2s infinite;
        }

        @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.3} }

        .mk-center {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .mk-card {
            width: 100%;
            max-width: 400px;
            background: #111111;
            border: 1px solid #222222;
            border-radius: 4px;
            padding: 2rem;
        }

        /* ── Inputs globaux ── */
        .mk-input {
            width: 100%;
            background: #1a1a1a !important;
            border: 1px solid #2a2a2a !important;
            color: #d0d0d0 !important;
            font-family: 'Courier New', monospace !important;
            font-size: 12px !important;
            padding: 10px 12px !important;
            border-radius: 3px !important;
            outline: none !important;
            transition: border-color .2s;
        }

        .mk-input:focus {
            border-color: #4338ca !important;
        }

        .mk-input::placeholder {
            color: #444 !important;
        }

        .mk-input.error {
            border-color: #b91c1c !important;
        }

        .mk-label {
            display: block;
            font-size: 9px;
            letter-spacing: .18em;
            text-transform: uppercase;
            color: #555;
            margin-bottom: 6px;
        }

        .mk-btn-primary {
            width: 100%;
            background: #1e1b4b;
            border: 1px solid #4338ca;
            color: #a5b4fc;
            font-family: 'Courier New', monospace;
            font-size: 11px;
            letter-spacing: .15em;
            padding: 12px;
            border-radius: 3px;
            cursor: pointer;
            transition: background .2s;
        }

        .mk-btn-primary:hover { background: #312e81; }

        .mk-error {
            color: #f87171;
            font-size: 10px;
            margin-top: 4px;
            font-family: 'Courier New', monospace;
        }

        .mk-link {
            color: #818cf8;
            text-decoration: none;
            font-size: 10px;
            font-family: 'Courier New', monospace;
            letter-spacing: .05em;
        }

        .mk-link:hover { color: #a5b4fc; }

        .mk-divider {
            border: none;
            border-top: 1px solid #1e1e1e;
            margin: 1.2rem 0;
        }

        .mk-heading {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .mk-heading-sub {
            font-size: 9px;
            letter-spacing: .2em;
            text-transform: uppercase;
            color: #444;
            margin-bottom: 4px;
        }

        .mk-heading-title {
            font-size: 15px;
            font-weight: 600;
            color: #ffffff;
            letter-spacing: .12em;
        }

        /* ── Radio cards rôle ── */
        .mk-role-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .mk-role-card {
            position: relative;
            cursor: pointer;
        }

        .mk-role-card input[type=radio] {
            position: absolute;
            opacity: 0;
            width: 0; height: 0;
        }

        .mk-role-box {
            border: 1px solid #2a2a2a;
            border-radius: 3px;
            padding: 10px 6px;
            text-align: center;
            transition: border-color .2s, background .2s;
            background: #1a1a1a;
        }

        .mk-role-box:hover {
            border-color: #444;
        }

        .mk-role-card input[type=radio]:checked ~ .mk-role-box {
            border-color: #4338ca;
            background: #1e1b4b;
        }

        .mk-role-card input[type=radio]:checked ~ .mk-role-box .mk-role-name {
            color: #a5b4fc;
        }

        .mk-role-name {
            font-size: 11px;
            color: #d0d0d0;
            font-weight: 600;
            display: block;
            margin-bottom: 3px;
        }

        .mk-role-desc {
            font-size: 9px;
            color: #555;
            line-height: 1.3;
            display: block;
        }

        .mk-flash-success {
            background: #052e16;
            border: 1px solid #166534;
            color: #4ade80;
            font-size: 11px;
            padding: 8px 12px;
            border-radius: 3px;
            margin-bottom: 1rem;
            font-family: 'Courier New', monospace;
        }

        .mk-field { margin-bottom: 1rem; }

        .mk-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .mk-checkbox-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 10px;
            color: #666;
            cursor: pointer;
            font-family: 'Courier New', monospace;
        }

        .mk-footer-text {
            text-align: center;
            font-size: 10px;
            color: #555;
            margin-top: 1.2rem;
            font-family: 'Courier New', monospace;
            letter-spacing: .05em;
        }
    </style>
</head>
<body>

    <nav class="mk-nav">
        <a href="{{ url('/') }}" class="mk-logo">
            <div class="mk-logo-box">
                <svg width="11" height="11" viewBox="0 0 12 12" fill="none" stroke="white" stroke-width="1.5">
                    <path d="M6 1l4 3v4l-4 3-4-3V4z"/>
                </svg>
            </div>
            <span class="mk-logo-name">MASKANTECH</span>
            <span class="mk-logo-sub">LOGEMENTS À LOUER</span>
        </a>
        <div class="mk-status">
            <div class="mk-dot"></div>
            <span style="color:#22c55e">CONNECTÉ</span>
        </div>
    </nav>

    <div class="mk-center">
        <div class="mk-card">
            {{ $slot }}
        </div>
    </div>

</body>
</html>
