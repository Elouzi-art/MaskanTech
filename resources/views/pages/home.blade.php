<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaskanTech — Trouvez votre logement au Maroc</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><rect width='32' height='32' rx='7' fill='%23C8873A'/><path d='M6 14L16 7l10 7v10a1 1 0 01-1 1H7a1 1 0 01-1-1V14z' fill='none' stroke='white' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'/><path d='M13 22v-6h6v6' fill='none' stroke='white' stroke-width='2.2' stroke-linecap='round' stroke-linejoin='round'/></svg>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DM Sans', sans-serif; background: #fff; color: #1a1a1a; }

        /* NAVBAR */
        nav {
            display: flex; align-items: center; justify-content: space-between;
            padding: 18px 48px;
            background: rgba(255,255,255,0.97);
            border-bottom: 1px solid #f0ede8;
            position: sticky; top: 0; z-index: 100;
        }
        .logo { display: flex; align-items: center; gap: 10px; text-decoration: none; }
        .logo-icon {
            width: 36px; height: 36px;
            background: linear-gradient(135deg, #C8873A, #E8A855);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
        }
        .logo-icon svg { width: 20px; height: 20px; }
        .logo-text { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; color: #1a1a1a; }
        .logo-text span { color: #C8873A; }
        .nav-links { display: flex; align-items: center; gap: 32px; }
        .nav-links a { font-size: 14px; color: #555; text-decoration: none; transition: color 0.2s; }
        .nav-links a:hover { color: #C8873A; }
        .nav-cta {
            background: #1a1a1a; color: #fff !important;
            padding: 10px 22px; border-radius: 6px;
            font-size: 13px; font-weight: 500;
            transition: background 0.2s !important;
        }
        .nav-cta:hover { background: #C8873A !important; }

        /* HERO SLIDER */
        .hero { position: relative; height: 620px; overflow: hidden; }
        .slide {
            position: absolute; inset: 0;
            background-size: cover; background-position: center;
            opacity: 0; transition: opacity 1.4s ease;
        }
        .slide.active { opacity: 1; }
        .slide::after {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(to right, rgba(10,7,3,0.75) 0%, rgba(10,7,3,0.3) 60%, transparent 100%);
        }
        .slide-1 { background-image: url('https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=1600&q=85'); }
        .slide-2 { background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=1600&q=85'); }
        .slide-3 { background-image: url('https://images.unsplash.com/photo-1598928506311-c55ded91a20c?w=1600&q=85'); }

        .hero-content {
            position: absolute; inset: 0; z-index: 10;
            display: flex; flex-direction: column; justify-content: center;
            padding: 0 80px;
        }
        .hero-tag {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(200,135,58,0.18); border: 1px solid rgba(200,135,58,0.4);
            color: #E8A855; font-size: 11px; font-weight: 500; letter-spacing: 2px;
            padding: 6px 14px; border-radius: 20px; text-transform: uppercase;
            width: fit-content; margin-bottom: 22px;
        }
        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 58px; font-weight: 700; color: #fff;
            line-height: 1.1; margin-bottom: 18px; max-width: 580px;
        }
        .hero h1 em { color: #E8A855; font-style: normal; }
        .hero-sub {
            font-size: 16px; color: rgba(255,255,255,0.72);
            font-weight: 300; margin-bottom: 38px;
            max-width: 440px; line-height: 1.7;
        }

        /* SEARCH BAR */
        .search-bar {
            display: flex; align-items: center;
            background: #fff; border-radius: 10px;
            padding: 6px 6px 6px 20px;
            max-width: 620px;
            box-shadow: 0 8px 40px rgba(0,0,0,0.2);
        }
        .search-bar input {
            border: none; outline: none; font-size: 14px;
            color: #1a1a1a; background: transparent; flex: 1;
            font-family: 'DM Sans', sans-serif; padding: 8px 0;
        }
        .search-bar select {
            border: none; border-left: 1px solid #eee; outline: none;
            font-size: 13px; color: #555; background: transparent;
            padding: 8px 14px; font-family: 'DM Sans', sans-serif; cursor: pointer;
        }
        .search-btn {
            background: #C8873A; color: #fff; border: none;
            border-radius: 7px; padding: 12px 24px;
            font-size: 14px; font-weight: 500; cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            transition: background 0.2s;
        }
        .search-btn:hover { background: #b07530; }

        /* DOTS */
        .dots {
            position: absolute; bottom: 30px; left: 80px; z-index: 20;
            display: flex; gap: 8px;
        }
        .dot {
            width: 28px; height: 3px; border-radius: 2px;
            background: rgba(255,255,255,0.3); cursor: pointer;
            transition: all 0.4s;
        }
        .dot.active { background: #E8A855; width: 50px; }

        /* STATS */
        .stats { display: grid; grid-template-columns: repeat(4,1fr); background: #1a1a1a; }
        .stat { padding: 30px 36px; border-right: 1px solid rgba(255,255,255,0.07); }
        .stat:last-child { border-right: none; }
        .stat-n { font-family: 'Playfair Display', serif; font-size: 34px; font-weight: 700; color: #E8A855; }
        .stat-l { font-size: 13px; color: rgba(255,255,255,0.45); margin-top: 5px; }

        /* SECTIONS */
        .section { padding: 80px; }
        .section-alt { background: #fafaf8; }
        .section-tag { font-size: 11px; color: #C8873A; letter-spacing: 2.5px; text-transform: uppercase; font-weight: 500; margin-bottom: 10px; }
        .section-h2 { font-family: 'Playfair Display', serif; font-size: 38px; font-weight: 700; color: #1a1a1a; margin-bottom: 48px; line-height: 1.2; }

        /* CARDS */
        .cards { display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; }
        .card { border-radius: 12px; overflow: hidden; border: 1px solid #ede9e3; transition: transform 0.25s, box-shadow 0.25s; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 16px 40px rgba(0,0,0,0.1); }
        .card-img { height: 190px; background-size: cover; background-position: center; position: relative; }
        .card-badge {
            position: absolute; top: 12px; left: 12px;
            background: #fff; font-size: 11px; font-weight: 500;
            padding: 4px 10px; border-radius: 20px; color: #1a1a1a;
        }
        .card-student {
            position: absolute; top: 12px; right: 12px;
            background: #C8873A; color: #fff;
            font-size: 11px; font-weight: 500;
            padding: 4px 10px; border-radius: 20px;
        }
        .card-body { padding: 20px 22px; background: #fff; }
        .card-price { font-family: 'Playfair Display', serif; font-size: 24px; font-weight: 700; color: #C8873A; }
        .card-price span { font-size: 13px; font-family: 'DM Sans', sans-serif; font-weight: 300; color: #999; }
        .card-title { font-size: 15px; font-weight: 500; color: #1a1a1a; margin: 6px 0 4px; }
        .card-loc { font-size: 13px; color: #999; }
        .card-btn {
            display: block; text-align: center; margin-top: 16px;
            padding: 10px; border: 1px solid #C8873A; color: #C8873A;
            border-radius: 7px; text-decoration: none; font-size: 13px; font-weight: 500;
            transition: all 0.2s;
        }
        .card-btn:hover { background: #C8873A; color: #fff; }

        .img-1 { background-image: url('https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=600&q=80'); }
        .img-2 { background-image: url('https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=600&q=80'); }
        .img-3 { background-image: url('https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=600&q=80'); }

        /* FEATURES */
        .features { display: grid; grid-template-columns: repeat(4,1fr); gap: 24px; }
        .feat { text-align: center; padding: 36px 20px; }
        .feat-icon {
            width: 56px; height: 56px; border-radius: 14px;
            background: #fdf6ee; font-size: 24px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 18px;
        }
        .feat-title { font-size: 15px; font-weight: 500; margin-bottom: 8px; }
        .feat-desc { font-size: 13px; color: #888; line-height: 1.7; }

        /* CTA BANNER */
        .cta-banner {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2010 100%);
            padding: 72px 80px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .cta-banner h2 { font-family: 'Playfair Display', serif; font-size: 36px; color: #fff; font-weight: 700; }
        .cta-banner h2 span { color: #E8A855; }
        .cta-banner p { font-size: 15px; color: rgba(255,255,255,0.55); margin-top: 8px; }
        .cta-btns { display: flex; gap: 12px; }
        .btn-gold { background: #C8873A; color: #fff; padding: 14px 28px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 500; transition: background 0.2s; }
        .btn-gold:hover { background: #b07530; }
        .btn-outline-w { border: 1px solid rgba(255,255,255,0.3); color: #fff; padding: 14px 28px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 500; transition: border-color 0.2s; }
        .btn-outline-w:hover { border-color: #E8A855; color: #E8A855; }

        /* FOOTER */
        footer { background: #111; padding: 40px 80px; display: flex; justify-content: space-between; align-items: center; }
        .footer-logo { font-family: 'Playfair Display', serif; font-size: 20px; color: #fff; }
        .footer-logo span { color: #C8873A; }
        .footer-copy { font-size: 13px; color: #444; }
    </style>
</head>
<body>

    <nav>
        <a class="logo" href="#">
            <div class="logo-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1H4a1 1 0 01-1-1V9.5z"/>
                    <path d="M9 21V12h6v9"/>
                </svg>
            </div>
            <span class="logo-text">Maskan<span>Tech</span></span>
        </a>
        <div class="nav-links">
            <a href="/Logements">Logements</a>
            <a href="#">Étudiants</a>
            <a href="#">Propriétaires</a>
            @auth
                <a href="/dashboard">Mon espace</a>
                <a href="#" class="nav-cta">Connecté</a>
            @else
                <a href="/login">Connexion</a>
                <a href="/register" class="nav-cta">S'inscrire</a>
            @endauth
        </div>
    </nav>

    <div class="hero">
        <div class="slide slide-1 active"></div>
        <div class="slide slide-2"></div>
        <div class="slide slide-3"></div>

        <div class="hero-content">
            <div class="hero-tag">🇲🇦 Plateforme immobilière marocaine</div>
            <h1>Trouvez votre<br><em>chez-vous</em><br>au Maroc</h1>
            <p class="hero-sub">Sans intermédiaire, sans commission. Des milliers d'annonces vérifiées partout au Maroc.</p>
            <div class="search-bar">
                <input type="text" placeholder="Ville, quartier, titre..."/>
                <select>
                    <option>Tout type</option>
                    <option>Appartement</option>
                    <option>Studio</option>
                    <option>Colocation</option>
                    <option>Villa</option>
                </select>
                <select>
                    <option>Budget</option>
                    <option>moins de 1 500 MAD</option>
                    <option>1 500 – 3 000 MAD</option>
                    <option>3 000 – 6 000 MAD</option>
                    <option>+ 6 000 MAD</option>
                </select>
                <button class="search-btn">Rechercher</button>
            </div>
        </div>

        <div class="dots">
            <div class="dot active" onclick="goSlide(0)"></div>
            <div class="dot" onclick="goSlide(1)"></div>
            <div class="dot" onclick="goSlide(2)"></div>
        </div>
    </div>

    <div class="stats">
        <div class="stat"><div class="stat-n">1 200+</div><div class="stat-l">Annonces disponibles</div></div>
        <div class="stat"><div class="stat-n">8 000+</div><div class="stat-l">Utilisateurs satisfaits</div></div>
        <div class="stat"><div class="stat-n">50+</div><div class="stat-l">Villes au Maroc</div></div>
        <div class="stat"><div class="stat-n">100%</div><div class="stat-l">Annonces vérifiées</div></div>
    </div>

    <div class="section section-alt">
        <div class="section-tag">Annonces récentes</div>
        <div class="section-h2">Logements disponibles maintenant</div>
        <div class="cards">
            <div class="card">
                <div class="card-img img-1">
                    <span class="card-badge">Studio</span>
                    <span class="card-student">🎓 Étudiant</span>
                </div>
                <div class="card-body">
                    <div class="card-price">2 500 MAD <span>/ mois</span></div>
                    <div class="card-title">Studio meublé — Guéliz</div>
                    <div class="card-loc">📍 Marrakech · 35m²</div>
                    <a href="/Logements" class="card-btn">Voir l'annonce</a>
                </div>
            </div>
            <div class="card">
                <div class="card-img img-2">
                    <span class="card-badge">Appartement</span>
                </div>
                <div class="card-body">
                    <div class="card-price">4 200 MAD <span>/ mois</span></div>
                    <div class="card-title">Appartement F2 moderne</div>
                    <div class="card-loc">📍 Casablanca · 65m²</div>
                    <a href="/Logements" class="card-btn">Voir l'annonce</a>
                </div>
            </div>
            <div class="card">
                <div class="card-img img-3">
                    <span class="card-badge">Colocation</span>
                    <span class="card-student">🎓 Étudiant</span>
                </div>
                <div class="card-body">
                    <div class="card-price">1 200 MAD <span>/ mois</span></div>
                    <div class="card-title">Chambre en colocation</div>
                    <div class="card-loc">📍 Rabat · 18m²</div>
                    <a href="/Logements" class="card-btn">Voir l'annonce</a>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-tag">Pourquoi nous ?</div>
        <div class="section-h2">Ce qui nous différencie</div>
        <div class="features">
            <div class="feat">
                <div class="feat-icon">✅</div>
                <div class="feat-title">Annonces vérifiées</div>
                <div class="feat-desc">Chaque annonce est validée manuellement avant publication</div>
            </div>
            <div class="feat">
                <div class="feat-icon">🎓</div>
                <div class="feat-title">Espace étudiant</div>
                <div class="feat-desc">Filtrez uniquement les logements ouverts aux étudiants</div>
            </div>
            <div class="feat">
                <div class="feat-icon">💬</div>
                <div class="feat-title">Contact direct</div>
                <div class="feat-desc">Messagerie sécurisée sans aucun intermédiaire</div>
            </div>
            <div class="feat">
                <div class="feat-icon">🔒</div>
                <div class="feat-title">Zéro commission</div>
                <div class="feat-desc">Relation directe entre propriétaire et locataire</div>
            </div>
        </div>
    </div>

    <div class="cta-banner">
        <div>
            <h2>Vous êtes <span>propriétaire</span> ?</h2>
            <p>Publiez votre annonce gratuitement et trouvez votre locataire rapidement.</p>
        </div>
        <div class="cta-btns">
            <a href="/register" class="btn-gold">Publier une annonce</a>
            <a href="/Logements" class="btn-outline-w">Explorer les Logements</a>
        </div>
    </div>

    <footer>
        <div class="footer-logo">Maskan<span>Tech</span></div>
        <div class="footer-copy">© 2026 — Hajar Tanani & Salmane Elouzi</div>
    </footer>

    <script>
        let cur = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');
        function goSlide(n) {
            slides[cur].classList.remove('active');
            dots[cur].classList.remove('active');
            cur = n;
            slides[cur].classList.add('active');
            dots[cur].classList.add('active');
        }
        setInterval(() => goSlide((cur + 1) % slides.length), 5000);
    </script>

</body>
</html>