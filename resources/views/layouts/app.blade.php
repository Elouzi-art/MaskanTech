<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MaskanTech — @yield('title', 'Plateforme Immobilière')</title>

    {{-- TailwindCSS CDN (remplacer par npm en prod) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark-bg': '#0d0d0d',
                        'dark-card': '#111111',
                        'dark-card2': '#141414',
                        'dark-card3': '#1a1a1a',
                        'dark-border': '#222222',
                        'dark-border2': '#2a2a2a',
                        'dark-text': '#d0d0d0',
                        'dark-muted': '#666666',
                        'dark-dim': '#444444',
                    },
                    fontFamily: {
                        mono: ['"Courier New"', 'monospace'],
                    }
                }
            }
        }
    </script>

    {{-- Alpine.js pour interactivité légère --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Chart.js pour les graphiques --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background: #0d0d0d;
            color: #d0d0d0;
            font-family: 'Courier New', monospace;
        }

        ::-webkit-scrollbar {
            width: 4px;
        }

        ::-webkit-scrollbar-track {
            background: #111;
        }

        ::-webkit-scrollbar-thumb {
            background: #333;
            border-radius: 2px;
        }

        .pulse-dot {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: .3
            }
        }

        .fade-in {
            animation: fadeIn .3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(4px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }
    </style>

    @stack('styles')
</head>

<body class="bg-dark-bg font-mono">

    {{-- NAVBAR --}}
    <nav class="bg-dark-card border-b border-dark-border h-11 flex items-center justify-between px-4 sticky top-0 z-50">
        <div class="flex items-center gap-3">
            {{-- Logo --}}
            <div class="w-5 h-5 border-2 border-white rounded-sm flex items-center justify-center">
                <svg class="w-3 h-3" viewBox="0 0 12 12" fill="none" stroke="white" stroke-width="1.5">
                    <path d="M6 1l4 3v4l-4 3-4-3V4z" />
                </svg>
            </div>
            <span class="font-bold text-white tracking-widest text-sm">MASKANTECH</span>
            <span class="text-xs text-dark-muted tracking-wider hidden sm:block">PLATEFORME IMMOBILIÈRE</span>
        </div>

        {{-- Nav Links --}}
        <div class="flex items-center gap-5 text-xs tracking-wider text-dark-muted">
            <a href="{{ route('properties.index') }}"
                class="hover:text-dark-text transition-colors {{ request()->routeIs('properties.*') ? 'text-white' : '' }}">BIENS</a>
            <a href="{{ route('appointments.index') }}"
                class="hover:text-dark-text transition-colors {{ request()->routeIs('appointments.*') ? 'text-white' : '' }}">RENDEZ-VOUS</a>
            <a href="{{ route('messages.index') }}"
                class="hover:text-dark-text transition-colors {{ request()->routeIs('messages.*') ? 'text-white' : '' }}">MESSAGES</a>
            @auth
                <a href="{{ route('dashboard') }}"
                    class="hover:text-dark-text transition-colors {{ request()->routeIs('dashboard') ? 'text-white' : '' }}">DASHBOARD</a>
            @endauth
            @if(auth()->user()?->role === 'admin')
                <a href="{{ route('admin.users') }}"
                    class="hover:text-dark-text transition-colors {{ request()->routeIs('admin.*') ? 'text-white' : '' }}">ADMIN</a>
            @endif
        </div>

        {{-- Right side --}}
        <div class="flex items-center gap-4">
            {{-- System status --}}
            <div class="hidden sm:flex items-center gap-2 text-[10px] tracking-wider">
                <span class="text-dark-dim">SYSTÈME</span>
                @auth
                    <div class="w-2 h-2 rounded-full bg-green-500 pulse-dot"></div>
                    <span class="text-green-400">CONNECTÉ {{ strtoupper(auth()->user()->role) }}</span>
                @else
                    <div class="w-2 h-2 rounded-full bg-red-500"></div>
                    <span class="text-red-400">DÉCO CLIENT</span>
                @endauth
            </div>

            {{-- User menu --}}
            @auth
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                        class="flex items-center gap-2 text-xs text-dark-muted hover:text-dark-text transition-colors">
                        <div
                            class="w-7 h-7 rounded-sm bg-dark-card3 border border-dark-border flex items-center justify-center text-[10px] text-white">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <svg class="w-3 h-3" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M2 4l4 4 4-4" />
                        </svg>
                    </button>
                    <div x-show="open" @click.away="open = false"
                        class="absolute right-0 top-10 w-48 bg-dark-card border border-dark-border rounded-sm z-50 fade-in">
                        <div class="px-3 py-2 border-b border-dark-border">
                            <p class="text-xs text-white">{{ auth()->user()->name }}</p>
                            <p class="text-[10px] text-dark-muted">{{ ucfirst(auth()->user()->role) }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}"
                            class="block px-3 py-2 text-xs text-dark-muted hover:text-dark-text hover:bg-dark-card3 transition-colors">Mon
                            profil</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-3 py-2 text-xs text-red-400 hover:bg-dark-card3 transition-colors">
                                Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="text-xs text-dark-muted hover:text-dark-text transition-colors tracking-wider">CONNEXION</a>
            @endauth
        </div>
    </nav>

    {{-- FLASH MESSAGES --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="bg-green-950 border-b border-green-800 text-green-400 text-xs px-4 py-2 flex items-center justify-between">
            <span class="tracking-wide">{{ session('success') }}</span>
            <button @click="show = false" class="text-green-600 hover:text-green-400">✕</button>
        </div>
    @endif
    @if(session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="bg-red-950 border-b border-red-800 text-red-400 text-xs px-4 py-2 flex items-center justify-between">
            <span class="tracking-wide">{{ session('error') }}</span>
            <button @click="show = false" class="text-red-600 hover:text-red-400">✕</button>
        </div>
    @endif

    {{-- MAIN LAYOUT --}}
    <div class="flex" style="min-height: calc(100vh - 44px)">

        {{-- SIDEBAR --}}
        @hasSection('sidebar')
            <aside class="w-64 bg-dark-card border-r border-dark-border flex flex-col gap-4 p-3 shrink-0">
                @yield('sidebar')
            </aside>
        @endif

        {{-- PAGE CONTENT --}}
        <main class="flex-1 overflow-hidden">
            @yield('content')
        </main>

    </div>

    @stack('scripts')
</body>

</html>