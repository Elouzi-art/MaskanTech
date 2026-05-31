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
        :root{--sidebar-bg:#2D1B4E;--accent:#000000;--primary:#000000;--content-bg:#ffffff;--text:#0b0b0b}
    </style>
</head>
<body class="bg-[var(--content-bg)] text-[var(--text)] min-h-screen flex">
    <aside class="w-64 bg-[var(--sidebar-bg)] text-white min-h-screen p-4 fixed">
        <div class="mb-6 font-bold text-xl">MaskanTech</div>
        <nav class="space-y-2 text-sm">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-white/5">🏠 <span>Dashboard</span></a>
        </nav>
    </aside>
    <div class="flex-1 ml-64">
        <header class="bg-white border-b py-4 px-6 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <button class="text-lg">≡</button>
                <div>
                    <div class="font-semibold text-lg">@yield('section_title','Administration')</div>
                    <div class="text-xs text-gray-500">@yield('section_sub','General')</div>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <button class="text-gray-600">🏳️</button>
                <div class="w-8 h-8 rounded-full bg-gray-300"></div>
            </div>
        </header>
        <main class="p-6">
            <div class="bg-white shadow rounded p-6">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>