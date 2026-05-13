@extends('layouts.maskan')

@section('title', 'MaskanTech — Espace Étudiants')

@section('styles')
/* HERO */
.students-hero {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2010 100%);
    padding: 80px 80px;
    display: flex; align-items: center; justify-content: space-between;
    gap: 48px;
}
.students-hero-left { flex: 1; }
.students-hero-tag {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(200,135,58,0.18); border: 1px solid rgba(200,135,58,0.4);
    color: #E8A855; font-size: 11px; font-weight: 500; letter-spacing: 2px;
    text-transform: uppercase; padding: 6px 14px; border-radius: 20px;
    margin-bottom: 22px;
}
.students-hero h1 {
    font-family: 'Playfair Display', serif;
    font-size: 48px; font-weight: 700; color: #fff;
    line-height: 1.1; margin-bottom: 18px;
}
.students-hero h1 em { color: #E8A855; font-style: normal; }
.students-hero p {
    font-size: 16px; color: rgba(255,255,255,0.7);
    line-height: 1.7; margin-bottom: 32px; max-width: 480px;
}
.students-hero-btns { display: flex; gap: 12px; }
.students-hero-right {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 16px; padding: 32px;
    min-width: 300px;
}
.hero-stats { display: flex; flex-direction: column; gap: 20px; }
.hero-stat { display: flex; align-items: center; gap: 16px; }
.hero-stat-icon {
    width: 48px; height: 48px; border-radius: 12px;
    background: rgba(200,135,58,0.2);
    display: flex; align-items: center; justify-content: center; font-size: 22px;
}
.hero-stat-value {
    font-family: 'Playfair Display', serif;
    font-size: 24px; font-weight: 700; color: #E8A855;
}
.hero-stat-label { font-size: 13px; color: rgba(255,255,255,0.5); }

/* HOW IT WORKS */
.how-wrap { max-width: 1100px; margin: 0 auto; padding: 80px 48px; }
.steps { display: grid; grid-template-columns: repeat(4,1fr); gap: 24px; margin-top: 48px; }
.step { text-align: center; padding: 32px 20px; }
.step-number {
    width: 48px; height: 48px; border-radius: 50%;
    background: #C8873A; color: #fff;
    font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 18px;
}
.step-title { font-size: 15px; font-weight: 600; color: #1a1a1a; margin-bottom: 8px; }
.step-desc { font-size: 13px; color: #888; line-height: 1.7; }

/* AVANTAGES */
.avantages-wrap {
    background: #fafaf8; padding: 80px 48px;
}
.avantages-inner { max-width: 1100px; margin: 0 auto; }
.avantages-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; margin-top: 48px; }
.avantage-card {
    background: #fff; border: 1px solid #ede9e3;
    border-radius: 12px; padding: 28px;
    transition: transform 0.2s, box-shadow 0.2s;
}
.avantage-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,0.08); }
.avantage-icon {
    width: 52px; height: 52px; border-radius: 12px;
    background: #fdf6ee; display: flex; align-items: center;
    justify-content: center; font-size: 24px; margin-bottom: 16px;
}
.avantage-title { font-size: 15px; font-weight: 600; color: #1a1a1a; margin-bottom: 8px; }
.avantage-desc { font-size: 13px; color: #888; line-height: 1.7; }

/* TEMOIGNAGES */
.temoignages-wrap { max-width: 1100px; margin: 0 auto; padding: 80px 48px; }
.temoignages-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; margin-top: 48px; }
.temoignage-card {
    background: #fff; border: 1px solid #ede9e3;
    border-radius: 12px; padding: 28px;
}
.temoignage-text {
    font-size: 14px; color: #555; line-height: 1.7;
    font-style: italic; margin-bottom: 20px;
}
.temoignage-author { display: flex; align-items: center; gap: 12px; }
.temoignage-avatar {
    width: 40px; height: 40px; border-radius: 50%;
    background: linear-gradient(135deg, #C8873A, #E8A855);
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; font-weight: 700; color: #fff;
}
.temoignage-name { font-size: 14px; font-weight: 500; color: #1a1a1a; }
.temoignage-role { font-size: 12px; color: #888; }

/* CTA */
.students-cta {
    background: linear-gradient(135deg, #185FA5 0%, #0d3d6e 100%);
    padding: 72px 80px;
    display: flex; align-items: center; justify-content: space-between;
}
.students-cta h2 {
    font-family: 'Playfair Display', serif;
    font-size: 36px; color: #fff; font-weight: 700;
}
.students-cta h2 span { color: #E8A855; }
.students-cta p { font-size: 15px; color: rgba(255,255,255,0.6); margin-top: 8px; }
.cta-btns { display: flex; gap: 12px; }
@endsection

@section('content')

{{-- HERO --}}
<div class="students-hero">
    <div class="students-hero-left">
        <div class="students-hero-tag">🎓 Espace Étudiants</div>
        <h1>Trouvez votre<br>logement <em>étudiant</em><br>au Maroc</h1>
        <p>Des logements vérifiés, abordables et proches des universités. Spécialement sélectionnés pour les étudiants marocains.</p>
        <div class="students-hero-btns">
            <a href="/biens" class="mk-btn-gold">Voir les logements</a>
            <a href="/register" class="mk-btn-outline" style="border-color:rgba(255,255,255,0.3);color:#fff;">S'inscrire gratuitement</a>
        </div>
    </div>
    <div class="students-hero-right">
        <div class="hero-stats">
            <div class="hero-stat">
                <div class="hero-stat-icon">🏠</div>
                <div>
                    <div class="hero-stat-value">300+</div>
                    <div class="hero-stat-label">Logements étudiants</div>
                </div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-icon">🎓</div>
                <div>
                    <div class="hero-stat-value">2 000+</div>
                    <div class="hero-stat-label">Étudiants logés</div>
                </div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-icon">🏙️</div>
                <div>
                    <div class="hero-stat-value">20+</div>
                    <div class="hero-stat-label">Villes universitaires</div>
                </div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-icon">💰</div>
                <div>
                    <div class="hero-stat-value">800 MAD</div>
                    <div class="hero-stat-label">Prix moyen / mois</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- COMMENT ÇA MARCHE --}}
<div class="how-wrap">
    <div class="mk-section-tag" style="text-align:center;display:block;">Comment ça marche</div>
    <div class="mk-section-h2" style="text-align:center;">Trouvez votre logement en 4 étapes</div>
    <div class="steps">
        <div class="step">
            <div class="step-number">1</div>
            <div class="step-title">Créez votre compte</div>
            <div class="step-desc">Inscrivez-vous gratuitement en tant qu'étudiant et uploadez votre carte étudiante.</div>
        </div>
        <div class="step">
            <div class="step-number">2</div>
            <div class="step-title">Recherchez</div>
            <div class="step-desc">Filtrez par ville, budget et proximité université pour trouver le logement idéal.</div>
        </div>
        <div class="step">
            <div class="step-number">3</div>
            <div class="step-title">Contactez</div>
            <div class="step-desc">Envoyez un message directement au propriétaire sans intermédiaire.</div>
        </div>
        <div class="step">
            <div class="step-number">4</div>
            <div class="step-title">Emménagez !</div>
            <div class="step-desc">Prenez rendez-vous pour visiter et signez votre contrat en toute sécurité.</div>
        </div>
    </div>
</div>

{{-- AVANTAGES --}}
<div class="avantages-wrap">
    <div class="avantages-inner">
        <div class="mk-section-tag" style="text-align:center;display:block;">Pourquoi nous choisir</div>
        <div class="mk-section-h2" style="text-align:center;">Fait pour les étudiants</div>
        <div class="avantages-grid">
            <div class="avantage-card">
                <div class="avantage-icon">💰</div>
                <div class="avantage-title">Prix abordables</div>
                <div class="avantage-desc">Des logements sélectionnés avec des loyers adaptés aux budgets étudiants.</div>
            </div>
            <div class="avantage-card">
                <div class="avantage-icon">✅</div>
                <div class="avantage-title">Annonces vérifiées</div>
                <div class="avantage-desc">Chaque annonce est validée manuellement. Zéro arnaque, zéro mauvaise surprise.</div>
            </div>
            <div class="avantage-card">
                <div class="avantage-icon">🎓</div>
                <div class="avantage-title">Réservé aux étudiants</div>
                <div class="avantage-desc">Certaines annonces sont exclusivement réservées aux étudiants inscrits.</div>
            </div>
            <div class="avantage-card">
                <div class="avantage-icon">📍</div>
                <div class="avantage-title">Proche des universités</div>
                <div class="avantage-desc">Filtrez les logements par proximité avec votre université ou école.</div>
            </div>
            <div class="avantage-card">
                <div class="avantage-icon">💬</div>
                <div class="avantage-title">Contact direct</div>
                <div class="avantage-desc">Messagerie sécurisée directement avec le propriétaire, sans commission.</div>
            </div>
            <div class="avantage-card">
                <div class="avantage-icon">🔒</div>
                <div class="avantage-title">100% gratuit</div>
                <div class="avantage-desc">L'inscription et la recherche sont totalement gratuites pour les étudiants.</div>
            </div>
        </div>
    </div>
</div>

{{-- TEMOIGNAGES --}}
<div class="temoignages-wrap">
    <div class="mk-section-tag" style="text-align:center;display:block;">Témoignages</div>
    <div class="mk-section-h2" style="text-align:center;">Ce que disent nos étudiants</div>
    <div class="temoignages-grid">
        <div class="temoignage-card">
            <div class="temoignage-text">"J'ai trouvé une chambre à 900 MAD/mois à 10 minutes de mon université. Incroyable !"</div>
            <div class="temoignage-author">
                <div class="temoignage-avatar">YB</div>
                <div>
                    <div class="temoignage-name">Youssef Bennani</div>
                    <div class="temoignage-role">Étudiant · Rabat</div>
                </div>
            </div>
        </div>
        <div class="temoignage-card">
            <div class="temoignage-text">"Le filtre étudiant m'a permis de trouver des logements adaptés à mon budget en quelques minutes."</div>
            <div class="temoignage-author">
                <div class="temoignage-avatar">SA</div>
                <div>
                    <div class="temoignage-name">Sara Alaoui</div>
                    <div class="temoignage-role">Étudiante · Casablanca</div>
                </div>
            </div>
        </div>
        <div class="temoignage-card">
            <div class="temoignage-text">"Zéro commission, contact direct avec le propriétaire. C'est exactement ce dont j'avais besoin !"</div>
            <div class="temoignage-author">
                <div class="temoignage-avatar">KM</div>
                <div>
                    <div class="temoignage-name">Karim Mansouri</div>
                    <div class="temoignage-role">Étudiant · Marrakech</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CTA --}}
<div class="students-cta">
    <div>
        <h2>Prêt à trouver votre <span>logement</span> ?</h2>
        <p>Rejoignez plus de 2 000 étudiants qui ont trouvé leur logement sur MaskanTech.</p>
    </div>
    <div class="cta-btns">
        <a href="/register" class="mk-btn-gold">S'inscrire gratuitement</a>
        <a href="/biens" class="mk-btn-outline" style="border-color:rgba(255,255,255,0.3);color:#fff;">Voir les logements</a>
    </div>
</div>

@endsection