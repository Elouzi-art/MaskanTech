@extends('layouts.maskan')

@section('title', 'MaskanTech — Logements à louer')

@section('styles')
        .page-wrap { display: flex; min-height: calc(100vh - 73px); }

        /* SIDEBAR FILTRES */
        .sidebar {
            width: 280px; min-width: 280px;
            border-right: 1px solid #f0ede8;
            padding: 32px 28px;
            position: sticky; top: 73px;
            height: calc(100vh - 73px);
            overflow-y: auto;
        }
        .sidebar-title {
            font-family: 'Playfair Display', serif;
            font-size: 18px; font-weight: 700; color: #1a1a1a;
            margin-bottom: 24px;
        }
        .filter-group { margin-bottom: 24px; }
        .filter-label {
            font-size: 11px; color: #888; letter-spacing: 2px;
            text-transform: uppercase; font-weight: 500; margin-bottom: 10px; display: block;
        }
        .filter-group input, .filter-group select {
            width: 100%; padding: 11px 14px;
            border: 1.5px solid #e8e3db; border-radius: 8px;
            font-size: 13px; font-family: 'DM Sans', sans-serif;
            color: #1a1a1a; outline: none; transition: border-color 0.2s;
        }
        .filter-group input:focus, .filter-group select:focus { border-color: #C8873A; }
        .price-row { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
        .filter-btn {
            width: 100%; padding: 12px;
            background: #1a1a1a; color: #fff; border: none;
            border-radius: 8px; font-size: 13px; font-weight: 500;
            cursor: pointer; font-family: 'DM Sans', sans-serif;
            transition: background 0.2s; margin-top: 8px;
        }
        .filter-btn:hover { background: #C8873A; }
        .reset-btn {
            width: 100%; padding: 10px;
            background: transparent; color: #888; border: 1.5px solid #e8e3db;
            border-radius: 8px; font-size: 13px; cursor: pointer;
            font-family: 'DM Sans', sans-serif; transition: all 0.2s; margin-top: 8px;
        }
        .reset-btn:hover { border-color: #C8873A; color: #C8873A; }

        /* STUDENT TOGGLE */
        .student-toggle {
            display: flex; align-items: center; justify-content: space-between;
            background: #f0f7ff; border: 1.5px solid #b8d4f0;
            border-radius: 10px; padding: 14px 16px; margin-bottom: 24px;
            cursor: pointer; transition: all 0.2s;
        }
        .student-toggle.active { background: #185FA5; border-color: #185FA5; }
        .student-toggle-left { display: flex; align-items: center; gap: 10px; }
        .student-toggle-icon { font-size: 20px; }
        .student-toggle-text { font-size: 13px; font-weight: 500; color: #185FA5; }
        .student-toggle.active .student-toggle-text { color: #fff; }
        .toggle-switch {
            width: 36px; height: 20px; background: #b8d4f0;
            border-radius: 10px; position: relative; transition: background 0.2s;
        }
        .student-toggle.active .toggle-switch { background: #fff; }
        .toggle-switch::after {
            content: ''; position: absolute; top: 3px; left: 3px;
            width: 14px; height: 14px; border-radius: 50%;
            background: #185FA5; transition: transform 0.2s;
        }
        .student-toggle.active .toggle-switch::after { transform: translateX(16px); background: #185FA5; }

        /* MAIN */
        .main { flex: 1; padding: 32px 40px; }
        .main-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 28px;
        }
        .main-title { font-family: 'Playfair Display', serif; font-size: 26px; font-weight: 700; color: #1a1a1a; }
        .main-count { font-size: 14px; color: #888; margin-top: 4px; }
        .sort-select {
            padding: 10px 16px; border: 1.5px solid #e8e3db;
            border-radius: 8px; font-size: 13px; color: #555;
            font-family: 'DM Sans', sans-serif; outline: none; cursor: pointer;
        }
        .sort-select:focus { border-color: #C8873A; }

        /* GRID */
        .properties-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }

        /* PROPERTY CARD */
        .prop-card {
            border-radius: 12px; overflow: hidden;
            border: 1px solid #ede9e3;
            transition: transform 0.25s, box-shadow 0.25s;
            background: #fff;
        }
        .prop-card:hover { transform: translateY(-5px); box-shadow: 0 16px 40px rgba(0,0,0,0.1); }
        .prop-img {
            height: 200px; background-size: cover; background-position: center;
            position: relative;
        }
        .prop-badges { position: absolute; top: 12px; left: 12px; display: flex; gap: 6px; flex-wrap: wrap; }
        .prop-badge {
            font-size: 11px; font-weight: 500; padding: 4px 10px;
            border-radius: 20px; background: #fff; color: #1a1a1a;
        }
        .prop-badge-student { background: #185FA5; color: #fff; }
        .prop-badge-gold { background: #C8873A; color: #fff; }
        .prop-badge-restricted {
            background: rgba(0,0,0,0.6); color: #fff;
            font-size: 10px;
        }
        .prop-favorite {
            position: absolute; top: 12px; right: 12px;
            width: 34px; height: 34px; border-radius: 50%;
            background: rgba(255,255,255,0.9); border: none;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 16px; transition: all 0.2s;
        }
        .prop-favorite:hover { background: #fff; transform: scale(1.1); }
        .prop-body { padding: 18px 20px; }
        .prop-price { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: #C8873A; }
        .prop-price span { font-size: 13px; font-family: 'DM Sans', sans-serif; font-weight: 300; color: #999; }
        .prop-title { font-size: 15px; font-weight: 500; color: #1a1a1a; margin: 6px 0 4px; }
        .prop-loc { font-size: 13px; color: #999; margin-bottom: 12px; }
        .prop-details { display: flex; gap: 16px; margin-bottom: 16px; flex-wrap: wrap; }
        .prop-detail { font-size: 12px; color: #666; display: flex; align-items: center; gap: 4px; }
        .prop-actions { display: flex; gap: 8px; }
        .prop-btn-primary {
            flex: 1; padding: 10px; background: #1a1a1a; color: #fff;
            border: none; border-radius: 7px; font-size: 13px; font-weight: 500;
            cursor: pointer; font-family: 'DM Sans', sans-serif;
            transition: background 0.2s; text-decoration: none; text-align: center;
        }
        .prop-btn-primary:hover { background: #C8873A; }
        .prop-btn-outline {
            padding: 10px 14px; border: 1.5px solid #e8e3db; color: #555;
            border-radius: 7px; font-size: 13px; cursor: pointer;
            background: transparent; font-family: 'DM Sans', sans-serif;
            transition: all 0.2s;
        }
        .prop-btn-outline:hover { border-color: #C8873A; color: #C8873A; }

        /* CARD BLURRED pour locataire */
        .prop-card.restricted { position: relative; }
        .prop-card.restricted .prop-body { filter: blur(3px); pointer-events: none; }
        .restricted-overlay {
            display: none;
            position: absolute; inset: 0; z-index: 10;
            background: rgba(255,255,255,0.85);
            align-items: center; justify-content: center;
            flex-direction: column; text-align: center; padding: 20px;
            border-radius: 12px;
        }
        .prop-card.restricted .restricted-overlay { display: flex; }
        .restricted-icon { font-size: 32px; margin-bottom: 10px; }
        .restricted-text { font-size: 13px; font-weight: 500; color: #1a1a1a; margin-bottom: 12px; }
        .restricted-btn {
            padding: 10px 20px; background: #185FA5; color: #fff;
            border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 500;
        }

        .img-a { background-image: url('https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=600&q=80'); }
        .img-b { background-image: url('https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=600&q=80'); }
        .img-c { background-image: url('https://images.unsplash.com/photo-1493809842364-78817add7ffb?w=600&q=80'); }
        .img-d { background-image: url('https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=600&q=80'); }
        .img-e { background-image: url('https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=600&q=80'); }
        .img-f { background-image: url('https://images.unsplash.com/photo-1598928506311-c55ded91a20c?w=600&q=80'); }
@endsection

@section('content')
<div class="page-wrap">

    {{-- SIDEBAR --}}
    <div class="sidebar">
        <div class="sidebar-title">Filtrer</div>

        {{-- TOGGLE ÉTUDIANT visible uniquement pour les étudiants connectés --}}
        @auth
            @if(auth()->user()->role === 'student')
            <div class="student-toggle" id="studentToggle" onclick="toggleStudent()">
                <div class="student-toggle-left">
                    <span class="student-toggle-icon">🎓</span>
                    <span class="student-toggle-text">Annonces étudiants</span>
                </div>
                <div class="toggle-switch"></div>
            </div>
            @endif
        @endauth

        <div class="filter-group">
            <span class="filter-label">Mot-clé</span>
            <input type="text" id="search" placeholder="Titre, ville, description...">
        </div>

        <div class="filter-group">
            <span class="filter-label">Type de bien</span>
            <select id="type">
                <option value="">Tous les types</option>
                <option value="apartment">Appartement</option>
                <option value="house">Maison</option>
                <option value="studio">Studio</option>
                <option value="room">Chambre</option>
                <option value="colocation">Colocation</option>
            </select>
        </div>

        <div class="filter-group">
            <span class="filter-label">Ville</span>
            <input type="text" id="city" placeholder="Casablanca, Marrakech...">
        </div>

        <div class="filter-group">
            <span class="filter-label">Loyer / mois (MAD)</span>
            <div class="price-row">
                <input type="number" id="price-min" placeholder="Min">
                <input type="number" id="price-max" placeholder="Max">
            </div>
        </div>

        <div class="filter-group">
            <span class="filter-label">Chambres min.</span>
            <select id="bedrooms">
                <option value="">Peu importe</option>
                <option value="1">1+</option>
                <option value="2">2+</option>
                <option value="3">3+</option>
                <option value="4">4+</option>
            </select>
        </div>

        <button class="filter-btn" onclick="applyFilters()">Appliquer les filtres</button>
        <button class="reset-btn" onclick="resetFilters()">Réinitialiser</button>
    </div>

    {{-- MAIN --}}
    <div class="main">
        <div class="main-header">
            <div>
                <div class="main-title">Logements à louer</div>
                <div class="main-count" id="count">6 annonce(s) trouvée(s)</div>
            </div>
            <select class="sort-select">
                <option>Plus récents</option>
                <option>Prix croissant</option>
                <option>Prix décroissant</option>
            </select>
        </div>

        <div class="properties-grid" id="grid">

            <div class="prop-card" data-type="studio" data-city="marrakech" data-price="2500" data-student="false">
                <div class="prop-img img-a">
                    <div class="prop-badges">
                        <span class="prop-badge">Studio</span>
                    </div>
                    <button class="prop-favorite">🤍</button>
                </div>
                <div class="prop-body">
                    <div class="prop-price">2 500 MAD <span>/ mois</span></div>
                    <div class="prop-title">Studio meublé — Guéliz</div>
                    <div class="prop-loc">📍 Marrakech · 35m²</div>
                    <div class="prop-details">
                        <span class="prop-detail">🛏 1 chambre</span>
                        <span class="prop-detail">🚿 1 sdb</span>
                        <span class="prop-detail">📐 35m²</span>
                    </div>
                    <div class="prop-actions">
                        <a href="/biens/1" class="prop-btn-primary">Voir l'annonce</a>
                        <button class="prop-btn-outline">💬</button>
                    </div>
                </div>
            </div>

            <div class="prop-card" data-type="apartment" data-city="casablanca" data-price="4200" data-student="false">
                <div class="prop-img img-b">
                    <div class="prop-badges">
                        <span class="prop-badge">Appartement</span>
                    </div>
                    <button class="prop-favorite">🤍</button>
                </div>
                <div class="prop-body">
                    <div class="prop-price">4 200 MAD <span>/ mois</span></div>
                    <div class="prop-title">Appartement F2 moderne</div>
                    <div class="prop-loc">📍 Casablanca · 65m²</div>
                    <div class="prop-details">
                        <span class="prop-detail">🛏 2 chambres</span>
                        <span class="prop-detail">🚿 1 sdb</span>
                        <span class="prop-detail">📐 65m²</span>
                    </div>
                    <div class="prop-actions">
                        <a href="/biens/2" class="prop-btn-primary">Voir l'annonce</a>
                        <button class="prop-btn-outline">💬</button>
                    </div>
                </div>
            </div>

            <div class="prop-card" data-type="room" data-city="rabat" data-price="1200" data-student="true">
                <div class="prop-img img-c">
                    <div class="prop-badges">
                        <span class="prop-badge">Chambre</span>
                        <span class="prop-badge prop-badge-student">🎓 Étudiant uniquement</span>
                    </div>
                    <button class="prop-favorite">🤍</button>
                    <div class="restricted-overlay">
                        <div class="restricted-icon">🎓</div>
                        <div class="restricted-text">Réservé aux étudiants inscrits</div>
                        <a href="/register" class="restricted-btn">S'inscrire comme étudiant</a>
                    </div>
                </div>
                <div class="prop-body">
                    <div class="prop-price">1 200 MAD <span>/ mois</span></div>
                    <div class="prop-title">Chambre en colocation</div>
                    <div class="prop-loc">📍 Rabat · 18m²</div>
                    <div class="prop-details">
                        <span class="prop-detail">🛏 1 chambre</span>
                        <span class="prop-detail">🚿 partagée</span>
                        <span class="prop-detail">📐 18m²</span>
                    </div>
                    <div class="prop-actions">
                        <a href="/biens/3" class="prop-btn-primary">Voir l'annonce</a>
                        <button class="prop-btn-outline">💬</button>
                    </div>
                </div>
            </div>

            <div class="prop-card" data-type="apartment" data-city="marrakech" data-price="5500" data-student="false">
                <div class="prop-img img-d">
                    <div class="prop-badges">
                        <span class="prop-badge">Appartement</span>
                        <span class="prop-badge prop-badge-gold">⭐ Featured</span>
                    </div>
                    <button class="prop-favorite">🤍</button>
                </div>
                <div class="prop-body">
                    <div class="prop-price">5 500 MAD <span>/ mois</span></div>
                    <div class="prop-title">Appartement luxueux — Hivernage</div>
                    <div class="prop-loc">📍 Marrakech · 90m²</div>
                    <div class="prop-details">
                        <span class="prop-detail">🛏 3 chambres</span>
                        <span class="prop-detail">🚿 2 sdb</span>
                        <span class="prop-detail">📐 90m²</span>
                    </div>
                    <div class="prop-actions">
                        <a href="/biens/4" class="prop-btn-primary">Voir l'annonce</a>
                        <button class="prop-btn-outline">💬</button>
                    </div>
                </div>
            </div>

            <div class="prop-card" data-type="studio" data-city="fes" data-price="1800" data-student="true">
                <div class="prop-img img-e">
                    <div class="prop-badges">
                        <span class="prop-badge">Studio</span>
                        <span class="prop-badge prop-badge-student">🎓 Étudiant uniquement</span>
                    </div>
                    <button class="prop-favorite">🤍</button>
                    <div class="restricted-overlay">
                        <div class="restricted-icon">🎓</div>
                        <div class="restricted-text">Réservé aux étudiants inscrits</div>
                        <a href="/register" class="restricted-btn">S'inscrire comme étudiant</a>
                    </div>
                </div>
                <div class="prop-body">
                    <div class="prop-price">1 800 MAD <span>/ mois</span></div>
                    <div class="prop-title">Studio près de l'université</div>
                    <div class="prop-loc">📍 Fès · 28m²</div>
                    <div class="prop-details">
                        <span class="prop-detail">🛏 1 chambre</span>
                        <span class="prop-detail">🚿 1 sdb</span>
                        <span class="prop-detail">📐 28m²</span>
                    </div>
                    <div class="prop-actions">
                        <a href="/biens/5" class="prop-btn-primary">Voir l'annonce</a>
                        <button class="prop-btn-outline">💬</button>
                    </div>
                </div>
            </div>

            <div class="prop-card" data-type="house" data-city="agadir" data-price="7000" data-student="false">
                <div class="prop-img img-f">
                    <div class="prop-badges">
                        <span class="prop-badge">Villa</span>
                    </div>
                    <button class="prop-favorite">🤍</button>
                </div>
                <div class="prop-body">
                    <div class="prop-price">7 000 MAD <span>/ mois</span></div>
                    <div class="prop-title">Villa avec piscine — Agadir</div>
                    <div class="prop-loc">📍 Agadir · 180m²</div>
                    <div class="prop-details">
                        <span class="prop-detail">🛏 4 chambres</span>
                        <span class="prop-detail">🚿 3 sdb</span>
                        <span class="prop-detail">📐 180m²</span>
                    </div>
                    <div class="prop-actions">
                        <a href="/biens/6" class="prop-btn-primary">Voir l'annonce</a>
                        <button class="prop-btn-outline">💬</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let studentOnly = false;
    let userRole = "{{ auth()->check() ? auth()->user()->role : 'visitor' }}";

    // Appliquer la restriction aux locataires au chargement
    if (userRole === 'client') {
        document.querySelectorAll('.prop-card[data-student="true"]').forEach(card => {
            card.classList.add('restricted');
        });
    }

    function toggleStudent() {
        studentOnly = !studentOnly;
        document.getElementById('studentToggle').classList.toggle('active', studentOnly);
        applyFilters();
    }

    function applyFilters() {
        const search = document.getElementById('search').value.toLowerCase();
        const type = document.getElementById('type').value;
        const city = document.getElementById('city').value.toLowerCase();
        const priceMin = parseInt(document.getElementById('price-min').value) || 0;
        const priceMax = parseInt(document.getElementById('price-max').value) || 999999;

        const cards = document.querySelectorAll('.prop-card');
        let visible = 0;

        cards.forEach(card => {
            const cardType = card.dataset.type;
            const cardCity = card.dataset.city;
            const cardPrice = parseInt(card.dataset.price);
            const cardStudent = card.dataset.student === 'true';
            const cardTitle = card.querySelector('.prop-title').textContent.toLowerCase();

            const matchSearch = !search || cardTitle.includes(search) || cardCity.includes(search);
            const matchType = !type || cardType === type;
            const matchCity = !city || cardCity.includes(city);
            const matchPrice = cardPrice >= priceMin && cardPrice <= priceMax;
            const matchStudent = !studentOnly || cardStudent;

            const show = matchSearch && matchType && matchCity && matchPrice && matchStudent;
            card.style.display = show ? 'block' : 'none';
            if (show) visible++;
        });

        document.getElementById('count').textContent = visible + ' annonce(s) trouvée(s)';
    }

    function resetFilters() {
        document.getElementById('search').value = '';
        document.getElementById('type').value = '';
        document.getElementById('city').value = '';
        document.getElementById('price-min').value = '';
        document.getElementById('price-max').value = '';
        studentOnly = false;
        const toggle = document.getElementById('studentToggle');
        if (toggle) toggle.classList.remove('active');
        applyFilters();
    }

    document.querySelectorAll('.prop-favorite').forEach(btn => {
        btn.addEventListener('click', function() {
            this.textContent = this.textContent === '🤍' ? '❤️' : '🤍';
        });
    });

    applyFilters();
</script>
@endsection