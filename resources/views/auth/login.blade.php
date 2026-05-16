@extends('layouts.maskan')

@section('title', 'MaskanTech — Connexion')

@section('styles')
        body { overflow: hidden; }
        .login-wrap { display: flex; height: 100vh; }

        /* LEFT */
        .left {
            width: 50%; position: relative; overflow: hidden;
            background-image: url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=900&q=85');
            background-size: cover; background-position: center;
        }
        .left-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(10,7,3,0.88) 0%, rgba(10,7,3,0.3) 60%, transparent 100%);
        }
        .left-content {
            position: absolute; bottom: 0; left: 0; right: 0;
            z-index: 3; padding: 48px;
        }
        .left-tag {
            display: inline-block;
            background: rgba(200,135,58,0.25); border: 1px solid rgba(200,135,58,0.5);
            color: #E8A855; font-size: 11px; letter-spacing: 2px;
            text-transform: uppercase; padding: 6px 14px; border-radius: 20px;
            margin-bottom: 16px;
        }
        .left-title {
            font-family: 'Playfair Display', serif;
            font-size: 38px; font-weight: 700; color: #fff;
            line-height: 1.2; margin-bottom: 12px;
        }
        .left-title em { color: #E8A855; font-style: normal; }
        .left-sub { font-size: 14px; color: rgba(255,255,255,0.6); line-height: 1.7; max-width: 380px; }

        /* TESTIMONIAL */
        .testimonial {
            margin-top: 32px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 12px; padding: 20px 24px;
        }
        .testimonial-text { font-size: 14px; color: rgba(255,255,255,0.85); line-height: 1.7; font-style: italic; margin-bottom: 14px; }
        .testimonial-author { display: flex; align-items: center; gap: 12px; }
        .testimonial-avatar {
            width: 38px; height: 38px; border-radius: 50%;
            background: linear-gradient(135deg, #C8873A, #E8A855);
            display: flex; align-items: center; justify-content: center;
            font-size: 14px; font-weight: 600; color: #fff;
        }
        .testimonial-name { font-size: 13px; font-weight: 500; color: #fff; }
        .testimonial-role { font-size: 12px; color: rgba(255,255,255,0.5); }

        /* RIGHT */
        .right {
            width: 50%; display: flex; flex-direction: column;
            justify-content: center; padding: 56px;
        }

        .form-title { font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 700; color: #1a1a1a; margin-bottom: 6px; }
        .form-sub { font-size: 14px; color: #888; margin-bottom: 36px; }

        .divider { display: flex; align-items: center; gap: 14px; margin: 24px 0; }
        .divider-line { flex: 1; height: 1px; background: #e8e3db; }
        .divider-text { font-size: 12px; color: #aaa; }

        .social-btns { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 4px; }
        .social-btn {
            display: flex; align-items: center; justify-content: center; gap: 8px;
            padding: 12px; border: 1.5px solid #e8e3db; border-radius: 8px;
            font-size: 13px; font-weight: 500; color: #1a1a1a;
            text-decoration: none; cursor: pointer; background: #fff;
            transition: border-color 0.2s, background 0.2s;
        }
        .social-btn:hover { border-color: #C8873A; background: #fdf6ee; }
        .social-btn img { width: 18px; height: 18px; }

        .forgot { text-align: right; margin-top: -10px; margin-bottom: 18px; }
        .forgot a { font-size: 13px; color: #C8873A; text-decoration: none; }
        .forgot a:hover { text-decoration: underline; }

        .submit-btn {
            width: 100%; padding: 15px;
            background: #1a1a1a; color: #fff; border: none;
            border-radius: 8px; font-size: 15px; font-weight: 500;
            cursor: pointer; font-family: 'DM Sans', sans-serif;
            transition: background 0.2s;
        }
        .submit-btn:hover { background: #C8873A; }

        .register-link { text-align: center; margin-top: 20px; font-size: 13px; color: #888; }
        .register-link a { color: #C8873A; text-decoration: none; font-weight: 500; }
@endsection

@section('head')
    <style>
        footer { display: none; }
        .mk-nav { display: none; }
    </style>
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
                <p class="testimonial-text">"Grâce à MaskanTech j'ai trouvé mon appartement à Casablanca en moins d'une semaine. Une plateforme vraiment sérieuse !"</p>
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
        <a href="/" class="mk-logo" style="margin-bottom:36px;display:flex;">
            <div class="mk-logo-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                    <path d="M9 21V12h6v9"/>
                </svg>
            </div>
            <span class="mk-logo-text">Maskan<span>Tech</span></span>
        </a>

        <h1 class="form-title">Connexion</h1>
        <p class="form-sub">Bienvenue ! Entrez vos identifiants pour accéder à votre espace.</p>

        <div class="social-btns">
            <a href="#" class="social-btn">
                <svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
                Continuer avec Google
            </a>
            <a href="#" class="social-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="#1877F2"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                Continuer avec Facebook
            </a>
        </div>

        <div class="divider">
            <div class="divider-line"></div>
            <span class="divider-text">ou avec votre email</span>
            <div class="divider-line"></div>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mk-form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="exemple@email.com" required>
            </div>

            <div class="mk-form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>

            <div class="forgot">
                <a href="#">Mot de passe oublié ?</a>
            </div>

            <div class="remember">
                <input type="checkbox" id="remember">
                <label for="remember">Se souvenir de moi</label>
            </div>

            <button type="submit" class="submit-btn">Se connecter</button>
        </form>

        <div class="register-link">
            Pas encore de compte ? <a href="/register">S'inscrire gratuitement</a>
        </div>
    </div>

</div>
@endsection