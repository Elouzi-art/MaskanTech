<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin — @yield('title', 'Panel') — MaskanTech</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark-bg':      '#fffaf5',
                        'dark-card':    '#ffffff',
                        'dark-card2':   '#fff8f0',
                        'dark-card3':   '#fff3e6',
                        'dark-border':  '#efe6db',
                        'dark-border2': '#e6d7c2',
                        'dark-text':    '#1f1f1f',
                        'dark-muted':   '#666666',
                        'dark-dim':     '#8c7b63',
                    },
                    fontFamily: {
                        mono: ['"DM Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        * { box-sizing: border-box; }
        body { background:#fffaf5; color:#1f1f1f; font-family:'DM Sans',sans-serif; }
        ::-webkit-scrollbar { width:4px; }
        ::-webkit-scrollbar-track { background:#111; }
        ::-webkit-scrollbar-thumb { background:#333; border-radius:2px; }
        .pulse-dot { animation:pulse 2s infinite; }
        @keyframes pulse { 0%,100%{opacity:1} 50%{opacity:.3} }
        .fade-in { animation:fadeIn .2s ease; }
        @keyframes fadeIn { from{opacity:0;transform:translateY(4px)} to{opacity:1;transform:translateY(0)} }
        .nav-active { color:#1f1f1f !important; border-left-color: #C8873A !important; background:#fff3e6 !important; }
    </style>
    @stack('styles')
</head>
<body class="bg-dark-bg font-mono">

{{-- TOPBAR --}}
<nav class="bg-white border-b border-[#efe6db] h-16 flex items-center justify-between px-4 sticky top-0 z-50 shadow-sm">
    <div class="flex items-center gap-3">
        <a href="{{ url('/') }}" class="flex items-center gap-2 text-dark-text hover:text-[#C8873A] transition-colors">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-[#C8873A] to-[#E8A855] flex items-center justify-center shadow-sm">
                <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                    <path d="M9 21V12h6v9"/>
                </svg>
            </div>
            <div>
                <div class="text-sm font-semibold text-[#1a1a1a] tracking-[0.18em]">MASKANTECH</div>
                <div class="text-[10px] text-[#C8873A] tracking-[0.25em] uppercase">Admin</div>
            </div>
        </a>
    </div>

    <div class="flex items-center gap-4">
        <a href="{{ route('dashboard') }}" class="text-[11px] text-[#666] hover:text-[#C8873A] transition-colors tracking-[0.18em] uppercase">← Site</a>
        <div class="hidden sm:flex items-center gap-2 text-[11px] tracking-[0.18em] uppercase text-[#1f1f1f]">
            <span class="w-2 h-2 rounded-full bg-green-500 pulse-dot"></span>
            <span>{{ auth()->user()->name }}</span>
        </div>
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                class="w-9 h-9 rounded-xl bg-[#fff8f0] border border-[#efe6db] flex items-center justify-center text-[11px] text-[#1f1f1f] hover:border-[#C8873A] hover:bg-[#fff3e6] transition-colors shadow-sm">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </button>
            <div x-show="open" @click.away="open = false"
                class="absolute right-0 top-12 w-48 bg-white border border-[#efe6db] rounded-xl z-50 shadow-lg fade-in overflow-hidden">
                <div class="px-3 py-2 border-b border-[#f5efe8] bg-[#fff8f0]">
                    <p class="text-xs font-medium text-[#1a1a1a]">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-[#C8873A] uppercase tracking-[0.18em]">Administrateur</p>
                </div>
                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 text-xs text-[#555] hover:text-[#C8873A] hover:bg-[#fff3e6] transition-colors">Mon profil</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 text-xs text-red-500 hover:bg-[#fff3e6] transition-colors">Déconnexion</button>
                </form>
            </div>
        </div>
    </div>
</nav>

{{-- FLASH --}}
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

{{-- LAYOUT --}}
<div class="flex" style="min-height:calc(100vh - 44px)">

    {{-- SIDEBAR --}}
    <aside class="w-52 bg-dark-card border-r border-dark-border flex flex-col shrink-0 sticky top-11 h-[calc(100vh-44px)] overflow-y-auto">

        {{-- Stats rapides --}}
        @php
            $pendingCount  = \App\Models\Property::where('approval_status','pending')->count();
            $unverifiedCount = \App\Models\User::where('role','owner')->where('is_verified',false)->count();
            $unreadContacts = \App\Models\Contact::where('is_read',false)->count();
        @endphp

        <div class="p-3 border-b border-dark-border">
            <p class="text-[9px] text-dark-dim tracking-[.15em] uppercase mb-2">Alertes</p>
            <div class="flex flex-col gap-1">
                @if($pendingCount > 0)
                <div class="flex items-center justify-between">
                    <span class="text-[10px] text-dark-muted">Annonces en attente</span>
                    <span class="text-[9px] bg-orange-950 text-orange-400 border border-orange-800 px-1.5 py-0.5 rounded-sm">{{ $pendingCount }}</span>
                </div>
                @endif
                @if($unverifiedCount > 0)
                <div class="flex items-center justify-between">
                    <span class="text-[10px] text-dark-muted">Propriétaires non vérifiés</span>
                    <span class="text-[9px] bg-yellow-950 text-yellow-400 border border-yellow-800 px-1.5 py-0.5 rounded-sm">{{ $unverifiedCount }}</span>
                </div>
                @endif
                @if($unreadContacts > 0)
                <div class="flex items-center justify-between">
                    <span class="text-[10px] text-dark-muted">Messages non lus</span>
                    <span class="text-[9px] bg-blue-950 text-blue-400 border border-blue-800 px-1.5 py-0.5 rounded-sm">{{ $unreadContacts }}</span>
                </div>
                @endif
                @if($pendingCount === 0 && $unverifiedCount === 0 && $unreadContacts === 0)
                <p class="text-[10px] text-green-400">Tout est à jour ✓</p>
                @endif
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex flex-col p-2 gap-0.5 flex-1">
            <p class="text-[9px] text-dark-dim tracking-[.15em] uppercase px-2 py-1.5 mt-1">Navigation</p>

            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-2.5 px-2 py-2 text-[11px] text-dark-muted hover:text-white border-l-2 border-transparent hover:border-indigo-600 hover:bg-dark-card3 transition-all rounded-r-sm
                {{ request()->routeIs('admin.dashboard') ? 'nav-active bg-dark-card3' : '' }}">
                <svg class="w-3.5 h-3.5 shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="1" y="1" width="6" height="6" rx="1"/><rect x="9" y="1" width="6" height="6" rx="1"/>
                    <rect x="1" y="9" width="6" height="6" rx="1"/><rect x="9" y="9" width="6" height="6" rx="1"/>
                </svg>
                <span class="tracking-wider">TABLEAU DE BORD</span>
            </a>

            <a href="{{ route('admin.properties') }}"
                class="flex items-center gap-2.5 px-2 py-2 text-[11px] text-dark-muted hover:text-white border-l-2 border-transparent hover:border-indigo-600 hover:bg-dark-card3 transition-all rounded-r-sm
                {{ request()->routeIs('admin.properties') ? 'nav-active bg-dark-card3' : '' }}">
                <svg class="w-3.5 h-3.5 shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M2 6l6-4 6 4v8H2V6z"/><rect x="5" y="9" width="2" height="5" rx="0.5"/>
                    <rect x="9" y="9" width="2" height="5" rx="0.5"/>
                </svg>
                <span class="tracking-wider">ANNONCES</span>
                @if($pendingCount > 0)
                    <span class="ml-auto text-[9px] bg-orange-950 text-orange-400 border border-orange-800 px-1 py-0.5 rounded-sm">{{ $pendingCount }}</span>
                @endif
            </a>

            <a href="{{ route('admin.users') }}"
                class="flex items-center gap-2.5 px-2 py-2 text-[11px] text-dark-muted hover:text-white border-l-2 border-transparent hover:border-indigo-600 hover:bg-dark-card3 transition-all rounded-r-sm
                {{ request()->routeIs('admin.users*') ? 'nav-active bg-dark-card3' : '' }}">
                <svg class="w-3.5 h-3.5 shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="8" cy="5" r="3"/><path d="M2 14c0-3.3 2.7-6 6-6s6 2.7 6 6"/>
                </svg>
                <span class="tracking-wider">UTILISATEURS</span>
                @if($unverifiedCount > 0)
                    <span class="ml-auto text-[9px] bg-yellow-950 text-yellow-400 border border-yellow-800 px-1 py-0.5 rounded-sm">{{ $unverifiedCount }}</span>
                @endif
            </a>

            <a href="{{ route('admin.contacts') }}"
                class="flex items-center gap-2.5 px-2 py-2 text-[11px] text-dark-muted hover:text-white border-l-2 border-transparent hover:border-indigo-600 hover:bg-dark-card3 transition-all rounded-r-sm
                {{ request()->routeIs('admin.contacts') ? 'nav-active bg-dark-card3' : '' }}">
                <svg class="w-3.5 h-3.5 shrink-0" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="1" y="3" width="14" height="10" rx="1.5"/><path d="M1 5l7 5 7-5"/>
                </svg>
                <span class="tracking-wider">CONTACTS</span>
                @if($unreadContacts > 0)
                    <span class="ml-auto text-[9px] bg-blue-950 text-blue-400 border border-blue-800 px-1 py-0.5 rounded-sm">{{ $unreadContacts }}</span>
                @endif
            </a>
        </nav>

        {{-- Footer sidebar --}}
        <div class="p-3 border-t border-dark-border">
            <p class="text-[9px] text-dark-dim tracking-wider">MaskanTech Admin v1.0</p>
        </div>
    </aside>

    {{-- CONTENT --}}
    <main class="flex-1 overflow-auto">
        @yield('content')
    </main>
</div>

@stack('scripts')
</body>
</html>