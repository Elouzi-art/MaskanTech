{{-- resources/views/profile/edit.blade.php --}}
@extends('dashboard.layout')

@section('title', 'Mon profil — MaskanTech')

@section('dashboard-content')

<style>
:root {
    --gold:        #C8873A;
    --gold-hover:  #B5882A;
    --gold-bg:     #FDF6E9;
    --gold-border: #E8D5A3;
    --bg-page:     #F5F3EF;
    --white:       #FFFFFF;
    --border:      #E5E0D8;
    --text:        #1A1A1A;
    --text-mid:    #555555;
    --text-light:  #888888;
    --red:         #DC2626;
    --red-bg:      #FFF5F5;
    --red-light:   #FEE2E2;
    --red-border:  #FECACA;
}

.page-title   { font-size: 28px; font-weight: 700; color: var(--text); margin-bottom: 4px; }
.page-sub     { font-size: 14px; color: var(--text-light); margin-bottom: 32px; }

/* CARDS */
.card {
    background: var(--white); border: 1px solid var(--border);
    border-radius: 16px; margin-bottom: 24px; overflow: hidden;
}
.card-head {
    display: flex; align-items: flex-start; gap: 14px;
    padding: 20px 28px; border-bottom: 1px solid var(--border);
}
.card-icon {
    width: 42px; height: 42px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.card-icon svg { width: 20px; height: 20px; }
.card-icon-gold { background: var(--gold-bg); color: var(--gold); }
.card-icon-blue { background: #EFF6FF; color: #3B82F6; }
.card-icon-red  { background: var(--red-light); color: var(--red); }
.card-head-title     { font-size: 16px; font-weight: 600; color: var(--text); margin-bottom: 2px; }
.card-head-title-red { color: var(--red); }
.card-head-sub       { font-size: 13px; color: var(--text-light); }
.card-head-sub-red   { color: #F87171; }
.card-body { padding: 28px; }
.card-danger { border-color: var(--red-border); }
.card-danger .card-head { background: var(--red-bg); border-color: var(--red-border); }

/* PHOTO */
.photo-row {
    display: flex; align-items: center; gap: 20px;
    padding-bottom: 24px; margin-bottom: 28px;
    border-bottom: 1px solid var(--border);
}
.photo-wrap { position: relative; flex-shrink: 0; }
.photo-avatar {
    width: 80px; height: 80px; border-radius: 14px;
    background: var(--gold); color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-size: 26px; font-weight: 700; overflow: hidden;
}
.photo-avatar img { width: 100%; height: 100%; object-fit: cover; }
.photo-cam {
    position: absolute; bottom: -6px; right: -6px;
    width: 28px; height: 28px; border-radius: 50%;
    background: var(--white); border: 2px solid var(--border);
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all .2s;
}
.photo-cam:hover { background: var(--gold); border-color: var(--gold); color: #fff; }
.photo-cam svg { width: 13px; height: 13px; }
.photo-label  { font-size: 14px; font-weight: 600; color: var(--text); margin-bottom: 4px; }
.photo-hint   { font-size: 12px; color: var(--text-light); line-height: 1.6; margin-bottom: 8px; }
.photo-change {
    font-size: 13px; color: var(--gold); font-weight: 500;
    background: none; border: none; cursor: pointer; padding: 0;
    font-family: 'DM Sans', sans-serif;
}
.photo-change:hover { text-decoration: underline; }

/* FORM */
.form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.form-full  { grid-column: 1 / -1; }
.form-group { display: flex; flex-direction: column; gap: 6px; }
.form-label {
    display: flex; align-items: center; gap: 7px;
    font-size: 13px; font-weight: 500; color: var(--text-mid);
}
.form-label svg { width: 15px; height: 15px; color: var(--text-light); }
.form-input {
    width: 100%; padding: 11px 16px;
    border: 1.5px solid var(--border); border-radius: 10px;
    font-size: 14px; font-family: 'DM Sans', sans-serif;
    color: var(--text); background: var(--white);
    transition: border-color .2s, box-shadow .2s; outline: none;
}
.form-input:focus { border-color: var(--gold); box-shadow: 0 0 0 3px rgba(200,135,58,.12); }
.form-input.is-error { border-color: var(--red) !important; }
.form-error { font-size: 12px; color: var(--red); margin-top: 2px; }

/* PASSWORD */
.pw-wrap { position: relative; }
.pw-wrap .form-input { padding-right: 44px; }
.pw-eye {
    position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
    background: none; border: none; cursor: pointer; color: var(--text-light);
    display: flex; padding: 0; transition: color .15s;
}
.pw-eye:hover { color: var(--gold); }
.pw-eye svg { width: 18px; height: 18px; }

/* RÔLE */
.role-wrap {
    display: flex; align-items: center; gap: 12px;
    padding: 11px 16px; border: 1.5px solid var(--border);
    border-radius: 10px; background: var(--bg-page);
}
.role-badge {
    display: flex; align-items: center; gap: 6px;
    background: var(--gold-bg); border: 1px solid var(--gold-border);
    color: var(--gold); padding: 4px 12px;
    border-radius: 100px; font-size: 13px; font-weight: 500;
}
.role-badge svg { width: 13px; height: 13px; }
.role-hint { font-size: 12px; color: var(--text-light); }

/* BUTTONS */
.actions { display: flex; justify-content: flex-end; margin-top: 24px; }
.btn-gold {
    padding: 12px 28px; border-radius: 10px;
    background: var(--gold); color: #fff; border: none;
    font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 600;
    cursor: pointer; transition: background .2s;
}
.btn-gold:hover { background: var(--gold-hover); }
.btn-black {
    padding: 12px 28px; border-radius: 10px;
    background: #111; color: #fff; border: none;
    font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 600;
    cursor: pointer; transition: background .2s;
}
.btn-black:hover { background: #333; }
.btn-red-outline {
    padding: 11px 24px; border-radius: 10px;
    background: var(--white); color: var(--red);
    border: 1.5px solid var(--red-border);
    font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 600;
    cursor: pointer; transition: all .2s; flex-shrink: 0;
}
.btn-red-outline:hover { background: var(--red-light); border-color: var(--red); }
.btn-cancel {
    padding: 11px 22px; border-radius: 10px;
    background: var(--bg-page); color: var(--text);
    border: 1px solid var(--border);
    font-family: 'DM Sans', sans-serif; font-size: 14px; font-weight: 500;
    cursor: pointer; transition: background .2s;
}
.btn-cancel:hover { background: var(--border); }

/* DANGER ROW */
.danger-row {
    display: flex; align-items: center; justify-content: space-between; gap: 24px;
    padding: 16px 20px; border: 1px solid var(--border); border-radius: 12px;
}
.danger-row-title { font-size: 15px; font-weight: 500; color: var(--text); margin-bottom: 3px; }
.danger-row-sub   { font-size: 13px; color: var(--text-light); }

/* ALERT */
.alert-success {
    display: flex; align-items: center; gap: 8px;
    background: #F0FDF4; border: 1px solid #BBF7D0; color: #166534;
    font-size: 13px; padding: 12px 16px; border-radius: 10px; margin-bottom: 20px;
}

/* MODAL */
.modal-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,.5); z-index: 500;
    align-items: center; justify-content: center; padding: 20px;
}
.modal-overlay.open { display: flex; }
.modal {
    background: var(--white); border-radius: 16px; padding: 32px;
    width: 100%; max-width: 440px;
    box-shadow: 0 20px 60px rgba(0,0,0,.18);
}
.modal-title { font-size: 18px; font-weight: 700; color: var(--red); margin-bottom: 8px; }
.modal-sub   { font-size: 13px; color: var(--text-mid); line-height: 1.7; margin-bottom: 24px; }
.modal-actions { display: flex; gap: 12px; justify-content: flex-end; margin-top: 20px; }
</style>

{{-- PAGE --}}
<div style="max-width: 720px;">

    <div class="page-title">Mon profil</div>
    <div class="page-sub">Gérez vos informations personnelles et vos paramètres de sécurité</div>

    {{-- ══ 1. INFORMATIONS PERSONNELLES ══ --}}
    <div class="card">
        <div class="card-head">
            <div class="card-icon card-icon-gold">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </div>
            <div>
                <div class="card-head-title">Informations personnelles</div>
                <div class="card-head-sub">Mettez à jour vos informations de profil</div>
            </div>
        </div>
        <div class="card-body">

            @if(session('status') === 'profile-updated')
                <div class="alert-success">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    Profil mis à jour avec succès.
                </div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf @method('PATCH')

                {{-- Photo --}}
                <div class="photo-row">
                    <div class="photo-wrap">
                        <div class="photo-avatar" id="photoAvatar">
                            @if(auth()->user()->avatar)
                                <img id="avatarPreview" src="{{ Storage::url(auth()->user()->avatar) }}" alt="">
                            @else
                                <span id="avatarInitials">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</span>
                                <img id="avatarPreview" src="" alt="" style="display:none;width:100%;height:100%;object-fit:cover;">
                            @endif
                        </div>
                        <label for="avatarInput" class="photo-cam" title="Changer la photo">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                        </label>
                        <input id="avatarInput" type="file" name="avatar" accept="image/jpeg,image/png,image/webp" style="display:none;">
                    </div>
                    <div>
                        <div class="photo-label">Photo de profil</div>
                        <div class="photo-hint">JPG, PNG ou WebP · Max 2 Mo</div>
                        <label for="avatarInput" class="photo-change">Changer la photo</label>
                    </div>
                </div>

                {{-- Champs --}}
                <div class="form-grid" style="margin-bottom:20px;">
                    <div class="form-group">
                        <label class="form-label" for="name">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            Nom complet
                        </label>
                        <input type="text" id="name" name="name"
                            value="{{ old('name', auth()->user()->name) }}"
                            class="form-input {{ $errors->has('name') ? 'is-error' : '' }}"
                            required autocomplete="name">
                        @error('name')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            Adresse email
                        </label>
                        <input type="email" id="email" name="email"
                            value="{{ old('email', auth()->user()->email) }}"
                            class="form-input {{ $errors->has('email') ? 'is-error' : '' }}"
                            required autocomplete="email">
                        @error('email')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="phone">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.77 1h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 8.91a16 16 0 0 0 5.61 5.61l.91-.91a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 21.92 16z"/></svg>
                            Téléphone
                        </label>
                        <input type="text" id="phone" name="phone"
                            value="{{ old('phone', auth()->user()->phone) }}"
                            class="form-input" placeholder="+212 6XX XXX XXX">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="address">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            Adresse
                        </label>
                        <input type="text" id="address" name="address"
                            value="{{ old('address', auth()->user()->address) }}"
                            class="form-input" placeholder="Votre adresse">
                    </div>

                    <div class="form-group form-full">
                        <label class="form-label">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 8v4l3 3"/></svg>
                            Rôle
                        </label>
                        <div class="role-wrap">
                            <div class="role-badge">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                {{ auth()->user()->role_label }}
                            </div>
                            <span class="role-hint">Non modifiable</span>
                        </div>
                    </div>
                </div>

                <div class="actions">
                    <button type="submit" class="btn-gold">Sauvegarder les modifications</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ══ 2. SÉCURITÉ ══ --}}
    <div class="card">
        <div class="card-head">
            <div class="card-icon card-icon-blue">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            </div>
            <div>
                <div class="card-head-title">Sécurité du compte</div>
                <div class="card-head-sub">Modifiez votre mot de passe</div>
            </div>
        </div>
        <div class="card-body">

            @if(session('status') === 'password-updated')
                <div class="alert-success">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                    Mot de passe mis à jour avec succès.
                </div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf @method('PUT')

                <div class="form-group" style="margin-bottom:20px;">
                    <label class="form-label" for="current_password">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        Mot de passe actuel
                    </label>
                    <div class="pw-wrap">
                        <input type="password" id="current_password" name="current_password"
                            autocomplete="current-password"
                            class="form-input {{ $errors->updatePassword->has('current_password') ? 'is-error' : '' }}">
                        <button type="button" class="pw-eye" onclick="togglePw('current_password',this)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                    @if($errors->updatePassword->has('current_password'))
                        <p class="form-error">{{ $errors->updatePassword->first('current_password') }}</p>
                    @endif
                </div>

                <div class="form-grid" style="margin-bottom:24px;">
                    <div class="form-group">
                        <label class="form-label" for="password">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            Nouveau mot de passe
                        </label>
                        <div class="pw-wrap">
                            <input type="password" id="password" name="password"
                                autocomplete="new-password"
                                class="form-input {{ $errors->updatePassword->has('password') ? 'is-error' : '' }}">
                            <button type="button" class="pw-eye" onclick="togglePw('password',this)">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                        @if($errors->updatePassword->has('password'))
                            <p class="form-error">{{ $errors->updatePassword->first('password') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                            Confirmer le mot de passe
                        </label>
                        <div class="pw-wrap">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                autocomplete="new-password" class="form-input">
                            <button type="button" class="pw-eye" onclick="togglePw('password_confirmation',this)">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="actions">
                    <button type="submit" class="btn-black">Mettre à jour le mot de passe</button>
                </div>
            </form>
        </div>
    </div>

    {{-- ══ 3. ZONE DANGEREUSE ══ --}}
    <div class="card card-danger">
        <div class="card-head">
            <div class="card-icon card-icon-red">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            </div>
            <div>
                <div class="card-head-title card-head-title-red">Zone dangereuse</div>
                <div class="card-head-sub card-head-sub-red">Actions irréversibles</div>
            </div>
        </div>
        <div class="card-body">
            <div class="danger-row">
                <div>
                    <div class="danger-row-title">Supprimer mon compte</div>
                    <div class="danger-row-sub">Toutes vos données seront définitivement effacées.</div>
                </div>
                <button type="button" class="btn-red-outline"
                        onclick="document.getElementById('deleteModal').classList.add('open')">
                    Supprimer mon compte
                </button>
            </div>
        </div>
    </div>

</div>{{-- /max-width --}}

{{-- MODAL SUPPRESSION --}}
<div id="deleteModal" class="modal-overlay">
    <div class="modal">
        <div class="modal-title">⚠️ Supprimer le compte</div>
        <p class="modal-sub">
            Entrez votre mot de passe pour confirmer la suppression définitive de votre compte.
            Cette action est <strong>irréversible</strong>.
        </p>
        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf @method('DELETE')
            <div class="form-group">
                <label class="form-label" for="del_password">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:15px;height:15px;"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    Mot de passe
                </label>
                <input type="password" id="del_password" name="password"
                    placeholder="Votre mot de passe"
                    class="form-input {{ $errors->userDeletion->has('password') ? 'is-error' : '' }}">
                @if($errors->userDeletion->has('password'))
                    <p class="form-error">{{ $errors->userDeletion->first('password') }}</p>
                @endif
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-cancel"
                        onclick="document.getElementById('deleteModal').classList.remove('open')">
                    Annuler
                </button>
                <button type="submit" class="btn-red-outline">Supprimer définitivement</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    {{-- Fermer modal overlay --}}
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) this.classList.remove('open');
    });

    {{-- Auto-ouvrir modal si erreur --}}
    @if($errors->userDeletion->isNotEmpty())
        document.getElementById('deleteModal').classList.add('open');
    @endif

    {{-- Toggle œil mot de passe --}}
    function togglePw(id, btn) {
        const inp = document.getElementById(id);
        inp.type = inp.type === 'password' ? 'text' : 'password';
        btn.style.color = inp.type === 'text' ? 'var(--gold)' : '';
    }

    {{-- Prévisualisation avatar --}}
    document.getElementById('avatarInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = ev => {
            const preview  = document.getElementById('avatarPreview');
            const initials = document.getElementById('avatarInitials');
            preview.src = ev.target.result;
            preview.style.display = 'block';
            if (initials) initials.style.display = 'none';
        };
        reader.readAsDataURL(file);
    });
</script>
@endsection