@extends('layouts.maskan')
@section('title', 'MaskanTech — Connexion')

@section('head')
<style>
    footer { display: none; }
    .mk-nav { display: none; }
</style>
@endsection

@section('styles')
* { box-sizing: border-box; }
body { overflow: hidden; }
.login-wrap { display: flex; height: 100vh; width: 100%; }

/* LEFT */
.left {
    width: 50%; position: relative; overflow: hidden; flex-shrink: 0;
    background-image: url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=900&q=85');
    background-size: cover; background-position: center;
}
.left-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to top, rgba(10,7,3,0.88) 0%, rgba(10,7,3,0.3) 60%, transparent 100%);
}
.left-content { position: absolute; bottom: 0; left: 0; right: 0; z-index: 3; padding: 48px; }
.left-tag {
    display: inline-block;
    background: rgba(200,135,58,0.25); border: 1px solid rgba(200,135,58,0.5);
    color: #E8A855; font-size: 11px; letter-spacing: 2px;
    text-transform: uppercase; padding: 6px 14px; border-radius: 20px; margin-bottom: 16px;
}
.left-title { font-family: 'Playfair Display', serif; font-size: 38px; font-weight: 700; color: #fff; line-height: 1.2; margin-bottom: 12px; }
.left-title em { color: #E8A855; font-style: normal; }
.left-sub { font-size: 14px; color: rgba(255,255,255,0.6); line-height: 1.7; max-width: 380px; }
.testimonial { margin-top: 32px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.15); border-radius: 12px; padding: 20px 24px; }
.testimonial-text { font-size: 14px; color: rgba(255,255,255,0.85); line-height: 1.7; font-style: italic; margin-bottom: 14px; }
.testimonial-author { display: flex; align-items: center; gap: 12px; }
.testimonial-avatar { width: 38px; height: 38px; border-radius: 50%; background: linear-gradient(135deg, #C8873A, #E8A855); display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 600; color: #fff; flex-shrink: 0; }
.testimonial-name { font-size: 13px; font-weight: 500; color: #fff; }
.testimonial-role { font-size: 12px; color: rgba(255,255,255,0.5); }

/* RIGHT */
.right {
    width: 50%; display: flex; flex-direction: column;
    justify-content: center; padding: 56px 56px;
    overflow-y: auto; flex-shrink: 0;
}
.form-title { font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px; }
.form-sub { font-size: 14px; color: #888; margin-bottom: 32px; }

.form-group { margin-bottom: 18px; }
.form-group label { font-size: 12px; color: #555; font-weight: 500; display: block; margin-bottom: 7px; }
.form-group input {
    width: 100%; padding: 12px 16px;
    border: 1.5px solid #e8e3db; border-radius: 8px;
    font-size: 14px; color: #1a1a1a; outline: none;
    transition: border-color 0.2s; background: #fff;
    font-family: 'DM Sans', sans-serif;
}
.form-group input:focus { border-color: #C8873A; }

.forgot { text-align: right; margin-top: -10px; margin-bottom: 18px; }
.forgot a { font-size: 13px; color: #C8873A; text-decoration: none; }
.forgot a:hover { text-decoration: underline; }

.remember { display: flex; align-items: center; gap: 8px; margin-bottom: 20px; }
.remember input { width: 16px; height: 16px; accent-color: #C8873A; cursor: pointer; }
.remember label { font-size: 13px; color: #555; cursor: pointer; }

.submit-btn {
    width: 100%; padding: 15px; background: #1a1a1a; color: #fff; border: none;
    border-radius: 8px; font-size: 15px; font-weight: 500; cursor: pointer;
    font-family: 'DM Sans', sans-serif; transition: background 0.2s;
}
.submit-btn:hover { background: #C8873A; }

.divider { display: flex; align-items: center; gap: 14px; margin: 24px 0; }
.divider-line { flex: 1; height: 1px; background: #e8e3db; }
.divider-text { font-size: 12px; color: #aaa; white-space: nowrap; }

.register-link { text-align: center; margin-top: 20px; font-size: 13px; color: #888; }
.register-link a { color: #C8873A; text-decoration: none; font-weight: 500; }
.register-link a:hover { text-decoration: underline; }

.error-box { background: #fff5f5; border: 1px solid #fca5a5; border-radius: 8px; padding: 12px 16px; margin-bottom: 20px; }
.error-box p { font-size: 13px; color: #dc2626; margin: 0; }

/* RESPONSIVE */
@media(max-width: 768px) {
    body { overflow: auto; }
    .login-wrap { flex-direction: column; height: auto; min-height: 100vh; }
    .left { width: 100%; height: 220px; flex-shrink: 0; }
    .left-content { padding: 24px; }
    .left-title { font-size: 26px; }
    .testimonial { display: none; }
    .right { width: 100%; padding: 32px 24px; justify-content: flex-start; }
    .form-title { font-size: 24px; }
}
@media(max-width: 480px) {
    .right { padding: 24px 16px; }
}
@endsection

@section('content')
<div class="login-wrap">

    {{-- LEFT --}}
    <div class="left">
        <div class="left-overlay"></div>
        <div class="left-content">
            <div class="left-tag">🇲🇦 MaskanTech</div>
            <h2 class="left-title">Bon retour<br>parmi <em>nous</em> !</h2>
            <p class="left-sub">Connectez-vous et retrouvez vos annonces favorites, vos messages et vos rendez-vous.</p>
            <div class="testimonial">
                <p class="testimonial-text">« Grâce à MaskanTech j'ai trouvé mon appartement à Casablanca en moins d'une semaine. Une plateforme vraiment sérieuse ! »</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">SB</div>
                    <div>
                        <div class="testimonial-name">Sara Benali</div>
                        <div class="testimonial-role">Locataire · Casablanca</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- RIGHT --}}
    <div class="right">
        <a href="{{ route('home') }}" class="mk-logo" style="margin-bottom:32px;display:inline-flex;align-items:center;gap:10px;text-decoration:none;">
            <div class="mk-logo-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="width:20px;height:20px">
                    <path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                    <path d="M9 21V12h6v9"/>
                </svg>
            </div>
            <span class="mk-logo-text">Maskan<span>Tech</span></span>
        </a>

        <h1 class="form-title">Connexion</h1>
        <p class="form-sub">Bienvenue ! Entrez vos identifiants pour accéder à votre espace.</p>

        @if($errors->any())
        <div class="error-box">
            @foreach($errors->all() as $error)
            <p>• {{ $error }}</p>
            @endforeach
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                       placeholder="exemple@email.com" required autofocus autocomplete="email">
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password"
                       placeholder="••••••••" required autocomplete="current-password">
            </div>

            <div class="forgot">
                <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
            </div>

            <div class="remember">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Se souvenir de moi</label>
            </div>

            <button type="submit" class="submit-btn">Se connecter</button>
        </form>

        <div class="divider">
            <div class="divider-line"></div>
            <span class="divider-text">Pas encore de compte ?</span>
            <div class="divider-line"></div>
        </div>

        <div class="register-link">
            <a href="{{ route('register') }}" style="display:block;width:100%;padding:13px;border:1.5px solid #e8e3db;border-radius:8px;text-align:center;color:#1a1a1a;font-weight:500;transition:all 0.2s"
               onmouseover="this.style.borderColor='#C8873A';this.style.color='#C8873A'"
               onmouseout="this.style.borderColor='#e8e3db';this.style.color='#1a1a1a'">
                Créer un compte gratuitement
            </a>
        </div>
    </div>

</div>
@endsection
