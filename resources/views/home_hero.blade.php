<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>MaskanTech — Accueil</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('ui.css') }}" rel="stylesheet">
    <style>
        :root{--sidebar-bg:#2D1B4E;--accent:#000000;--content-bg:#ffffff;--text:#0b0b0b}
    </style>
</head>
<body class="min-h-screen bg-[var(--content-bg)] text-[var(--text)]">

<header class="header-fixed">
    <nav class="navbar">
        <a href="/" class="logo">
            <img src="{{ asset('favicon.ico') }}" alt="logo" style="width:40px;height:40px;border-radius:50%">
            <h2>MaskanTech</h2>
        </a>
        <div class="links">
            <a href="#">Accueil</a>
            <a href="#">Annonces</a>
            <a href="#">Contact</a>
            <a href="{{ route('register') }}" class="login-btn">S'inscrire</a>
        </div>
    </nav>
</header>

<!-- Hero background -->
<section class="relative h-screen w-full bg-hero" style="background-image:url('{{ asset('images/hero.jpg') }}')">
    <div class="absolute inset-0 bg-black/30"></div>

    <div class="absolute inset-0 flex items-center justify-center p-6">
        <!-- Popup structure matching prototype CSS -->
        <div class="form-popup" role="dialog" aria-labelledby="login-title">
            <button class="close-btn form-close" aria-label="Fermer">✕</button>
            <div class="form-box">
                <div class="form-details login" style="background-image:url('{{ asset('images/hero-panel.jpg') }}')">
                    <div class="form-details-inner center">
                        <h3 class="text-white text-2xl font-bold">Welcome Back</h3>
                        <p class="text-white text-sm mt-3">Please login using your personal information to stay connected with us.</p>
                    </div>
                </div>
                <div class="form-content card">
                    <h2 id="login-title" class="center">LOGIN</h2>

                    <form method="POST" action="{{ route('login') }}" novalidate class="mt-4">
                        @csrf
                        @if(session('error'))
                            <div class="text-red-600 text-sm mb-2">{{ session('error') }}</div>
                        @endif

                        <div class="input-field">
                            <input name="email" type="email" required placeholder=" " />
                            <label>Email</label>
                        </div>

                        <div class="input-field">
                            <input name="password" type="password" required placeholder=" " />
                            <label>Mot de passe</label>
                        </div>

                        <div class="flex items-center justify-between mt-3">
                            <label class="inline-flex items-center gap-2"><input type="checkbox" name="remember"> Se souvenir</label>
                            <a href="#" class="text-muted">Mot de passe oublié ?</a>
                        </div>

                        <button type="submit" class="btn-primary w-full mt-6">Log In</button>

                        <p class="center text-muted mt-2">Don't have an account? <a href="{{ route('register') }}">Signup</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Minimal JS to wire close button (keeps popup visible by default)
document.addEventListener('click', function(e){
    if(e.target.closest('.form-close') || e.target.closest('.modal-close')){
        const popup = document.querySelector('.form-popup');
        if(popup) popup.style.display = 'none';
    }
});
</script>

</body>
</html>