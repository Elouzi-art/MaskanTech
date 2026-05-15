@extends('layouts.maskan')

@section('title', 'MaskanTech — Studio meublé Guéliz')

@section('styles')
        .detail-wrap { max-width: 1200px; margin: 0 auto; padding: 40px 48px; }

        /* BREADCRUMB */
        .breadcrumb { display: flex; align-items: center; gap: 8px; margin-bottom: 28px; font-size: 13px; color: #888; }
        .breadcrumb a { color: #888; text-decoration: none; transition: color 0.2s; }
        .breadcrumb a:hover { color: #C8873A; }
        .breadcrumb-sep { color: #ccc; }
        .breadcrumb-current { color: #1a1a1a; font-weight: 500; }

        /* HEADER */
        .detail-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px; }
        .detail-header-left { flex: 1; }
        .detail-badges { display: flex; gap: 8px; margin-bottom: 12px; flex-wrap: wrap; }
        .detail-badge {
            font-size: 12px; font-weight: 500; padding: 5px 12px;
            border-radius: 20px;
        }
        .badge-type { background: #f0ede8; color: #1a1a1a; }
        .badge-student { background: #185FA5; color: #fff; }
        .badge-available { background: #eaf3de; color: #27500A; }
        .badge-featured { background: #C8873A; color: #fff; }
        .detail-title { font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 700; color: #1a1a1a; margin-bottom: 8px; line-height: 1.2; }
        .detail-loc { font-size: 15px; color: #888; margin-bottom: 0; }
        .detail-header-right { text-align: right; }
        .detail-price { font-family: 'Playfair Display', serif; font-size: 36px; font-weight: 700; color: #C8873A; }
        .detail-price span { font-size: 15px; font-family: 'DM Sans', sans-serif; font-weight: 300; color: #999; }
        .detail-views { font-size: 12px; color: #aaa; margin-top: 6px; }

        /* GALLERY */
        .gallery { display: grid; grid-template-columns: 2fr 1fr; grid-template-rows: 280px 180px; gap: 8px; border-radius: 16px; overflow: hidden; margin-bottom: 40px; }
        .gallery-main { grid-row: 1 / 3; background-size: cover; background-position: center; position: relative; }
        .gallery-img { background-size: cover; background-position: center; }
        .gallery-overlay {
            position: absolute; bottom: 16px; right: 16px;
            background: rgba(0,0,0,0.6); color: #fff;
            padding: 8px 16px; border-radius: 8px; font-size: 13px;
            cursor: pointer; transition: background 0.2s;
        }
        .gallery-overlay:hover { background: rgba(200,135,58,0.8); }

        /* CONTENT */
        .detail-content { display: grid; grid-template-columns: 1fr 360px; gap: 40px; }

        /* LEFT */
        .detail-left { }
        .section-title { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; color: #1a1a1a; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid #f0ede8; }

        /* STATS */
        .prop-stats { display: grid; grid-template-columns: repeat(4,1fr); gap: 16px; margin-bottom: 36px; }
        .prop-stat { text-align: center; padding: 20px 16px; background: #fafaf8; border-radius: 10px; border: 1px solid #f0ede8; }
        .prop-stat-icon { font-size: 24px; margin-bottom: 8px; }
        .prop-stat-value { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; color: #1a1a1a; }
        .prop-stat-label { font-size: 12px; color: #888; margin-top: 4px; }

        /* DESCRIPTION */
        .detail-desc { font-size: 15px; color: #555; line-height: 1.8; margin-bottom: 36px; }

        /* FEATURES */
        .features-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 12px; margin-bottom: 36px; }
        .feature-item { display: flex; align-items: center; gap: 10px; padding: 12px 16px; background: #fafaf8; border-radius: 8px; border: 1px solid #f0ede8; }
        .feature-icon { font-size: 18px; }
        .feature-text { font-size: 13px; color: #555; font-weight: 500; }

        /* MAP */
        .map-placeholder { height: 200px; background: #f0ede8; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 36px; color: #888; font-size: 14px; }

        /* RIGHT - STICKY CARD */
        .detail-right { }
        .contact-card { background: #fff; border: 1.5px solid #e8e3db; border-radius: 16px; padding: 28px; position: sticky; top: 93px; }
        .contact-card-price { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; color: #C8873A; margin-bottom: 4px; }
        .contact-card-price span { font-size: 14px; font-family: 'DM Sans', sans-serif; font-weight: 300; color: #999; }
        .contact-divider { height: 1px; background: #f0ede8; margin: 20px 0; }

        /* PROPRIETAIRE */
        .owner-section { margin-bottom: 20px; }
        .owner-label { font-size: 11px; color: #888; letter-spacing: 2px; text-transform: uppercase; font-weight: 500; margin-bottom: 12px; }
        .owner-card { display: flex; align-items: center; gap: 12px; }
        .owner-avatar {
            width: 48px; height: 48px; border-radius: 50%;
            background: linear-gradient(135deg, #C8873A, #E8A855);
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; font-weight: 700; color: #fff; flex-shrink: 0;
        }
        .owner-name { font-size: 15px; font-weight: 500; color: #1a1a1a; }
        .owner-verified { font-size: 12px; color: #27500A; margin-top: 2px; }
        .owner-since { font-size: 12px; color: #888; }

        /* BUTTONS */
        .contact-btn {
            width: 100%; padding: 14px; border: none; border-radius: 8px;
            font-size: 14px; font-weight: 500; cursor: pointer;
            font-family: 'DM Sans', sans-serif; transition: all 0.2s;
            margin-bottom: 10px; text-align: center; text-decoration: none; display: block;
        }
        .btn-primary-gold { background: #C8873A; color: #fff; }
        .btn-primary-gold:hover { background: #b07530; }
        .btn-dark { background: #1a1a1a; color: #fff; }
        .btn-dark:hover { background: #C8873A; }
        .btn-outline { background: transparent; border: 1.5px solid #e8e3db; color: #555; }
        .btn-outline:hover { border-color: #C8873A; color: #C8873A; }

        .contact-note { font-size: 12px; color: #aaa; text-align: center; margin-top: 12px; line-height: 1.6; }

        /* SIMILAR */
        .similar-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 20px; margin-top: 16px; }
        .similar-card { border-radius: 10px; overflow: hidden; border: 1px solid #ede9e3; transition: transform 0.2s; }
        .similar-card:hover { transform: translateY(-3px); }
        .similar-img { height: 140px; background-size: cover; background-position: center; }
        .similar-body { padding: 14px 16px; }
        .similar-price { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; color: #C8873A; }
        .similar-title { font-size: 13px; font-weight: 500; color: #1a1a1a; margin: 4px 0; }
        .similar-loc { font-size: 12px; color: #999; }

        .img-main { background-image: url('https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=900&q=85'); }
        .img-s1 { background-image: url('https://images.unsplash.com/photo-1484154218962-a197022b5858?w=400&q=80'); }
        .img-s2 { background-image: url('https://images.unsplash.com/photo-1507089947368-19c1da9775ae?w=400&q=80'); }
        .img-sim1 { background-image: url('https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=400&q=80'); }
        .img-sim2 { background-image: url('https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=400&q=80'); }
        .img-sim3 { background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=400&q=80'); }
@endsection

@section('content')
<div class="detail-wrap">

    {{-- BREADCRUMB --}}
    <div class="breadcrumb">
        <a href="/">Accueil</a>
        <span class="breadcrumb-sep">›</span>
        <a href="/biens">Logements</a>
        <span class="breadcrumb-sep">›</span>
        <span class="breadcrumb-current">Studio meublé — Guéliz</span>
    </div>

    {{-- HEADER --}}
    <div class="detail-header">
        <div class="detail-header-left">
            <div class="detail-badges">
                <span class="detail-badge badge-type">Studio</span>
                <span class="detail-badge badge-available">✅ Disponible</span>
                <span class="detail-badge badge-student">🎓 Étudiant accepté</span>
            </div>
            <h1 class="detail-title">Studio meublé — Guéliz</h1>
            <p class="detail-loc">📍 Guéliz, Marrakech, Maroc</p>
        </div>
        <div class="detail-header-right">
            <div class="detail-price">2 500 MAD <span>/ mois</span></div>
            <div class="detail-views">👁 142 vues</div>
        </div>
    </div>

    {{-- GALLERY --}}
    <div class="gallery">
        <div class="gallery-main img-main">
            <div class="gallery-overlay" onclick="alert('Galerie complète')">📷 Voir toutes les photos</div>
        </div>
        <div class="gallery-img img-s1"></div>
        <div class="gallery-img img-s2"></div>
    </div>

    {{-- CONTENT --}}
    <div class="detail-content">

        {{-- LEFT --}}
        <div class="detail-left">

            {{-- STATS --}}
            <div class="prop-stats">
                <div class="prop-stat">
                    <div class="prop-stat-icon">📐</div>
                    <div class="prop-stat-value">35m²</div>
                    <div class="prop-stat-label">Surface</div>
                </div>
                <div class="prop-stat">
                    <div class="prop-stat-icon">🛏</div>
                    <div class="prop-stat-value">1</div>
                    <div class="prop-stat-label">Chambre</div>
                </div>
                <div class="prop-stat">
                    <div class="prop-stat-icon">🚿</div>
                    <div class="prop-stat-value">1</div>
                    <div class="prop-stat-label">Salle de bain</div>
                </div>
                <div class="prop-stat">
                    <div class="prop-stat-icon">🏢</div>
                    <div class="prop-stat-value">3ème</div>
                    <div class="prop-stat-label">Étage</div>
                </div>
            </div>

            {{-- DESCRIPTION --}}
            <div class="section-title">Description</div>
            <div class="detail-desc">
                Beau studio entièrement meublé situé au cœur du quartier Guéliz à Marrakech. Idéal pour les étudiants et jeunes actifs, ce logement offre tout le confort nécessaire pour une vie agréable.
                <br><br>
                Le studio dispose d'une cuisine équipée avec réfrigérateur, micro-ondes et plaques de cuisson. La salle de bain est moderne avec douche italienne. Le salon/chambre est lumineux avec une grande fenêtre donnant sur une rue calme.
                <br><br>
                Situé à 5 minutes à pied du tramway et à proximité de nombreux commerces, restaurants et cafés. Accès internet haut débit inclus dans le loyer.
            </div>

            {{-- EQUIPEMENTS --}}
            <div class="section-title">Équipements</div>
            <div class="features-grid">
                <div class="feature-item"><span class="feature-icon">📶</span><span class="feature-text">WiFi inclus</span></div>
                <div class="feature-item"><span class="feature-icon">❄️</span><span class="feature-text">Climatisation</span></div>
                <div class="feature-item"><span class="feature-icon">🍳</span><span class="feature-text">Cuisine équipée</span></div>
                <div class="feature-item"><span class="feature-icon">🛋️</span><span class="feature-text">Meublé</span></div>
                <div class="feature-item"><span class="feature-icon">🔒</span><span class="feature-text">Sécurité 24h</span></div>
                <div class="feature-item"><span class="feature-icon">🚗</span><span class="feature-text">Parking</span></div>
                <div class="feature-item"><span class="feature-icon">🏊</span><span class="feature-text">Piscine</span></div>
                <div class="feature-item"><span class="feature-icon">🌿</span><span class="feature-text">Jardin</span></div>
                <div class="feature-item"><span class="feature-icon">🧺</span><span class="feature-text">Lave-linge</span></div>
            </div>

            {{-- LOCALISATION --}}
            <div class="section-title">Localisation</div>
            <div class="map-placeholder">
                🗺️ Guéliz, Marrakech — Carte interactive disponible bientôt
            </div>

            {{-- ANNONCES SIMILAIRES --}}
            <div class="section-title">Annonces similaires</div>
            <div class="similar-grid">
                <a href="/biens/2" class="similar-card" style="text-decoration:none;">
                    <div class="similar-img img-sim1"></div>
                    <div class="similar-body">
                        <div class="similar-price">4 200 MAD</div>
                        <div class="similar-title">Appartement F2 moderne</div>
                        <div class="similar-loc">📍 Casablanca</div>
                    </div>
                </a>
                <a href="/biens/3" class="similar-card" style="text-decoration:none;">
                    <div class="similar-img img-sim2"></div>
                    <div class="similar-body">
                        <div class="similar-price">1 200 MAD</div>
                        <div class="similar-title">Chambre en colocation</div>
                        <div class="similar-loc">📍 Rabat</div>
                    </div>
                </a>
                <a href="/biens/4" class="similar-card" style="text-decoration:none;">
                    <div class="similar-img img-sim3"></div>
                    <div class="similar-body">
                        <div class="similar-price">5 500 MAD</div>
                        <div class="similar-title">Appartement luxueux</div>
                        <div class="similar-loc">📍 Marrakech</div>
                    </div>
                </a>
            </div>

        </div>

        {{-- RIGHT --}}
        <div class="detail-right">
            <div class="contact-card">
                <div class="contact-card-price">2 500 MAD <span>/ mois</span></div>

                <div class="contact-divider"></div>

                <div class="owner-section">
                    <div class="owner-label">Propriétaire</div>
                    <div class="owner-card">
                        <div class="owner-avatar">MK</div>
                        <div>
                            <div class="owner-name">Mohammed Karimi</div>
                            <div class="owner-verified">✅ Profil vérifié</div>
                            <div class="owner-since">Membre depuis 2024</div>
                        </div>
                    </div>
                </div>

                <div class="contact-divider"></div>

                @auth
                    <a href="#" class="contact-btn btn-primary-gold">📅 Demander un rendez-vous</a>
                    <a href="#" class="contact-btn btn-dark">💬 Envoyer un message</a>
                    <button class="contact-btn btn-outline">🤍 Ajouter aux favoris</button>
                @else
                    <a href="/login" class="contact-btn btn-primary-gold">🔐 Connectez-vous pour contacter</a>
                    <a href="/register" class="contact-btn btn-outline">Créer un compte gratuit</a>
                @endauth

                <div class="contact-note">
                    🔒 Vos données sont protégées.<br>
                    Aucune commission, contact direct avec le propriétaire.
                </div>
            </div>
        </div>

    </div>
</div>
@endsection