<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaskanTech — Trouvez votre logement</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; color: #1a1a1a; }

        /* NAVBAR */
        nav { display: flex; justify-content: space-between; align-items: center; padding: 16px 40px; background: white; border-bottom: 1px solid #eee; }
        .logo { font-size: 22px; font-weight: 700; color: #185FA5; }
        .logo span { color: #1a1a1a; }
        .nav-links { display: flex; gap: 12px; }
        .btn { padding: 8px 20px; border-radius: 8px; font-size: 14px; cursor: pointer; text-decoration: none; }
        .btn-outline { border: 1px solid #185FA5; color: #185FA5; background: white; }
        .btn-primary { background: #185FA5; color: white; border: none; }

        /* HERO */
        .hero { background: linear-gradient(135deg, #EBF4FF 0%, #F0FBF7 100%); padding: 80px 40px; text-align: center; }
        .hero h1 { font-size: 42px; font-weight: 700; margin-bottom: 16px; color: #0C447C; }
        .hero p { font-size: 18px; color: #555; margin-bottom: 40px; }
        .search-bar { display: flex; gap: 10px; justify-content: center; flex-wrap: wrap; }
        .search-bar input, .search-bar select { padding: 12px 16px; border: 1px solid #ddd; border-radius: 8px; font-size: 14px; min-width: 180px; }
        .search-bar button { padding: 12px 28px; background: #185FA5; color: white; border: none; border-radius: 8px; font-size: 14px; cursor: pointer; font-weight: 600; }

        /* STATS */
        .stats { display: flex; justify-content: center; gap: 60px; padding: 40px; background: white; }
        .stat { text-align: center; }
        .stat-number { font-size: 32px; font-weight: 700; color: #185FA5; }
        .stat-label { font-size: 14px; color: #777; margin-top: 4px; }

        /* FEATURES */
        .features { padding: 60px 40px; background: #F8FAFC; text-align: center; }
        .features h2 { font-size: 28px; font-weight: 700; margin-bottom: 40px; }
        .features-grid { display: flex; gap: 24px; justify-content: center; flex-wrap: wrap; }
        .feature-card { background: white; border: 1px solid #eee; border-radius: 12px; padding: 28px 24px; width: 200px; }
        .feature-icon { font-size: 36px; margin-bottom: 12px; }
        .feature-title { font-size: 15px; font-weight: 600; margin-bottom: 8px; }
        .feature-desc { font-size: 13px; color: #777; line-height: 1.5; }

        /* ANNONCES */
        .annonces { padding: 60px 40px; }
        .annonces h2 { font-size: 28px; font-weight: 700; margin-bottom: 8px; text-align: center; }
        .annonces p { text-align: center; color: #777; margin-bottom: 32px; }
        .annonces-grid { display: flex; gap: 20px; justify-content: center; flex-wrap: wrap; }
        .annonce-card { background: white; border: 1px solid #eee; border-radius: 12px; width: 260px; overflow: hidden; }
        .annonce-img { height: 140px; background: #E6F1FB; display: flex; align-items: center; justify-content: center; font-size: 40px; }
        .annonce-body { padding: 16px; }
        .badge { display: inline-block; font-size: 11px; padding: 3px 10px; border-radius: 20px; margin-bottom: 8px; font-weight: 500; }
        .badge-blue { background: #E6F1FB; color: #0C447C; }
        .badge-green { background: #EAF3DE; color: #27500A; }
        .badge-purple { background: #EEEDFE; color: #3C3489; }
        .annonce-title { font-size: 15px; font-weight: 600; margin-bottom: 4px; }
        .annonce-price { font-size: 18px; font-weight: 700; color: #185FA5; margin-bottom: 6px; }
        .annonce-meta { font-size: 12px; color: #888; margin-bottom: 12px; }
        .annonce-btn { display: block; text-align: center; padding: 8px; background: #185FA5; color: white; border-radius: 8px; text-decoration: none; font-size: 13px; }

        /* FOOTER */
        footer { background: #0C447C; color: white; text-align: center; padding: 24px; font-size: 14px; }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav>
        <div class="logo">Maskan<span>Tech</span> 🏠</div>
        <div class="nav-links">
            <a href="#" class="btn btn-outline">Connexion</a>
            <a href="#" class="btn btn-primary">S'inscrire</a>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <h1>Trouvez votre logement<br>en toute confiance</h1>
        <p>Sans intermédiaire, partout au Maroc</p>
        <div class="search-bar">
            <input type="text" placeholder="🔍 Ville ou quartier..." />
            <select>
                <option>Tout type</option>
                <option>Appartement</option>
                <option>Studio</option>
                <option>Chambre</option>
                <option>Colocation</option>
            </select>
            <select>
                <option>Budget max</option>
                <option>1 000 MAD</option>
                <option>2 000 MAD</option>
                <option>3 000 MAD</option>
                <option>5 000 MAD</option>
            </select>
            <button>Rechercher</button>
        </div>
    </section>

    <!-- STATS -->
    <div class="stats">
        <div class="stat">
            <div class="stat-number">1 200+</div>
            <div class="stat-label">Annonces disponibles</div>
        </div>
        <div class="stat">
            <div class="stat-number">8 000+</div>
            <div class="stat-label">Utilisateurs satisfaits</div>
        </div>
        <div class="stat">
            <div class="stat-number">50+</div>
            <div class="stat-label">Villes au Maroc</div>
        </div>
        <div class="stat">
            <div class="stat-number">100%</div>
            <div class="stat-label">Annonces vérifiées</div>
        </div>
    </div>

    <!-- FEATURES -->
    <section class="features">
        <h2>Pourquoi choisir MaskanTech ?</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">✅</div>
                <div class="feature-title">Annonces vérifiées</div>
                <div class="feature-desc">Chaque annonce est validée manuellement par notre équipe</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon">💬</div>
                <div class="feature-title">Contact direct</div>
                <div class="feature-desc">Messagerie sécurisée sans intermédiaire</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🎓</div>
                <div class="feature-title">Espace étudiant</div>
                <div class="feature-desc">Logements dédiés aux étudiants partout au Maroc</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🔒</div>
                <div class="feature-title">Zéro commission</div>
                <div class="feature-desc">Relation directe propriétaire et locataire</div>
            </div>
        </div>
    </section>

    <!-- ANNONCES RECENTES -->
    <section class="annonces">
        <h2>Annonces récentes</h2>
        <p>Découvrez les derniers logements disponibles</p>
        <div class="annonces-grid">
            <div class="annonce-card">
                <div class="annonce-img">🏠</div>
                <div class="annonce-body">
                    <span class="badge badge-blue">Studio</span>
                    <span class="badge badge-green">Étudiant accepté</span>
                    <div class="annonce-title">Studio meublé — Guéliz</div>
                    <div class="annonce-price">2 500 MAD/mois</div>
                    <div class="annonce-meta">📍 Guéliz, Marrakech · 35m²</div>
                    <a href="#" class="annonce-btn">Voir l'annonce</a>
                </div>
            </div>
            <div class="annonce-card">
                <div class="annonce-img">🏢</div>
                <div class="annonce-body">
                    <span class="badge badge-blue">Colocation</span>
                    <span class="badge badge-purple">Étudiant uniquement</span>
                    <div class="annonce-title">Chambre en colocation — Médina</div>
                    <div class="annonce-price">1 200 MAD/mois</div>
                    <div class="annonce-meta">📍 Médina, Marrakech · 18m²</div>
                    <a href="#" class="annonce-btn">Voir l'annonce</a>
                </div>
            </div>
            <div class="annonce-card">
                <div class="annonce-img">🏗️</div>
                <div class="annonce-body">
                    <span class="badge badge-blue">Appartement</span>
                    <div class="annonce-title">Appartement F2 — Hivernage</div>
                    <div class="annonce-price">4 000 MAD/mois</div>
                    <div class="annonce-meta">📍 Hivernage, Marrakech · 65m²</div>
                    <a href="#" class="annonce-btn">Voir l'annonce</a>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <p>© 2026 MaskanTech — Tous droits réservés · Réalisé par Hajar TANANI & Salmane ELOUZI</p>
    </footer>

</body>
</html>