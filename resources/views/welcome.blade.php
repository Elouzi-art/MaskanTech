{{-- resources/views/welcome.blade.php --}}
@extends('layouts.maskan')

@section('title', 'MaskanTech — Trouvez votre logement au Maroc')

@section('styles')
    /* ─── HERO SLIDER ─────────────────────────────────────────── */
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

    /* ─── STATS ─────────────────────────────────────────────── */
    .stats { display: grid; grid-template-columns: repeat(4,1fr); background: #1a1a1a; }
    .stat { padding: 30px 36px; border-right: 1px solid rgba(255,255,255,0.07); }
    .stat:last-child { border-right: none; }
    .stat-n { font-family: 'Playfair Display', serif; font-size: 34px; font-weight: 700; color: #E8A855; }
    .stat-l { font-size: 13px; color: rgba(255,255,255,0.45); margin-top: 5px; }

    /* ─── ANNONCES CARDS ────────────────────────────────────── */
    .cards { display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; }
    .card-img { height: 190px; position: relative; overflow: hidden; background: #f0ede8; }
    .card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease; }
    .mk-card:hover .card-img img { transform: scale(1.05); }
    .card-placeholder { width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:40px;color:#ccc; }
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
    .card-title { font-size: 15px; font-weight: 500; color: #1a1a1a; margin: 6px 0 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
    .card-loc { font-size: 13px; color: #999; }
    .card-btn {
        display: block; text-align: center; margin-top: 16px;
        padding: 10px; border: 1px solid #C8873A; color: #C8873A;
        border-radius: 7px; text-decoration: none; font-size: 13px; font-weight: 500;
        transition: all 0.2s;
    }
    .card-btn:hover { background: #C8873A; color: #fff; }

    /* ─── FEATURES ──────────────────────────────────────────── */
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

    /* ─── CTA BANNER ────────────────────────────────────────── */
    .cta-banner {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2010 100%);
        padding: 72px 80px;
        display: flex; align-items: center; justify-content: space-between;
    }
    .cta-banner h2 { font-family: 'Playfair Display', serif; font-size: 36px; color: #fff; font-weight: 700; }
    .cta-banner h2 span { color: #E8A855; }
    .cta-banner p { font-size: 15px; color: rgba(255,255,255,0.55); margin-top: 8px; }
    .cta-btns { display: flex; gap: 12px; flex-wrap: wrap; }

    /* ─── RESPONSIVE ─────────────────────────────────────────── */
    @media (max-width: 900px) {
        .hero-content { padding: 0 24px; }
        .hero h1 { font-size: 36px; }
        .search-bar { flex-direction: column; gap: 8px; padding: 12px; border-radius: 8px; }
        .search-bar select { border-left: none; border-top: 1px solid #eee; width: 100%; }
        .search-bar input { width: 100%; }
        .stats { grid-template-columns: repeat(2,1fr); }
        .cards { grid-template-columns: 1fr; }
        .features { grid-template-columns: repeat(2,1fr); }
        .cta-banner { flex-direction: column; gap: 28px; padding: 48px 24px; }
        .mk-section { padding: 48px 24px; }
        .dots { left: 24px; }
    }
@endsection

@section('content')

    {{-- ── HERO SLIDER ─────────────────────────────────────────── --}}
    <div class="hero">
        <div class="slide slide-1 active"></div>
        <div class="slide slide-2"></div>
        <div class="slide slide-3"></div>

        <div class="hero-content">
            <div class="hero-tag">🇲🇦 Plateforme immobilière marocaine</div>
            <h1>Trouvez votre<br><em>chez-vous</em><br>au Maroc</h1>
            <p class="hero-sub">Sans intermédiaire, sans commission. Des milliers d'annonces vérifiées partout au Maroc.</p>

            <form action="{{ route('properties.index') }}" method="GET" class="search-bar">
                <input type="text" name="search" placeholder="Ville, quartier, titre..." value="{{ request('search') }}"/>
                <select name="type">
                    <option value="">Tout type</option>
                    <option value="apartment">Appartement</option>
                    <option value="studio">Studio</option>
                    <option value="room">Chambre / Colocation</option>
                    <option value="villa">Villa</option>
                    <option value="office">Bureau</option>
                </select>
                <select name="max_price">
                    <option value="">Budget</option>
                    <option value="1500">moins de 1 500 MAD</option>
                    <option value="3000">1 500 – 3 000 MAD</option>
                    <option value="6000">3 000 – 6 000 MAD</option>
                    <option value="99999">+ 6 000 MAD</option>
                </select>
                <button type="submit" class="search-btn">Rechercher</button>
            </form>
        </div>

        <div class="dots">
            <div class="dot active" onclick="goSlide(0)"></div>
            <div class="dot" onclick="goSlide(1)"></div>
            <div class="dot" onclick="goSlide(2)"></div>
        </div>
    </div>

    {{-- ── STATS LIVE ───────────────────────────────────────────── --}}
    @php
        $totalAvailable = \App\Models\Property::where('status', 'available')->count();
        $totalUsers     = \App\Models\User::count();
        $totalCities    = \App\Models\Property::distinct('city')->count('city');
    @endphp
    <div class="stats">
        <div class="stat">
            <div class="stat-n">{{ $totalAvailable > 0 ? number_format($totalAvailable) . '+' : '1 200+' }}</div>
            <div class="stat-l">Annonces disponibles</div>
        </div>
        <div class="stat">
            <div class="stat-n">{{ $totalUsers > 0 ? number_format($totalUsers) . '+' : '8 000+' }}</div>
            <div class="stat-l">Utilisateurs satisfaits</div>
        </div>
        <div class="stat">
            <div class="stat-n">{{ $totalCities > 0 ? $totalCities . '+' : '50+' }}</div>
            <div class="stat-l">Villes au Maroc</div>
        </div>
        <div class="stat">
            <div class="stat-n">100%</div>
            <div class="stat-l">Annonces vérifiées</div>
        </div>
    </div>

    {{-- ── ANNONCES RÉCENTES ────────────────────────────────────── --}}
    @php
        $latestProperties = \App\Models\Property::with('images')
            ->where('status', 'available')
            ->latest()
            ->limit(3)
            ->get();
        $hasReal = $latestProperties->isNotEmpty();
    @endphp

    <div class="mk-section mk-section-alt">
        <div class="mk-section-tag">Annonces récentes</div>
        <div class="mk-section-h2">Logements disponibles maintenant</div>
        <div class="cards">
            @if($hasReal)
                @foreach($latestProperties as $property)
                <div class="mk-card">
                    <div class="card-img">
                        @if($property->images->isNotEmpty())
                            <img src="{{ Storage::url($property->images->first()->image_path) }}" alt="{{ $property->title }}">
                        @else
                            <div class="card-placeholder">🏠</div>
                        @endif
                        <span class="card-badge">{{ ucfirst($property->type ?? 'Bien') }}</span>
                        @if(in_array($property->target_audience ?? '', ['student', 'students', 'etudiant']))
                            <span class="card-student">🎓 Étudiant</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="card-price">{{ number_format($property->price, 0, ',', ' ') }} MAD <span>/ mois</span></div>
                        <div class="card-title">{{ $property->title }}</div>
                        <div class="card-loc">📍 {{ $property->city }}{{ $property->surface ? ' · ' . $property->surface . 'm²' : '' }}</div>
                        <a href="{{ route('properties.show', $property) }}" class="card-btn">Voir l'annonce</a>
                    </div>
                </div>
                @endforeach
            @else
                {{-- Cartes exemples si aucun bien disponible --}}
                @foreach([
                    ['img'=>'photo-1502672260266-1c1ef2d93688','badge'=>'Studio','student'=>true,'price'=>'2 500','title'=>'Studio meublé — Guéliz','loc'=>'Marrakech · 35m²'],
                    ['img'=>'photo-1522708323590-d24dbb6b0267','badge'=>'Appartement','student'=>false,'price'=>'4 200','title'=>'Appartement F2 moderne','loc'=>'Casablanca · 65m²'],
                    ['img'=>'photo-1493809842364-78817add7ffb','badge'=>'Colocation','student'=>true,'price'=>'1 200','title'=>'Chambre en colocation','loc'=>'Rabat · 18m²'],
                ] as $ex)
                <div class="mk-card">
                    <div class="card-img" style="background-image:url('https://images.unsplash.com/{{ $ex['img'] }}?w=600&q=80');background-size:cover;background-position:center">
                        <span class="card-badge">{{ $ex['badge'] }}</span>
                        @if($ex['student'])<span class="card-student">🎓 Étudiant</span>@endif
                    </div>
                    <div class="card-body">
                        <div class="card-price">{{ $ex['price'] }} MAD <span>/ mois</span></div>
                        <div class="card-title">{{ $ex['title'] }}</div>
                        <div class="card-loc">📍 {{ $ex['loc'] }}</div>
                        <a href="{{ route('properties.index') }}" class="card-btn">Voir les annonces</a>
                    </div>
                </div>
                @endforeach
            @endif
        </div>

        <div style="text-align:center;margin-top:40px;">
            <a href="{{ route('properties.index') }}" class="mk-btn-outline">Voir toutes les annonces</a>
        </div>
    </div>

    {{-- ── FEATURES ─────────────────────────────────────────────── --}}
    <div class="mk-section">
        <div class="mk-section-tag">Pourquoi nous ?</div>
        <div class="mk-section-h2">Ce qui nous différencie</div>
        <div class="features">
            <div class="feat">
                <div class="feat-icon">✅</div>
                <div class="feat-title">Annonces vérifiées</div>
                <div class="feat-desc">Chaque annonce est validée manuellement avant publication.</div>
            </div>
            <div class="feat">
                <div class="feat-icon">🎓</div>
                <div class="feat-title">Espace étudiant</div>
                <div class="feat-desc">Filtrez uniquement les logements ouverts aux étudiants.</div>
            </div>
            <div class="feat">
                <div class="feat-icon">💬</div>
                <div class="feat-title">Contact direct</div>
                <div class="feat-desc">Messagerie sécurisée sans aucun intermédiaire.</div>
            </div>
            <div class="feat">
                <div class="feat-icon">🔒</div>
                <div class="feat-title">Zéro commission</div>
                <div class="feat-desc">Relation directe entre propriétaire et locataire.</div>
            </div>
        </div>
    </div>

    {{-- ── CTA BANNER ───────────────────────────────────────────── --}}
    <div class="cta-banner">
        <div>
            <h2>Vous êtes <span>propriétaire</span> ?</h2>
            <p>Publiez votre annonce gratuitement et trouvez votre locataire rapidement.</p>
        </div>
        <div class="cta-btns">
            @auth
                @if(in_array(auth()->user()->role, ['owner', 'agent', 'admin']))
                    <a href="{{ route('properties.create') }}" class="mk-btn-gold">Publier une annonce</a>
                @endif
                <a href="{{ route('dashboard') }}" class="mk-btn-outline" style="border-color:rgba(255,255,255,0.3);color:#fff;">Mon dashboard</a>
            @else
                <a href="{{ route('register') }}" class="mk-btn-gold">Publier une annonce</a>
                <a href="{{ route('properties.index') }}" class="mk-btn-outline" style="border-color:rgba(255,255,255,0.3);color:#fff;">Explorer les biens</a>
            @endauth
        </div>
    </div>

@endsection

@section('scripts')
<script>
    let cur = 0;
    const slides = document.querySelectorAll('.slide');
    const dots   = document.querySelectorAll('.dot');
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
