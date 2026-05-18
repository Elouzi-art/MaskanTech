@extends('layouts.maskan')
@section('title', 'MaskanTech — Mon profil')

@section('styles')
.profile-wrap { max-width: 680px; margin: 0 auto; padding: 40px 24px; }
.profile-title { font-family: 'Playfair Display', serif; font-size: 26px; font-weight: 700; color: #1a1a1a; margin-bottom: 4px; }
.profile-sub { font-size: 13px; color: #888; margin-bottom: 32px; }

.profile-card { background: #fff; border: 1px solid #ede9e3; border-radius: 12px; padding: 28px; margin-bottom: 20px; }
.profile-card-title { font-size: 11px; color: #aaa; letter-spacing: 2px; text-transform: uppercase; font-weight: 500; margin-bottom: 22px; padding-bottom: 14px; border-bottom: 1px solid #f5f2ee; }

.form-group { display: flex; flex-direction: column; gap: 5px; margin-bottom: 16px; }
.form-group:last-of-type { margin-bottom: 0; }
.form-label { font-size: 12px; color: #555; font-weight: 500; }
.form-input {
    padding: 11px 14px; border: 1.5px solid #e8e3db; border-radius: 8px;
    font-size: 14px; font-family: 'DM Sans', sans-serif; color: #1a1a1a;
    outline: none; transition: border-color 0.2s; background: #fff; width: 100%; box-sizing: border-box;
}
.form-input:focus { border-color: #C8873A; }
.form-input.error { border-color: #ef4444; }
.form-input[disabled], .form-input-readonly {
    background: #f8f7f4; color: #888; cursor: default;
    padding: 11px 14px; border: 1.5px solid #ede9e3; border-radius: 8px;
    font-size: 14px; font-family: 'DM Sans', sans-serif; width: 100%; box-sizing: border-box;
}
.form-error { font-size: 11px; color: #ef4444; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
@media(max-width:640px) { .form-row { grid-template-columns: 1fr; } }

.save-btn {
    padding: 11px 24px; background: #1a1a1a; color: #fff; border: none;
    border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer;
    font-family: 'DM Sans', sans-serif; transition: background 0.2s; float: right;
}
.save-btn:hover { background: #C8873A; }
.save-btn:after { content: ''; display: table; clear: both; }

/* Zone dangereuse */
.danger-card { background: #fff; border: 1px solid #fca5a5; border-radius: 12px; padding: 28px; }
.danger-title { font-size: 11px; color: #ef4444; letter-spacing: 2px; text-transform: uppercase; font-weight: 500; margin-bottom: 12px; padding-bottom: 14px; border-bottom: 1px solid #fee2e2; }
.danger-text { font-size: 13px; color: #888; line-height: 1.6; margin-bottom: 16px; }
.danger-btn {
    padding: 10px 20px; border: 1.5px solid #fca5a5; color: #ef4444; border-radius: 8px;
    background: transparent; font-size: 13px; cursor: pointer;
    font-family: 'DM Sans', sans-serif; transition: all 0.2s;
}
.danger-btn:hover { background: #fff5f5; border-color: #ef4444; }

/* Modal */
.modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 999; display: flex; align-items: center; justify-content: center; padding: 24px; }
.modal-box { background: #fff; border-radius: 14px; padding: 32px; width: 100%; max-width: 440px; box-shadow: 0 20px 60px rgba(0,0,0,0.2); }
.modal-title { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; color: #1a1a1a; margin-bottom: 8px; }
.modal-desc { font-size: 13px; color: #888; line-height: 1.6; margin-bottom: 20px; }
.modal-actions { display: flex; gap: 10px; justify-content: flex-end; margin-top: 20px; }
.modal-cancel {
    padding: 10px 20px; border: 1.5px solid #e8e3db; color: #555; border-radius: 8px;
    background: transparent; font-size: 13px; cursor: pointer; font-family: 'DM Sans', sans-serif; transition: all 0.2s;
}
.modal-cancel:hover { border-color: #C8873A; color: #C8873A; }
.modal-confirm {
    padding: 10px 20px; background: #ef4444; color: #fff; border: none;
    border-radius: 8px; font-size: 13px; font-weight: 500; cursor: pointer;
    font-family: 'DM Sans', sans-serif; transition: background 0.2s;
}
.modal-confirm:hover { background: #dc2626; }

/* Alert success */
.alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 12px 16px; font-size: 13px; color: #15803d; margin-bottom: 16px; }
@endsection

@section('content')
<div class="profile-wrap">

    <div class="profile-title">Mon profil</div>
    <div class="profile-sub">{{ auth()->user()->role_label }} — {{ auth()->user()->email }}</div>

    {{-- Informations personnelles --}}
    <div class="profile-card">
        <div class="profile-card-title">Informations personnelles</div>

        @if(session('status') === 'profile-updated')
            <div class="alert-success">✓ Profil mis à jour avec succès.</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nom complet</label>
                    <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                           class="form-input @error('name') error @enderror">
                    @error('name') <span class="form-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                           class="form-input @error('email') error @enderror">
                    @error('email') <span class="form-error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                           placeholder="+212 6XX XXX XXX" class="form-input">
                </div>
                <div class="form-group">
                    <label class="form-label">Adresse</label>
                    <input type="text" name="address" value="{{ old('address', auth()->user()->address) }}"
                           placeholder="Votre adresse" class="form-input">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Rôle</label>
                <div class="form-input-readonly">{{ auth()->user()->role_label }}</div>
            </div>

            <div style="margin-top:20px">
                <button type="submit" class="save-btn">Sauvegarder les modifications</button>
            </div>
        </form>
    </div>

    {{-- Changer mot de passe --}}
    <div class="profile-card">
        <div class="profile-card-title">Changer le mot de passe</div>

        @if(session('status') === 'password-updated')
            <div class="alert-success">✓ Mot de passe mis à jour.</div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Mot de passe actuel</label>
                <input type="password" name="current_password" autocomplete="current-password"
                       class="form-input @error('current_password', 'updatePassword') error @enderror">
                @error('current_password', 'updatePassword') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nouveau mot de passe</label>
                    <input type="password" name="password" autocomplete="new-password"
                           class="form-input @error('password', 'updatePassword') error @enderror">
                    @error('password', 'updatePassword') <span class="form-error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label">Confirmer</label>
                    <input type="password" name="password_confirmation" autocomplete="new-password"
                           class="form-input">
                </div>
            </div>

            <div style="margin-top:20px">
                <button type="submit" class="save-btn">Mettre à jour</button>
            </div>
        </form>
    </div>

    {{-- Zone dangereuse --}}
    <div class="danger-card">
        <div class="danger-title">Zone dangereuse</div>
        <p class="danger-text">La suppression de votre compte est définitive. Toutes vos données — annonces, messages, rendez-vous — seront effacées.</p>
        <button class="danger-btn" onclick="document.getElementById('delete-modal').style.display='flex'">
            Supprimer mon compte
        </button>
    </div>

</div>

{{-- Modal suppression --}}
<div id="delete-modal" style="display:none" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-title">Confirmer la suppression</div>
        <p class="modal-desc">Entrez votre mot de passe pour confirmer la suppression définitive de votre compte. Cette action est irréversible.</p>

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <div class="form-group">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" placeholder="Votre mot de passe" required
                       class="form-input @error('password', 'userDeletion') error @enderror">
                @error('password', 'userDeletion') <span class="form-error">{{ $message }}</span> @enderror
            </div>

            <div class="modal-actions">
                <button type="button" class="modal-cancel"
                        onclick="document.getElementById('delete-modal').style.display='none'">
                    Annuler
                </button>
                <button type="submit" class="modal-confirm">Supprimer définitivement</button>
            </div>
        </form>
    </div>
</div>
@endsection
