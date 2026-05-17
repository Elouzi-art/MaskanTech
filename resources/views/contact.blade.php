@extends('layouts.maskan')

@section('title', 'MaskanTech — Contact')

@section('styles')
.contact-wrap { max-width: 1100px; margin: 0 auto; padding: 60px 48px; }

/* HEADER */
.contact-header { text-align: center; margin-bottom: 56px; }
.contact-header .mk-section-tag { justify-content: center; display: flex; }
.contact-header h1 {
    font-family: 'Playfair Display', serif;
    font-size: 42px; font-weight: 700; color: #1a1a1a;
    margin-bottom: 14px;
}
.contact-header p { font-size: 15px; color: #888; max-width: 480px; margin: 0 auto; line-height: 1.7; }

/* GRID */
.contact-grid { display: grid; grid-template-columns: 1fr 1.4fr; gap: 48px; }

/* LEFT */
.contact-info { display: flex; flex-direction: column; gap: 24px; }
.contact-info-card {
    display: flex; align-items: flex-start; gap: 16px;
    padding: 24px; background: #fafaf8;
    border: 1px solid #f0ede8; border-radius: 12px;
}
.contact-info-icon {
    width: 48px; height: 48px; border-radius: 12px;
    background: #fdf6ee; display: flex; align-items: center;
    justify-content: center; font-size: 22px; flex-shrink: 0;
}
.contact-info-title { font-size: 14px; font-weight: 600; color: #1a1a1a; margin-bottom: 4px; }
.contact-info-text { font-size: 13px; color: #888; line-height: 1.6; }

/* SOCIAL */
.contact-social { margin-top: 8px; }
.contact-social-title { font-size: 13px; font-weight: 500; color: #1a1a1a; margin-bottom: 12px; }
.social-links { display: flex; gap: 10px; }
.social-link {
    width: 40px; height: 40px; border-radius: 10px;
    border: 1.5px solid #e8e3db; display: flex;
    align-items: center; justify-content: center;
    font-size: 18px; text-decoration: none;
    transition: all 0.2s;
}
.social-link:hover { border-color: #C8873A; background: #fdf6ee; }

/* FORM */
.contact-form-card {
    background: #fff; border: 1.5px solid #e8e3db;
    border-radius: 16px; padding: 36px;
}
.contact-form-title {
    font-family: 'Playfair Display', serif;
    font-size: 22px; font-weight: 700; color: #1a1a1a;
    margin-bottom: 6px;
}
.contact-form-sub { font-size: 13px; color: #888; margin-bottom: 28px; }
.contact-submit {
    width: 100%; padding: 14px; background: #1a1a1a;
    color: #fff; border: none; border-radius: 8px;
    font-size: 14px; font-weight: 500; cursor: pointer;
    font-family: 'DM Sans', sans-serif; transition: background 0.2s;
}
.contact-submit:hover { background: #C8873A; }
@endsection

@section('content')
<div class="contact-wrap">

    {{-- HEADER --}}
    <div class="contact-header">
        <div class="mk-section-tag">Contactez-nous</div>
        <h1>On est là pour vous <span style="color:#C8873A">aider</span></h1>
        <p>Une question, une suggestion ou un problème ? Notre équipe vous répond dans les 24h.</p>
    </div>

    <div class="contact-grid">

        {{-- LEFT --}}
        <div class="contact-info">
            <div class="contact-info-card">
                <div class="contact-info-icon">📧</div>
                <div>
                    <div class="contact-info-title">Email</div>
                    <div class="contact-info-text">contact@maskantech.ma<br>support@maskantech.ma</div>
                </div>
            </div>
            <div class="contact-info-card">
                <div class="contact-info-icon">📞</div>
                <div>
                    <div class="contact-info-title">Téléphone</div>
                    <div class="contact-info-text">+212 6 00 00 00 00<br>Lun–Ven, 9h–18h</div>
                </div>
            </div>
            <div class="contact-info-card">
                <div class="contact-info-icon">📍</div>
                <div>
                    <div class="contact-info-title">Adresse</div>
                    <div class="contact-info-text">Guéliz, Marrakech<br>Maroc</div>
                </div>
            </div>

            <div class="contact-social">
                <div class="contact-social-title">Suivez-nous</div>
                <div class="social-links">
                    <a href="#" class="social-link">📘</a>
                    <a href="#" class="social-link">📸</a>
                    <a href="#" class="social-link">🐦</a>
                    <a href="#" class="social-link">💼</a>
                </div>
            </div>
        </div>

        {{-- FORM --}}
        <div class="contact-form-card">
            <div class="contact-form-title">Envoyez-nous un message</div>
            <div class="contact-form-sub">Nous vous répondrons dans les plus brefs délais.</div>

            <form>
                @csrf
                <div class="mk-form-row">
                    <div class="mk-form-group">
                        <label>Prénom</label>
                        <input type="text" placeholder="Votre prénom" required>
                    </div>
                    <div class="mk-form-group">
                        <label>Nom</label>
                        <input type="text" placeholder="Votre nom" required>
                    </div>
                </div>
                <div class="mk-form-group">
                    <label>Email</label>
                    <input type="email" placeholder="exemple@email.com" required>
                </div>
                <div class="mk-form-group">
                    <label>Sujet</label>
                    <select>
                        <option>Question générale</option>
                        <option>Problème technique</option>
                        <option>Signaler une annonce</option>
                        <option>Partenariat</option>
                        <option>Autre</option>
                    </select>
                </div>
                <div class="mk-form-group">
                    <label>Message</label>
                    <textarea rows="5" placeholder="Votre message..."></textarea>
                </div>
                <button type="submit" class="contact-submit">Envoyer le message</button>
            </form>
        </div>

    </div>
</div>
@endsection