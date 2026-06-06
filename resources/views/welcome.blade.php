@extends('layouts.maskan')

@section('title', 'MaskanTech — Trouvez votre logement au Maroc')

@section('styles')
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
            text-transform: uppercase; padding: 6px 14px; border-radius: 20px;
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
        .search-bar {
            display: flex; align-items: center;
            background: #fff; border-radius: 10px;
            padding: 6px 6px 6px 20px; max-width: 620px;
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
            font-family: 'DM Sans', sans-serif; transition: background 0.2s;
        }
        .search-btn:hover { background: #b07530; }
        .dots {
            position: absolute; bottom: 30px; left: 80px; z-index: 20;
            display: flex; gap: 8px;
        }
        .dot {
            width: 28px; height: 3px; border-radius: 2px;
            background: rgba(255,255,255,0.3); cursor: pointer; transition: all 0.4s;
        }
        .dot.active { background: #E8A855; width: 50px; }

        /* STATS */
        .stats { display: grid; grid-template-columns: repeat(4,1fr); background: #1a1a1a; }
        .stat { padding: 30px 36px; border-right: 1px solid rgba(255,255,255,0.07); }
        .stat:last-child { border-right: none; }
        .stat-n { font-family: 'Playfair Display', serif; font-size: 34px; font-weight: 700; color: #E8A855; }
        .stat-l { font-size: 13px; color: rgba(255,255,255,0.45); margin-top: 5px; }

        /* CARDS */
        .cards { display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; }
        .card-img { height: 190px; background-size: cover; background-position: center; position: relative; }
        .card-badge {
            position: absolute; top: 12px; left: 12px;
            background: #fff; font-size: 11px; font-weight: 500;
            padding: 4px 10px; border-radius: 20px; color: #1a1a1a;
        }
        .card-student {
            position: absolute; top: 12px; right: 12px;
            background: #C8873A; color: #fff;
            font-size: 11px; font-weight: 500; padding: 4px 10px; border-radius: 20px;
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
@endsection

@section('content')

    {{-- HERO --}}
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

    {{-- STATS --}}
    <div class="stats">
        <div class="stat"><div class="stat-n">1 200+</div><div class="stat-l">Annonces disponibles</div></div>
        <div class="stat"><div class="stat-n">8 000+</div><div class="stat-l">Utilisateurs satisfaits</div></div>
        <div class="stat"><div class="stat-n">50+</div><div class="stat-l">Villes au Maroc</div></div>
        <div class="stat"><div class="stat-n">100%</div><div class="stat-l">Annonces vérifiées</div></div>
    </div>

    {{-- ANNONCES --}}
<div class="mk-section mk-section-alt">
    <div class="mk-section-tag">Annonces récentes</div>
    <div class="mk-section-h2">Logements disponibles maintenant</div>

    @if($recentProperties->count() > 0)
        <div class="cards">
            @foreach($recentProperties as $property)
    <div class="mk-card">
        <div class="card-img" style="background-image:url('{{ $property->image_url ?? 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=600&q=80' }}')">
            <span class="card-badge">{{ ucfirst($property->type) }}</span>
            @if(in_array($property->type, ['student', 'colocation']) || str_contains(strtolower($property->title ?? ''), 'étudiant') || str_contains(strtolower($property->title ?? ''), 'universi'))
                <span class="card-student">🎓 Étudiant</span>
            @endif
        </div>
        <div class="card-body">
            <div class="card-price">{{ number_format($property->price, 0, ',', ' ') }} MAD <span>/ mois</span></div>
            <div class="card-title">{{ $property->title }}</div>
            <div class="card-loc">📍 {{ $property->city }}@if($property->surface) · {{ $property->surface }}m²@endif</div>
            <a href="{{ route('properties.show', $property) }}" class="card-btn">Voir l'annonce</a>
        </div>
    </div>
@endforeach
        </div>
    @else
        {{-- Fallback si aucune annonce en base --}}
        <div style="text-align:center; padding:48px; color:#888;">
            <div style="font-size:48px; margin-bottom:16px;">🏠</div>
            <div style="font-size:16px; font-weight:500; margin-bottom:8px;">Aucune annonce disponible pour l'instant</div>
            <div style="font-size:14px;">Soyez le premier à publier une annonce !</div>
            <a href="{{ route('properties.create') }}" class="mk-btn-gold" style="display:inline-block; margin-top:20px;">Publier une annonce</a>
        </div>
    @endif
</div>
    {{-- FEATURES --}}
    <div class="mk-section">
        <div class="mk-section-tag">Pourquoi nous ?</div>
        <div class="mk-section-h2">Ce qui nous différencie</div>
        <div class="features">
            <div class="feat"><div class="feat-icon">✅</div><div class="feat-title">Annonces vérifiées</div><div class="feat-desc">Chaque annonce est validée manuellement avant publication</div></div>
            <div class="feat"><div class="feat-icon">🎓</div><div class="feat-title">Espace étudiant</div><div class="feat-desc">Filtrez uniquement les logements ouverts aux étudiants</div></div>
            <div class="feat"><div class="feat-icon">💬</div><div class="feat-title">Contact direct</div><div class="feat-desc">Messagerie sécurisée sans aucun intermédiaire</div></div>
            <div class="feat"><div class="feat-icon">🔒</div><div class="feat-title">Zéro commission</div><div class="feat-desc">Relation directe entre propriétaire et locataire</div></div>
        </div>
    </div>

    {{-- CTA --}}
    <div class="cta-banner">
        <div>
            <h2>Vous êtes <span>propriétaire</span> ?</h2>
            <p>Publiez votre annonce gratuitement et trouvez votre locataire rapidement.</p>
        </div>
        <div class="cta-btns">
            <a href="/register" class="mk-btn-gold">Publier une annonce</a>
            <a href="/biens" class="mk-btn-outline" style="border-color:rgba(255,255,255,0.3);color:#fff;">Explorer les biens</a>
        </div>
    </div>

@endsection

@section('scripts')
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
@endsection