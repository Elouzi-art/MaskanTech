{{-- resources/views/profile/edit.blade.php --}}
@extends('layouts.app')
@section('title', 'Mon profil')

@section('content')
<div style="padding:1.5rem;max-width:640px;margin:0 auto;display:flex;flex-direction:column;gap:1rem;">

    {{-- Breadcrumb --}}
    <div style="font-size:10px;letter-spacing:.12em;color:#555;font-family:'Courier New',monospace">
        <a href="{{ route('dashboard') }}" style="color:#555;text-decoration:none">DASHBOARD</a>
        <span style="margin:0 6px;color:#333">/</span>
        <span style="color:#d0d0d0">MON PROFIL</span>
    </div>

    {{-- Informations personnelles --}}
    <div style="background:#111;border:1px solid #222;border-radius:4px;padding:1.5rem">
        <div style="font-size:9px;letter-spacing:.18em;text-transform:uppercase;color:#444;margin-bottom:1.2rem;font-family:'Courier New',monospace">
            Informations personnelles
        </div>

        @if(session('status') === 'profile-updated')
        <div style="background:#052e16;border:1px solid #166534;color:#4ade80;font-size:11px;padding:8px 12px;border-radius:3px;margin-bottom:1rem;font-family:'Courier New',monospace">
            Profil mis à jour avec succès.
        </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div style="margin-bottom:.9rem">
                <label style="display:block;font-size:9px;letter-spacing:.15em;text-transform:uppercase;color:#555;margin-bottom:5px;font-family:'Courier New',monospace">
                    Nom complet
                </label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                       style="width:100%;background:#1a1a1a;border:1px solid {{ $errors->has('name') ? '#b91c1c' : '#2a2a2a' }};color:#d0d0d0;font-family:'Courier New',monospace;font-size:12px;padding:10px 12px;border-radius:3px;outline:none">
                @error('name')
                    <p style="color:#f87171;font-size:10px;margin-top:4px;font-family:'Courier New',monospace">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom:.9rem">
                <label style="display:block;font-size:9px;letter-spacing:.15em;text-transform:uppercase;color:#555;margin-bottom:5px;font-family:'Courier New',monospace">
                    Email
                </label>
                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                       style="width:100%;background:#1a1a1a;border:1px solid {{ $errors->has('email') ? '#b91c1c' : '#2a2a2a' }};color:#d0d0d0;font-family:'Courier New',monospace;font-size:12px;padding:10px 12px;border-radius:3px;outline:none">
                @error('email')
                    <p style="color:#f87171;font-size:10px;margin-top:4px;font-family:'Courier New',monospace">{{ $message }}</p>
                @enderror
            </div>

            <div style="margin-bottom:.9rem">
                <label style="display:block;font-size:9px;letter-spacing:.15em;text-transform:uppercase;color:#555;margin-bottom:5px;font-family:'Courier New',monospace">
                    Téléphone
                </label>
                <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                       placeholder="+212 6xx xx xx xx"
                       style="width:100%;background:#1a1a1a;border:1px solid #2a2a2a;color:#d0d0d0;font-family:'Courier New',monospace;font-size:12px;padding:10px 12px;border-radius:3px;outline:none">
            </div>

            <div style="margin-bottom:1.2rem">
                <label style="display:block;font-size:9px;letter-spacing:.15em;text-transform:uppercase;color:#555;margin-bottom:5px;font-family:'Courier New',monospace">
                    Adresse
                </label>
                <input type="text" name="address" value="{{ old('address', auth()->user()->address) }}"
                       placeholder="Votre adresse"
                       style="width:100%;background:#1a1a1a;border:1px solid #2a2a2a;color:#d0d0d0;font-family:'Courier New',monospace;font-size:12px;padding:10px 12px;border-radius:3px;outline:none">
            </div>

            {{-- Rôle (lecture seule) --}}
            <div style="margin-bottom:1.2rem">
                <label style="display:block;font-size:9px;letter-spacing:.15em;text-transform:uppercase;color:#555;margin-bottom:5px;font-family:'Courier New',monospace">
                    Rôle
                </label>
                <div style="background:#141414;border:1px solid #222;color:#666;font-family:'Courier New',monospace;font-size:12px;padding:10px 12px;border-radius:3px">
                    {{ auth()->user()->role_label }}
                </div>
            </div>

            <button type="submit"
                    style="background:#1e1b4b;border:1px solid #4338ca;color:#a5b4fc;font-family:'Courier New',monospace;font-size:11px;letter-spacing:.12em;padding:10px 20px;border-radius:3px;cursor:pointer">
                ENREGISTRER
            </button>
        </form>
    </div>

    {{-- Changer le mot de passe --}}
    <div style="background:#111;border:1px solid #222;border-radius:4px;padding:1.5rem">
        <div style="font-size:9px;letter-spacing:.18em;text-transform:uppercase;color:#444;margin-bottom:1.2rem;font-family:'Courier New',monospace">
            Changer le mot de passe
        </div>

        @if(session('status') === 'password-updated')
        <div style="background:#052e16;border:1px solid #166534;color:#4ade80;font-size:11px;padding:8px 12px;border-radius:3px;margin-bottom:1rem;font-family:'Courier New',monospace">
            Mot de passe mis à jour.
        </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div style="margin-bottom:.9rem">
                <label style="display:block;font-size:9px;letter-spacing:.15em;text-transform:uppercase;color:#555;margin-bottom:5px;font-family:'Courier New',monospace">
                    Mot de passe actuel
                </label>
                <input type="password" name="current_password" autocomplete="current-password"
                       style="width:100%;background:#1a1a1a;border:1px solid {{ $errors->updatePassword->has('current_password') ? '#b91c1c' : '#2a2a2a' }};color:#d0d0d0;font-family:'Courier New',monospace;font-size:12px;padding:10px 12px;border-radius:3px;outline:none">
                @if($errors->updatePassword->has('current_password'))
                    <p style="color:#f87171;font-size:10px;margin-top:4px;font-family:'Courier New',monospace">
                        {{ $errors->updatePassword->first('current_password') }}
                    </p>
                @endif
            </div>

            <div style="margin-bottom:.9rem">
                <label style="display:block;font-size:9px;letter-spacing:.15em;text-transform:uppercase;color:#555;margin-bottom:5px;font-family:'Courier New',monospace">
                    Nouveau mot de passe
                </label>
                <input type="password" name="password" autocomplete="new-password"
                       style="width:100%;background:#1a1a1a;border:1px solid {{ $errors->updatePassword->has('password') ? '#b91c1c' : '#2a2a2a' }};color:#d0d0d0;font-family:'Courier New',monospace;font-size:12px;padding:10px 12px;border-radius:3px;outline:none">
                @if($errors->updatePassword->has('password'))
                    <p style="color:#f87171;font-size:10px;margin-top:4px;font-family:'Courier New',monospace">
                        {{ $errors->updatePassword->first('password') }}
                    </p>
                @endif
            </div>

            <div style="margin-bottom:1.2rem">
                <label style="display:block;font-size:9px;letter-spacing:.15em;text-transform:uppercase;color:#555;margin-bottom:5px;font-family:'Courier New',monospace">
                    Confirmer le nouveau mot de passe
                </label>
                <input type="password" name="password_confirmation" autocomplete="new-password"
                       style="width:100%;background:#1a1a1a;border:1px solid #2a2a2a;color:#d0d0d0;font-family:'Courier New',monospace;font-size:12px;padding:10px 12px;border-radius:3px;outline:none">
            </div>

            <button type="submit"
                    style="background:#1e1b4b;border:1px solid #4338ca;color:#a5b4fc;font-family:'Courier New',monospace;font-size:11px;letter-spacing:.12em;padding:10px 20px;border-radius:3px;cursor:pointer">
                METTRE À JOUR
            </button>
        </form>
    </div>

    {{-- Supprimer le compte --}}
    <div style="background:#111;border:1px solid #2a1515;border-radius:4px;padding:1.5rem">
        <div style="font-size:9px;letter-spacing:.18em;text-transform:uppercase;color:#7f1d1d;margin-bottom:.6rem;font-family:'Courier New',monospace">
            Zone dangereuse
        </div>
        <p style="font-size:11px;color:#666;margin-bottom:1rem;font-family:'Courier New',monospace;line-height:1.5">
            Une fois supprimé, toutes vos données seront définitivement effacées.
        </p>

        <button onclick="document.getElementById('delete-modal').style.display='flex'"
                style="background:#1c0a0a;border:1px solid #7f1d1d;color:#f87171;font-family:'Courier New',monospace;font-size:11px;letter-spacing:.12em;padding:10px 20px;border-radius:3px;cursor:pointer">
            SUPPRIMER MON COMPTE
        </button>
    </div>

