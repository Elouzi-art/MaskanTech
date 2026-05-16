{{-- resources/views/admin_layout.blade.php --}}
{{-- Layout admin — sidebar violette, utilisé pour les pages d'administration --}}
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title','Admin - MaskanTech')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('ui.css') }}" rel="stylesheet">
    <style>
        :root{--sidebar-bg:#2D1B4E;--accent:#C8873A;--primary:#C8873A;--content-bg:#f8f8f8;--text:#0b0b0b}
    </style>
</head>
<body class="bg-[var(--content-bg)] text-[var(--text)] min-h-screen flex">
    <aside class="w-64 bg-[var(--sidebar-bg)] text-white min-h-screen p-4 fixed top-0 left-0 z-30">
        <div class="mb-8 font-bold text-xl tracking-wide px-2">MaskanTech</div>
        <nav class="space-y-1 text-sm">
            <a href="{{ route('dashboard') }}"       class="flex items-center gap-3 px-3 py-2 rounded hover:bg-white/10 transition-colors">🏠 <span>Dashboard</span></a>
            <a href="{{ route('admin.users') }}"     class="flex items-center gap-3 px-3 py-2 rounded hover:bg-white/10 transition-colors">👥 <span>Utilisateurs</span></a>
            <a href="{{ route('admin.properties') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-white/10 transition-colors">🏢 <span>Biens</span></a>
            <a href="{{ route('admin.contacts') }}"  class="flex items-center gap-3 px-3 py-2 rounded hover:bg-white/10 transition-colors">✉️ <span>Contacts</span></a>
            <a href="{{ route('properties.index') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-white/10 transition-colors">🌐 <span>Voir le site</span></a>
        </nav>
        <div class="absolute bottom-6 left-4 right-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded hover:bg-white/10 transition-colors text-sm text-red-300">
                    🚪 <span>Déconnexion</span>
                </button>
            </form>
        </div>
    </aside>
    <div class="flex-1 ml-64">
        <header class="bg-white border-b py-4 px-6 flex items-center justify-between sticky top-0 z-20">
            <div>
                <div class="font-semibold text-lg">@yield('section_title','Administration')</div>
                <div class="text-xs text-gray-500">@yield('section_sub','Panneau d\'administration MaskanTech')</div>
            </div>
            <div class="flex items-center gap-3">
                @auth
                <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>
                <div class="w-8 h-8 rounded-full bg-[#C8873A] flex items-center justify-center text-white text-xs font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                @endauth
            </div>
        </header>
        <main class="p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
