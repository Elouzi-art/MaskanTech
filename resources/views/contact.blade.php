@extends('layouts.maskan')
@section('title', 'MaskanTech — Contact')

@section('styles')
.contact-wrap { max-width: 720px; margin: 0 auto; padding: 60px 24px; }
.contact-title { font-family: 'Playfair Display', serif; font-size: 36px; font-weight: 700; color: #1a1a1a; margin-bottom: 8px; }
.contact-sub { font-size: 15px; color: #888; margin-bottom: 40px; line-height: 1.7; }
.contact-card { background: #fff; border: 1px solid #ede9e3; border-radius: 14px; padding: 36px; }
.contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
.contact-grid .full { grid-column: 1 / -1; }
.form-group { display: flex; flex-direction: column; gap: 6px; }
.form-label { font-size: 12px; color: #555; font-weight: 500; letter-spacing: 0.5px; }
.form-input, .form-select, .form-textarea {
    padding: 12px 14px; border: 1.5px solid #e8e3db;
    border-radius: 8px; font-size: 14px;
    font-family: 'DM Sans', sans-serif; color: #1a1a1a;
    outline: none; transition: border-color 0.2s; background: #fff;
    width: 100%; box-sizing: border-box;
}
.form-input:focus, .form-select:focus, .form-textarea:focus { border-color: #C8873A; }
.form-textarea { resize: vertical; min-height: 130px; }
.submit-btn {
    width: 100%; padding: 14px; background: #1a1a1a; color: #fff;
    border: none; border-radius: 8px; font-size: 15px; font-weight: 500;
    cursor: pointer; font-family: 'DM Sans', sans-serif; transition: background 0.2s; margin-top: 8px;
}
.submit-btn:hover { background: #C8873A; }
.contact-info { display: grid; grid-template-columns: repeat(3,1fr); gap: 20px; margin-top: 32px; }
.info-card { background: #fdf6ee; border: 1px solid #f0d9b5; border-radius: 10px; padding: 20px; text-align: center; }
.info-icon { font-size: 24px; margin-bottom: 8px; }
.info-label { font-size: 12px; color: #aaa; font-weight: 500; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 4px; }
.info-value { font-size: 14px; color: #1a1a1a; font-weight: 500; }
@media(max-width:640px) { .contact-grid { grid-template-columns:1fr; } .contact-info { grid-template-columns:1fr; } .contact-grid .full { grid-column:1; } }
@endsection

@section('content')
<div class="contact-wrap">

    <div class="contact-title">Contactez-nous</div>
    <p class="contact-sub">Une question sur un logement ou besoin d'aide ? Notre équipe vous répond sous 24h.</p>

    <div class="contact-card">
        <form method="POST" action="{{ route('contact.store') }}">
            @csrf

            <div class="contact-grid">
                <div class="form-group">
                    <label class="form-label">Nom complet *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           placeholder="Mohammed Alami" class="form-input">
                    @error('name') <span style="color:#dc2626;font-size:12px">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           placeholder="email@exemple.com" class="form-input">
                    @error('email') <span style="color:#dc2626;font-size:12px">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Téléphone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                           placeholder="+212 6XX XXX XXX" class="form-input">
                </div>

                <div class="form-group">
                    <label class="form-label">Sujet *</label>
                    <select name="subject" class="form-select" required>
                        <option value="">Choisir un sujet</option>
                        <option value="Question sur un logement"    {{ old('subject') === 'Question sur un logement' ? 'selected' : '' }}>Question sur un logement</option>
                        <option value="Signaler une annonce"        {{ old('subject') === 'Signaler une annonce' ? 'selected' : '' }}>Signaler une annonce</option>
                        <option value="Problème technique"          {{ old('subject') === 'Problème technique' ? 'selected' : '' }}>Problème technique</option>
                        <option value="Partenariat"                 {{ old('subject') === 'Partenariat' ? 'selected' : '' }}>Partenariat</option>
                        <option value="Autre"                       {{ old('subject') === 'Autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                    @error('subject') <span style="color:#dc2626;font-size:12px">{{ $message }}</span> @enderror
                </div>

                <div class="form-group full">
                    <label class="form-label">Message *</label>
                    <textarea name="message" required
                              placeholder="Décrivez votre demande en détail..."
                              class="form-textarea">{{ old('message') }}</textarea>
                    @error('message') <span style="color:#dc2626;font-size:12px">{{ $message }}</span> @enderror
                </div>
            </div>

            <button type="submit" class="submit-btn">Envoyer le message →</button>
        </form>
    </div>

    <div class="contact-info">
        <div class="info-card">
            <div class="info-icon">📧</div>
            <div class="info-label">Email</div>
            <div class="info-value">contact@maskantech.ma</div>
        </div>
        <div class="info-card">
            <div class="info-icon">📞</div>
            <div class="info-label">Téléphone</div>
            <div class="info-value">+212 5XX XX XX XX</div>
        </div>
        <div class="info-card">
            <div class="info-icon">📍</div>
            <div class="info-label">Adresse</div>
            <div class="info-value">Casablanca, Maroc</div>
        </div>
    </div>
</div>
@endsection
