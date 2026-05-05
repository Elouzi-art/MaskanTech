{{-- resources/views/layouts/guest.blade.php — dark design --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MaskanTech — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background: #0d0d0d; font-family: 'Courier New', monospace; }
        .pulse { animation: pulse 2s infinite; }
        @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.3} }
        /* Hack radio cards : peer-checked fonctionne avec Tailwind CDN aussi */
        input[type=radio]:checked + div {
            border-color: #4338ca !important;
            background-color: #1e1b4b !important;
        }
        input[type=radio]:checked + div p:first-child {
            color: #a5b4fc !important;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col" style="background:#0d0d0d">

    {{-- Nav --}}
    <nav style="background:#111;border-bottom:1px solid #222" class="h-11 flex items-center justify-between px-6">
        <div class="flex items-center gap-2.5">
            <div class="w-5 h-5 border-2 border-white rounded-sm flex items-center justify-center">
                <svg class="w-2.5 h-2.5" viewBox="0 0 12 12" fill="none" stroke="white" stroke-width="1.5">
                    <path d="M6 1l4 3v4l-4 3-4-3V4z"/>
                </svg>
            </div>
            <span class="font-bold text-white tracking-widest text-sm" style="font-family:'Courier New',monospace">MASKANTECH</span>
            <span class="text-xs text-gray-600 tracking-wider hidden sm:block" style="font-family:'Courier New',monospace">LOGEMENTS À LOUER</span>
        </div>
        <div class="flex items-center gap-2 text-xs" style="font-family:'Courier New',monospace">
            <div class="w-2 h-2 rounded-full bg-green-500 pulse"></div>
            <span class="text-green-400 tracking-wider">CONNECTÉ</span>
        </div>
    </nav>

    {{-- Contenu centré --}}
    <div class="flex-1 flex items-center justify-center p-4">
        <div class="w-full max-w-sm">
            {{ $slot }}
        </div>
    </div>

</body>
</html>
