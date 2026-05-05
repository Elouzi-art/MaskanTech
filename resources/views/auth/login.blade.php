{{-- resources/views/auth/login.blade.php --}}
<x-guest-layout>

    <div class="mk-heading">
        <p class="mk-heading-sub">Authentification</p>
        <h1 class="mk-heading-title">CONNEXION</h1>
    </div>

    @if (session('status'))
        <div class="mk-flash-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="mk-field">
            <label for="email" class="mk-label">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   required autofocus autocomplete="username"
                   placeholder="exemple@email.com"
                   class="mk-input {{ $errors->has('email') ? 'error' : '' }}">
            @error('email')
                <p class="mk-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Mot de passe --}}
        <div class="mk-field">
            <label for="password" class="mk-label">Mot de passe</label>
            <input id="password" type="password" name="password"
                   required autocomplete="current-password"
                   class="mk-input {{ $errors->has('password') ? 'error' : '' }}">
            @error('password')
                <p class="mk-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Remember + Forgot --}}
        <div class="mk-row">
            <label class="mk-checkbox-label">
                <input type="checkbox" name="remember"
                       style="accent-color:#4338ca">
                Se souvenir de moi
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="mk-link">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        <button type="submit" class="mk-btn-primary">
            SE CONNECTER
        </button>
    </form>

    <p class="mk-footer-text">
        Pas encore de compte ?
        <a href="{{ route('register') }}" class="mk-link" style="margin-left:4px">
            S'inscrire
        </a>
    </p>

</x-guest-layout>
