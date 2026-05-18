@extends('layouts.maskan')
@section('title', 'MaskanTech — Espace Propriétaires')

@section('styles')
.owners-hero { background: linear-gradient(135deg, #1a1a1a 0%, #1a0a00 100%); padding: 80px; display: flex; align-items: center; justify-content: space-between; gap: 48px; }
.owners-hero-left { flex: 1; }
.owners-hero-tag { display: inline-flex; align-items: center; gap: 8px; background: rgba(200,135,58,0.18); border: 1px solid rgba(200,135,58,0.4); color: #E8A855; font-size: 11px; font-weight: 500; letter-spacing: 2px; text-transform: uppercase; padding: 6px 14px; border-radius: 20px; margin-bottom: 22px; }
.owners-hero h1 { font-family: 'Playfair Display', serif; font-size: 48px; font-weight: 700; color: #fff; line-height: 1.1; margin-bottom: 18px; }
.owners-hero h1 em { color: #E8A855; font-style: normal; }
.owners-hero p { font-size: 16px; color: rgba(255,255,255,0.7); line-height: 1.7; margin-bottom: 32px; max-width: 480px; }
.owners-hero-btns { display: flex; gap: 12px; flex-wrap: wrap; }
.owners-hero-right { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 32px; min-width: 280px; }
.hero-stats { display: flex; flex-direction: column; gap: 20px; }
.hero-stat { display: flex; align-items: center; gap: 16px; }
.hero-stat-icon { width: 48px; height: 48px; border-radius: 12px; background: rgba(200,135,58,0.2); display: flex; align-items: center; justify-content: center; font-size: 22px; }
.hero-stat-value { font-family: 'Playfair Display', serif; font-size: 24px; font-weight: 700; color: #E8A855; }
.hero-stat-label { font-size: 13px; color: rgba(255,255,255,0.5); }

.how-wrap { max-width: 1100px; margin: 0 auto; padding: 80px 48px; }
.steps { display: grid; grid-template-columns: repeat(4,1fr); gap: 24px; margin-top: 48px; }
.step { text-align: center; padding: 32px 20px; }
.step-number { width: 48px; height: 48px; border-radius: 50%; background: #C8873A; color: #fff; font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; display: flex; align-items: center; justify-content: center; margin: 0 auto 18px; }
.step-title { font-size: 15px; font-weight: 600; color: #1a1a1a; margin-bottom: 8px; }
.step-desc { font-size: 13px; color: #888; line-height: 1.7; }

.avantages-wrap { background: #fafaf8; padding: 80px 48px; }
.avantages-inner { max-width: 1100px; margin: 0 auto; }
.avantages-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; margin-top: 48px; }
.avantage-card { background: #fff; border: 1px solid #ede9e3; border-radius: 12px; padding: 28px; transition: transform 0.2s, box-shadow 0.2s; }
.avantage-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,0.08); }
.avantage-icon { width: 52px; height: 52px; border-radius: 12px; background: #fdf6ee; display: flex; align-items: center; justify-content: center; font-size: 24px; margin-bottom: 16px; }
.avantage-title { font-size: 15px; font-weight: 600; color: #1a1a1a; margin-bottom: 8px; }
.avantage-desc { font-size: 13px; color: #888; line-height: 1.7; }

.tarifs-wrap { max-width: 1100px; margin: 0 auto; padding: 80px 48px; }
.tarifs-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; margin-top: 48px; }
.tarif-card { border: 1.5px solid #ede9e3; border-radius: 16px; padding: 32px; text-align: center; position: relative; transition: transform 0.2s, box-shadow 0.2s; }
.tarif-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,0.08); }
.tarif-card.popular { border-color: #C8873A; box-shadow: 0 8px 30px rgba(200,135,58,0.15); }
.tarif-popular-badge { position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: #C8873A; color: #fff; font-size: 11px; font-weight: 500; padding: 4px 16px; border-radius: 20px; white-space: nowrap; }
.tarif-name { font-size: 14px; font-weight: 500; color: #888; margin-bottom: 12px; }
.tarif-price { font-family: 'Playfair Display', serif; font-size: 36px; font-weight: 700; color: #1a1a1a; margin-bottom: 4px; }
.tarif-price span { font-size: 14px; font-family: 'DM Sans', sans-serif; color: #888; }
.tarif-desc { font-size: 13px; color: #888; margin-bottom: 24px; }
.tarif-features { list-style: none; margin-bottom: 28px; text-align: left; padding: 0; }
.tarif-features li { font-size: 13px; color: #555; padding: 8px 0; border-bottom: 1px solid #f0ede8; display: flex; align-items: center; gap: 8px; }
.tarif-features li:last-child { border-bottom: none; }
.tarif-btn { width: 100%; padding: 12px; border-radius: 8px; font-size: 14px; font-weight: 500; cursor: pointer; font-family: 'DM Sans', sans-serif; transition: all 0.2s; border: 1.5px solid #1a1a1a; background: transparent; color: #1a1a1a; text-decoration: none; display: block; }
.tarif-card.popular .tarif-btn { background: #C8873A; border-color: #C8873A; color: #fff; }
.tarif-btn:hover { background: #C8873A; border-color: #C8873A; color: #fff; }

.temoignages-wrap { background: #fafaf8; padding: 80px 48px; }
.temoignages-inner { max-width: 1100px; margin: 0 auto; }
.temoignages-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; margin-top: 48px; }
.temoignage-card { background: #fff; border: 1px solid #ede9e3; border-radius: 12px; padding: 28px; }
.temoignage-text { font-size: 14px; color: #555; line-height: 1.7; font-style: italic; margin-bottom: 20px; }
.temoignage-author { display: flex; align-items: center; gap: 12px; }
.temoignage-avatar { width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #C8873A, #E8A855); display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 700; color: #fff; }
.temoignage-name { font-size: 14px; font-weight: 500; color: #1a1a1a; }
.temoignage-role { font-size: 12px; color: #888; }

.owners-cta { background: linear-gradient(135deg, #C8873A 0%, #b07530 100%); padding: 72px 80px; display: flex; align-items: center; justify-content: space-between; gap: 32px; flex-wrap: wrap; }
.owners-cta h2 { font-family: 'Playfair Display', serif; font-size: 36px; color: #fff; font-weight: 700; margin-bottom: 8px; }
.owners-cta p { font-size: 15px; color: rgba(255,255,255,0.8); margin: 0; }
.cta-btns { display: flex; gap: 12px; flex-wrap: wrap; }

@media(max-width:900px) {
    .owners-hero { flex-direction: column; padding: 48px 24px; }
    .owners-hero-right { min-width: auto; width: 100%; }
    .steps { grid-template-columns: repeat(2,1fr); }
    .avantages-grid, .temoignages-grid, .tarifs-grid { grid-template-columns: 1fr; }
    .how-wrap, .tarifs-wrap, .temoignages-wrap { padding: 48px 24px; }
    .avantages-wrap { padding: 48px 24px; }
    .owners-cta { padding: 48px 24px; }
}
@endsection

@section('content')

<div class="owners-hero">
    <div class="owners-hero-left">
        <div class="owners-hero-tag">🏠 Espace Propriétaires</div>
        <h1>Louez votre bien<br><em>rapidement</em><br>et sereinement</h1>
        <p>Publiez votre annonce gratuitement et trouvez votre locataire idéal parmi des milliers d'utilisateurs vérifiés.</p>
        <div class="owners-hero-btns">
            <a href="{{ route('properties.create') }}" class="mk-btn-gold">Publier une annonce</a>
            <a href="{{ route('contact') }}" class="mk-btn-outline" style="border-color:rgba(255,255,255,0.3);color:#fff;">Nous contacter</a>
        </div>
    </div>
    <div class="owners-hero-right">
        <div class="hero-stats">
            <div class="hero-stat"><div class="hero-stat-icon">👥</div><div><div class="hero-stat-value">8 000+</div><div class="hero-stat-label">Locataires actifs</div></div></div>
            <div class="hero-stat"><div class="hero-stat-icon">📋</div><div><div class="hero-stat-value">1 200+</div><div class="hero-stat-label">Annonces publiées</div></div></div>
            <div class="hero-stat"><div class="hero-stat-icon">⚡</div><div><div class="hero-stat-value">7 jours</div><div class="hero-stat-label">Délai moyen de location</div></div></div>
            <div class="hero-stat"><div class="hero-stat-icon">⭐</div><div><div class="hero-stat-value">4.8/5</div><div class="hero-stat-label">Satisfaction propriétaires</div></div></div>
        </div>
    </div>
</div>

<div class="how-wrap">
    <span class="mk-section-tag" style="display:block;text-align:center">Comment ça marche</span>
    <h2 class="mk-section-h2" style="text-align:center">Publiez en 4 étapes simples</h2>
    <div class="steps">
        <div class="step"><div class="step-number">1</div><div class="step-title">Créez votre compte</div><div class="step-desc">Inscrivez-vous gratuitement en tant que propriétaire.</div></div>
        <div class="step"><div class="step-number">2</div><div class="step-title">Publiez votre annonce</div><div class="step-desc">Ajoutez photos, description, prix et équipements en quelques minutes.</div></div>
        <div class="step"><div class="step-number">3</div><div class="step-title">Recevez des demandes</div><div class="step-desc">Les locataires vous contactent directement via notre messagerie.</div></div>
        <div class="step"><div class="step-number">4</div><div class="step-title">Louez votre bien</div><div class="step-desc">Planifiez les visites et choisissez votre locataire idéal.</div></div>
    </div>
</div>

<div class="avantages-wrap">
    <div class="avantages-inner">
        <span class="mk-section-tag" style="display:block;text-align:center">Pourquoi nous choisir</span>
        <h2 class="mk-section-h2" style="text-align:center">Tout pour les propriétaires</h2>
        <div class="avantages-grid">
            <div class="avantage-card"><div class="avantage-icon">🆓</div><div class="avantage-title">Publication gratuite</div><div class="avantage-desc">Publiez votre première annonce gratuitement sans aucun engagement.</div></div>
            <div class="avantage-card"><div class="avantage-icon">👥</div><div class="avantage-title">Large audience</div><div class="avantage-desc">Accédez à plus de 8 000 locataires actifs partout au Maroc.</div></div>
            <div class="avantage-card"><div class="avantage-icon">✅</div><div class="avantage-title">Locataires vérifiés</div><div class="avantage-desc">Tous les locataires sont vérifiés. Zéro arnaque.</div></div>
            <div class="avantage-card"><div class="avantage-icon">💬</div><div class="avantage-title">Messagerie intégrée</div><div class="avantage-desc">Communiquez directement avec les locataires depuis votre dashboard.</div></div>
            <div class="avantage-card"><div class="avantage-icon">📊</div><div class="avantage-title">Statistiques</div><div class="avantage-desc">Suivez les vues, les demandes et les performances de vos annonces.</div></div>
            <div class="avantage-card"><div class="avantage-icon">📅</div><div class="avantage-title">Gestion des visites</div><div class="avantage-desc">Planifiez et gérez vos rendez-vous de visite directement sur la plateforme.</div></div>
        </div>
    </div>
</div>

<div class="tarifs-wrap">
    <span class="mk-section-tag" style="display:block;text-align:center">Tarifs</span>
    <h2 class="mk-section-h2" style="text-align:center">Des offres adaptées à vos besoins</h2>
    <div class="tarifs-grid">
        <div class="tarif-card">
            <div class="tarif-name">Gratuit</div>
            <div class="tarif-price">0 MAD <span>/ mois</span></div>
            <div class="tarif-desc">Pour commencer</div>
            <ul class="tarif-features">
                <li>✅ 1 annonce active</li>
                <li>✅ Messagerie basique</li>
                <li>✅ Profil propriétaire</li>
                <li>❌ Annonce mise en avant</li>
                <li>❌ Statistiques avancées</li>
            </ul>
            <a href="{{ route('register') }}" class="tarif-btn">Commencer gratuitement</a>
        </div>
        <div class="tarif-card popular">
            <div class="tarif-popular-badge">⭐ Populaire</div>
            <div class="tarif-name">Pro</div>
            <div class="tarif-price">199 MAD <span>/ mois</span></div>
            <div class="tarif-desc">Pour les propriétaires actifs</div>
            <ul class="tarif-features">
                <li>✅ 5 annonces actives</li>
                <li>✅ Messagerie illimitée</li>
                <li>✅ Annonces mises en avant</li>
                <li>✅ Statistiques avancées</li>
                <li>✅ Support prioritaire</li>
            </ul>
            <a href="{{ route('register') }}" class="tarif-btn">Choisir Pro</a>
        </div>
        <div class="tarif-card">
            <div class="tarif-name">Premium</div>
            <div class="tarif-price">499 MAD <span>/ mois</span></div>
            <div class="tarif-desc">Pour les agences immobilières</div>
            <ul class="tarif-features">
                <li>✅ Annonces illimitées</li>
                <li>✅ Messagerie illimitée</li>
                <li>✅ Toutes les annonces en avant</li>
                <li>✅ Statistiques avancées</li>
                <li>✅ Support dédié 24/7</li>
            </ul>
            <a href="{{ route('contact') }}" class="tarif-btn">Nous contacter</a>
        </div>
    </div>
</div>

<div class="temoignages-wrap">
    <div class="temoignages-inner">
        <span class="mk-section-tag" style="display:block;text-align:center">Témoignages</span>
        <h2 class="mk-section-h2" style="text-align:center">Ce que disent nos propriétaires</h2>
        <div class="temoignages-grid">
            <div class="temoignage-card"><div class="temoignage-text">« J'ai trouvé un locataire en 5 jours seulement. La plateforme est simple et efficace ! »</div><div class="temoignage-author"><div class="temoignage-avatar">AK</div><div><div class="temoignage-name">Ahmed Karimi</div><div class="temoignage-role">Propriétaire · Marrakech</div></div></div></div>
            <div class="temoignage-card"><div class="temoignage-text">« Zéro commission, contact direct. J'ai économisé des milliers de dirhams par rapport aux agences. »</div><div class="temoignage-author"><div class="temoignage-avatar">FB</div><div><div class="temoignage-name">Fatima Benali</div><div class="temoignage-role">Propriétaire · Casablanca</div></div></div></div>
            <div class="temoignage-card"><div class="temoignage-text">« Le tableau de bord est excellent. Je gère toutes mes annonces et mes visites depuis un seul endroit. »</div><div class="temoignage-author"><div class="temoignage-avatar">MO</div><div><div class="temoignage-name">Mohammed Ouali</div><div class="temoignage-role">Propriétaire · Rabat</div></div></div></div>
        </div>
    </div>
</div>

<div class="owners-cta">
    <div>
        <h2>Prêt à louer votre bien ?</h2>
        <p>Rejoignez plus de 500 propriétaires qui font confiance à MaskanTech.</p>
    </div>
    <div class="cta-btns">
        <a href="{{ route('properties.create') }}" class="mk-btn-dark">Publier une annonce</a>
        <a href="{{ route('contact') }}" class="mk-btn-outline" style="border-color:rgba(255,255,255,0.3);color:#fff;">Nous contacter</a>
    </div>
</div>

@endsection