</div>

{{-- Modal suppression --}}
<div id="delete-modal"
     style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.8);z-index:50;align-items:center;justify-content:center">
    <div style="background:#111;border:1px solid #2a1515;border-radius:4px;padding:2rem;width:100%;max-width:400px;margin:1rem">
        <div style="font-size:13px;color:#fff;font-family:'Courier New',monospace;margin-bottom:.6rem;font-weight:600">
            Confirmer la suppression
        </div>
        <p style="font-size:11px;color:#666;margin-bottom:1.2rem;font-family:'Courier New',monospace;line-height:1.5">
            Entrez votre mot de passe pour confirmer la suppression définitive de votre compte.
        </p>

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <div style="margin-bottom:1rem">
                <label style="display:block;font-size:9px;letter-spacing:.15em;text-transform:uppercase;color:#555;margin-bottom:5px;font-family:'Courier New',monospace">
                    Mot de passe
                </label>
                <input type="password" name="password" placeholder="Votre mot de passe"
                       style="width:100%;background:#1a1a1a;border:1px solid #2a2a2a;color:#d0d0d0;font-family:'Courier New',monospace;font-size:12px;padding:10px 12px;border-radius:3px;outline:none">
                @if($errors->userDeletion->has('password'))
                    <p style="color:#f87171;font-size:10px;margin-top:4px;font-family:'Courier New',monospace">
                        {{ $errors->userDeletion->first('password') }}
                    </p>
                @endif
            </div>

            <div style="display:flex;gap:.6rem">
                <button type="submit"
                        style="background:#1c0a0a;border:1px solid #7f1d1d;color:#f87171;font-family:'Courier New',monospace;font-size:11px;letter-spacing:.1em;padding:9px 16px;border-radius:3px;cursor:pointer">
                    SUPPRIMER
                </button>
                <button type="button" onclick="document.getElementById('delete-modal').style.display='none'"
                        style="background:#1a1a1a;border:1px solid #2a2a2a;color:#666;font-family:'Courier New',monospace;font-size:11px;letter-spacing:.1em;padding:9px 16px;border-radius:3px;cursor:pointer">
                    ANNULER
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
