{{-- resources/views/auth/register.blade.php --}}
<x-guest-layout>

    <div class="mk-heading">
        <p class="mk-heading-sub">Créer un compte</p>
        <h1 class="mk-heading-title">INSCRIPTION</h1>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Nom --}}
        <div class="mk-field">
            <label for="name" class="mk-label">Nom complet</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                   required autofocus autocomplete="name"
                   placeholder="Votre nom"
                   class="mk-input {{ $errors->has('name') ? 'error' : '' }}">
            @error('name')
                <p class="mk-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mk-field">
            <label for="email" class="mk-label">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   required autocomplete="username"
                   placeholder="exemple@email.com"
                   class="mk-input {{ $errors->has('email') ? 'error' : '' }}">
            @error('email')
                <p class="mk-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Rôle --}}
        <div class="mk-field">
            <label class="mk-label">Je suis</label>
            <div class="mk-role-grid">

                <label class="mk-role-card">
                    <input type="radio" name="role" value="client"
                           {{ old('role', 'client') === 'client' ? 'checked' : '' }}>
                    <div class="mk-role-box">
                        <span class="mk-role-name">Locataire</span>
                        <span class="mk-role-desc">Je cherche un logement</span>
                    </div>
                </label>

                <label class="mk-role-card">
                    <input type="radio" name="role" value="student"
                           {{ old('role') === 'student' ? 'checked' : '' }}>
                    <div class="mk-role-box">
                        <span class="mk-role-name">Étudiant</span>
                        <span class="mk-role-desc">Je cherche un logement étudiant</span>
                    </div>
                </label>

                <label class="mk-role-card">
                    <input type="radio" name="role" value="owner"
                           {{ old('role') === 'owner' ? 'checked' : '' }}>
                    <div class="mk-role-box">
                        <span class="mk-role-name">Propriétaire</span>
                        <span class="mk-role-desc">Je loue mon bien</span>
                    </div>
                </label>

            </div>
            @error('role')
                <p class="mk-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Mot de passe --}}
        <div class="mk-field">
            <label for="password" class="mk-label">Mot de passe</label>
            <input id="password" type="password" name="password"
                   required autocomplete="new-password"
                   class="mk-input {{ $errors->has('password') ? 'error' : '' }}">
            @error('password')
                <p class="mk-error">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirmation --}}
        <div class="mk-field">
            <label for="password_confirmation" class="mk-label">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   required autocomplete="new-password"
                   class="mk-input">
        </div>

        <button type="submit" class="mk-btn-primary">
            CRÉER MON COMPTE
        </button>
    </form>

    <p class="mk-footer-text">
        Déjà un compte ?
        <a href="{{ route('login') }}" class="mk-link" style="margin-left:4px">
            Se connecter
        </a>
    </p>

</x-guest-layout>
