{{-- resources/views/auth/register.blade.php --}}
@extends('layouts.maskan')

@section('title', 'MaskanTech — Inscription')

@section('styles')
    body { overflow: hidden; }
    .login-wrap { display: flex; height: 100vh; }

    .left {
        width: 50%; position: relative; overflow: hidden;
        background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=900&q=85');
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
    .left-title { font-family: 'Playfair Display', serif; font-size: 36px; font-weight: 700; color: #fff; line-height: 1.2; margin-bottom: 12px; }
    .left-title em { color: #E8A855; font-style: normal; }
    .left-sub { font-size: 14px; color: rgba(255,255,255,0.6); line-height: 1.7; max-width: 380px; }

    .roles-preview { margin-top: 28px; display: flex; flex-direction: column; gap: 10px; }
    .role-item { display: flex; align-items: center; gap: 12px; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); border-radius: 10px; padding: 12px 16px; }
    .role-icon { font-size: 20px; }
    .role-name { font-size: 13px; font-weight: 500; color: #fff; }
    .role-desc { font-size: 11px; color: rgba(255,255,255,0.5); }

    .right { width: 50%; display: flex; flex-direction: column; justify-content: center; padding: 40px 56px; overflow-y: auto; }

    .form-title { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; color: #1a1a1a; margin-bottom: 4px; }
    .form-sub { font-size: 14px; color: #888; margin-bottom: 24px; }

    .role-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 10px; }
    .role-card { border: 1.5px solid #e8e3db; border-radius: 8px; padding: 12px 10px; text-align: center; cursor: pointer; transition: all 0.2s; position: relative; }
    .role-card input[type="radio"] { position: absolute; opacity: 0; width: 0; height: 0; }
    .role-card.selected { border-color: #C8873A; background: #fdf6ee; }
    .role-card-icon { font-size: 20px; margin-bottom: 4px; }
    .role-card-label { font-size: 12px; font-weight: 500; color: #1a1a1a; }

    .submit-btn { width: 100%; padding: 14px; background: #1a1a1a; color: #fff; border: none; border-radius: 8px; font-size: 15px; font-weight: 500; cursor: pointer; font-family: 'DM Sans', sans-serif; transition: background 0.2s; margin-top: 8px; }
    .submit-btn:hover { background: #C8873A; }

    .login-link { text-align: center; margin-top: 16px; font-size: 13px; color: #888; }
    .login-link a { color: #C8873A; text-decoration: none; font-weight: 500; }

    @media (max-width: 768px) { .left { display: none; } .right { width: 100%; padding: 32px 24px; } }
@endsection

@section('head')
<style> footer { display: none; } .mk-nav { display: none; } </style>
@endsection

@section('content')
<div class="login-wrap">

    {{-- LEFT --}}
    <div class="left">
        <div class="left-overlay"></div>
        <div class="left-content">
            <div class="left-tag">🇲🇦 MaskanTech</div>
            <h2 class="left-title">Rejoignez<br>la communauté<br><em>MaskanTech</em></h2>
            <p class="left-sub">Des milliers de logements vérifiés partout au Maroc. Créez votre compte en moins de 2 minutes.</p>
            <div class="roles-preview">
                <div class="role-item"><div class="role-icon">🏠</div><div><div class="role-name">Propriétaire</div><div class="role-desc">Publiez vos biens et gérez vos locataires</div></div></div>
                <div class="role-item"><div class="role-icon">🎓</div><div><div class="role-name">Étudiant</div><div class="role-desc">Trouvez un logement proche de votre université</div></div></div>
                <div class="role-item"><div class="role-icon">💼</div><div><div class="role-name">Locataire</div><div class="role-desc">Accédez à toutes les annonces disponibles</div></div></div>
            </div>
        </div>
    </div>

    {{-- RIGHT --}}
    <div class="right">
        <a href="/" class="mk-logo" style="margin-bottom:24px;display:flex;">
            <div class="mk-logo-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                    <path d="M9 21V12h6v9"/>
                </svg>
            </div>
            <span class="mk-logo-text">Maskan<span>Tech</span></span>
        </a>

        <h1 class="form-title">Créer un compte</h1>
        <p class="form-sub">Remplissez le formulaire pour rejoindre MaskanTech.</p>

        @if($errors->any())
            <div style="background:#fff5f5;border:1px solid #fca5a5;border-radius:8px;padding:12px 16px;margin-bottom:16px;">
                <ul style="list-style:none;padding:0;margin:0;font-size:13px;color:#dc2626;">
                    @foreach($errors->all() as $error)<li>• {{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mk-form-group">
                <label>Nom complet</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Ex : Mohammed Alami" required>
                @error('name')<p style="color:#dc2626;font-size:12px;margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <div class="mk-form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="exemple@email.com" required>
                @error('email')<p style="color:#dc2626;font-size:12px;margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <div class="mk-form-group">
                <label>Mot de passe</label>
                <input type="password" name="password" placeholder="Minimum 8 caractères" required>
                @error('password')<p style="color:#dc2626;font-size:12px;margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <div class="mk-form-group">
                <label>Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" placeholder="Répétez le mot de passe" required>
            </div>

            <div class="mk-form-group">
                <label>Vous êtes</label>
                <div class="role-grid">
                    <label class="role-card">
                        <input type="radio" name="role" value="client" {{ old('role','client')==='client'?'checked':'' }}>
                        <div class="role-card-icon">💼</div>
                        <div class="role-card-label">Locataire</div>
                    </label>
                    <label class="role-card">
                        <input type="radio" name="role" value="student" {{ old('role')==='student'?'checked':'' }}>
                        <div class="role-card-icon">🎓</div>
                        <div class="role-card-label">Étudiant</div>
                    </label>
                    <label class="role-card">
                        <input type="radio" name="role" value="owner" {{ old('role')==='owner'?'checked':'' }}>
                        <div class="role-card-icon">🏠</div>
                        <div class="role-card-label">Propriétaire</div>
                    </label>
                </div>
                @error('role')<p style="color:#dc2626;font-size:12px;margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <button type="submit" class="submit-btn">Créer mon compte</button>
        </form>

        <div class="login-link">
            Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a>
        </div>
    </div>

</div>

<script>
document.querySelectorAll('.role-card input[type="radio"]').forEach(r => {
    r.addEventListener('change', () => {
        document.querySelectorAll('.role-card').forEach(c => c.classList.remove('selected'));
        if (r.checked) r.closest('.role-card').classList.add('selected');
    });
    if (r.checked) r.closest('.role-card').classList.add('selected');
});
</script>
@endsection
