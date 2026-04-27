<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>MaskanTech — Accueil</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('ui.css') }}" rel="stylesheet">
    <style>
        :root{--sidebar-bg:#2D1B4E;--accent:#2563EB;--content-bg:#F7F9FC;--text:#374151}
        .accent{background-color:var(--accent)}
    </style>
</head>
<body class="min-h-screen bg-[var(--content-bg)] text-[var(--text)] font-sans">
    <div class="max-w-6xl mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Left: Login card -->
            <div>
                <div class="card neu p-8">
                    <h2 class="text-2xl font-bold mb-2">Connexion</h2>
                    <p class="text-sm text-gray-500 mb-6">Accédez à votre espace MaskanTech</p>

                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf
                        @if(session('error'))
                            <div class="text-red-600 text-sm mb-2">{{ session('error') }}</div>
                        @endif

                        <div>
                            <label class="block text-sm font-medium mb-1">Email</label>
                            <input name="email" type="email" required class="input w-full" placeholder="vous@exemple.com">
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Mot de passe</label>
                            <input name="password" type="password" required class="input w-full" placeholder="••••••••">
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <label class="inline-flex items-center gap-2"><input type="checkbox" name="remember"> Se souvenir</label>
                            <a href="#" class="text-[var(--primary)]">Mot de passe oublié ?</a>
                        </div>

                        <div>
                            <button type="submit" class="btn-primary w-full">Se connecter</button>
                        </div>

                        <div class="text-center text-sm text-gray-600">Pas encore de compte ? <a href="{{ route('register') }}" class="text-[var(--primary)]">S'inscrire</a></div>
                    </form>
                </div>

                <div class="mt-6 text-xs text-gray-500">
                    En vous connectant, vous acceptez les conditions d'utilisation et la politique de confidentialité.
                </div>
            </div>

            <!-- Right: Hero / Description -->
            <div>
                <div class="bg-white shadow-lg rounded-lg p-10 h-full flex flex-col justify-center">
                    <h1 class="text-3xl md:text-4xl font-extrabold mb-4">MaskanTech — La plateforme locative marocaine</h1>
                    <p class="text-gray-700 mb-6">Que vous soyez propriétaire ou locataire, MaskanTech vous connecte directement pour louer sans intermédiaire. Créez, recherchez, et gérez vos annonces facilement.</p>

                    <div class="space-y-3">
                        <p class="font-semibold">Vous êtes :</p>
                        <div class="flex flex-wrap gap-3 mt-2">
                            <a href="#" class="px-4 py-2 border rounded text-sm">Propriétaire</a>
                            <a href="#" class="px-4 py-2 border rounded text-sm">Locataire</a>
                            <a href="#" class="px-4 py-2 border rounded text-sm">Étudiant</a>
                        </div>
                    </div>

                    <div class="mt-8 text-sm text-gray-500">
                        <span class="inline-block mr-3">✅ Recherche multicritère</span>
                        <span class="inline-block mr-3">✅ Messagerie & réservations</span>
                        <span class="inline-block">✅ Vérification propriétaires</span>
                    </div>

                    <div class="mt-8">
                        <a href="#" class="inline-block px-6 py-3 rounded bg-[var(--accent)] text-white font-semibold">Découvrir les annonces</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>