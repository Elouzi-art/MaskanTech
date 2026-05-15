@extends('layouts.maskan')

@section('title', 'MaskanTech — Blog')

@section('styles')
.blog-wrap { max-width: 1100px; margin: 0 auto; padding: 60px 48px; }

/* HEADER */
.blog-header { text-align: center; margin-bottom: 56px; }
.blog-header h1 {
    font-family: 'Playfair Display', serif;
    font-size: 42px; font-weight: 700; color: #1a1a1a; margin-bottom: 14px;
}
.blog-header p { font-size: 15px; color: #888; max-width: 480px; margin: 0 auto; line-height: 1.7; }

/* CATEGORIES */
.blog-cats {
    display: flex; gap: 8px; margin-bottom: 40px;
    flex-wrap: wrap;
}
.blog-cat {
    padding: 8px 20px; border-radius: 20px;
    font-size: 13px; font-weight: 500; cursor: pointer;
    border: 1.5px solid #e8e3db; color: #555;
    background: transparent; font-family: 'DM Sans', sans-serif;
    transition: all 0.2s;
}
.blog-cat:hover { border-color: #C8873A; color: #C8873A; }
.blog-cat.active { background: #C8873A; border-color: #C8873A; color: #fff; }

/* FEATURED */
.blog-featured {
    display: grid; grid-template-columns: 1.5fr 1fr;
    gap: 24px; margin-bottom: 48px;
}
.blog-card-big {
    border-radius: 16px; overflow: hidden;
    border: 1px solid #ede9e3; background: #fff;
    transition: transform 0.25s, box-shadow 0.25s;
    text-decoration: none; color: inherit;
    display: block;
}
.blog-card-big:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(0,0,0,0.1); }
.blog-card-img-big {
    height: 260px; background-size: cover; background-position: center;
    position: relative;
}
.blog-card-body { padding: 24px; }

/* GRID */
.blog-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 24px; }
.blog-card {
    border-radius: 12px; overflow: hidden;
    border: 1px solid #ede9e3; background: #fff;
    transition: transform 0.25s, box-shadow 0.25s;
    text-decoration: none; color: inherit;
    display: block;
}
.blog-card:hover { transform: translateY(-4px); box-shadow: 0 12px 30px rgba(0,0,0,0.08); }
.blog-card-img {
    height: 180px; background-size: cover; background-position: center;
}
.blog-card-body-sm { padding: 18px 20px; }

/* COMMON */
.blog-cat-tag {
    display: inline-block; font-size: 11px; font-weight: 500;
    padding: 4px 12px; border-radius: 20px;
    background: #fdf6ee; color: #C8873A;
    margin-bottom: 10px;
}
.blog-title-big {
    font-family: 'Playfair Display', serif;
    font-size: 22px; font-weight: 700; color: #1a1a1a;
    margin-bottom: 10px; line-height: 1.3;
}
.blog-title {
    font-family: 'Playfair Display', serif;
    font-size: 16px; font-weight: 700; color: #1a1a1a;
    margin-bottom: 8px; line-height: 1.4;
}
.blog-excerpt { font-size: 13px; color: #888; line-height: 1.7; margin-bottom: 16px; }
.blog-meta { display: flex; align-items: center; gap: 12px; font-size: 12px; color: #aaa; }
.blog-author-avatar {
    width: 28px; height: 28px; border-radius: 50%;
    background: linear-gradient(135deg, #C8873A, #E8A855);
    display: flex; align-items: center; justify-content: center;
    font-size: 10px; font-weight: 700; color: #fff;
}

/* NEWSLETTER */
.blog-newsletter {
    background: linear-gradient(135deg, #1a1a1a, #2d2010);
    border-radius: 16px; padding: 48px;
    text-align: center; margin-top: 56px;
}
.blog-newsletter h2 {
    font-family: 'Playfair Display', serif;
    font-size: 28px; color: #fff; margin-bottom: 10px;
}
.blog-newsletter h2 span { color: #E8A855; }
.blog-newsletter p { font-size: 14px; color: rgba(255,255,255,0.6); margin-bottom: 24px; }
.newsletter-form { display: flex; gap: 10px; max-width: 440px; margin: 0 auto; }
.newsletter-input {
    flex: 1; padding: 13px 16px;
    border: none; border-radius: 8px;
    font-size: 14px; font-family: 'DM Sans', sans-serif;
    outline: none;
}
.newsletter-btn {
    padding: 13px 24px; background: #C8873A; color: #fff;
    border: none; border-radius: 8px; font-size: 14px;
    font-weight: 500; cursor: pointer; font-family: 'DM Sans', sans-serif;
    transition: background 0.2s; white-space: nowrap;
}
.newsletter-btn:hover { background: #b07530; }

.img-blog-1 { background-image: url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800&q=80'); }
.img-blog-2 { background-image: url('https://images.unsplash.com/photo-1554995207-c18c203602cb?w=800&q=80'); }
.img-blog-3 { background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=600&q=80'); }
.img-blog-4 { background-image: url('https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=600&q=80'); }
.img-blog-5 { background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=600&q=80'); }
.img-blog-6 { background-image: url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=600&q=80'); }
@endsection

@section('content')
<div class="blog-wrap">

    {{-- HEADER --}}
    <div class="blog-header">
        <div class="mk-section-tag" style="display:block;">Blog & Conseils</div>
        <h1>Conseils <span style="color:#C8873A">immobiliers</span> au Maroc</h1>
        <p>Guides, conseils et actualités pour trouver votre logement idéal au Maroc.</p>
    </div>

    {{-- CATEGORIES --}}
    <div class="blog-cats">
        <button class="blog-cat active" onclick="filterCat(this, 'all')">Tous</button>
        <button class="blog-cat" onclick="filterCat(this, 'conseils')">💡 Conseils locataires</button>
        <button class="blog-cat" onclick="filterCat(this, 'proprietaires')">🏠 Propriétaires</button>
        <button class="blog-cat" onclick="filterCat(this, 'etudiants')">🎓 Étudiants</button>
        <button class="blog-cat" onclick="filterCat(this, 'marche')">📊 Marché immobilier</button>
        <button class="blog-cat" onclick="filterCat(this, 'juridique')">⚖️ Juridique</button>
    </div>

    {{-- FEATURED --}}
    <div class="blog-featured">
        <a href="/blog/guide-location-maroc" class="blog-card-big">
            <div class="blog-card-img-big img-blog-1"></div>
            <div class="blog-card-body">
                <span class="blog-cat-tag">💡 Conseils locataires</span>
                <div class="blog-title-big">Guide complet pour louer un appartement au Maroc en 2026</div>
                <div class="blog-excerpt">Tout ce que vous devez savoir avant de signer un contrat de location au Maroc : documents nécessaires, droits du locataire, pièges à éviter...</div>
                <div class="blog-meta">
                    <div class="blog-author-avatar">HT</div>
                    <span>Hajar Tanani</span>
                    <span>·</span>
                    <span>12 Mai 2026</span>
                    <span>·</span>
                    <span>8 min de lecture</span>
                </div>
            </div>
        </a>
        <div style="display:flex;flex-direction:column;gap:24px;">
            <a href="/blog/logement-etudiant-marrakech" class="blog-card-big">
                <div class="blog-card-img-big img-blog-2" style="height:160px;"></div>
                <div class="blog-card-body">
                    <span class="blog-cat-tag">🎓 Étudiants</span>
                    <div class="blog-title-big" style="font-size:16px;">Top 5 quartiers étudiants à Marrakech</div>
                    <div class="blog-meta">
                        <div class="blog-author-avatar">SE</div>
                        <span>Salmane Elouzi</span>
                        <span>·</span>
                        <span>10 Mai 2026</span>
                    </div>
                </div>
            </a>
            <a href="/blog/prix-immobilier-2026" class="blog-card-big">
                <div class="blog-card-img-big img-blog-3" style="height:160px;"></div>
                <div class="blog-card-body">
                    <span class="blog-cat-tag">📊 Marché immobilier</span>
                    <div class="blog-title-big" style="font-size:16px;">Prix de l'immobilier au Maroc en 2026</div>
                    <div class="blog-meta">
                        <div class="blog-author-avatar">HT</div>
                        <span>Hajar Tanani</span>
                        <span>·</span>
                        <span>8 Mai 2026</span>
                    </div>
                </div>
            </a>
        </div>
    </div>

    {{-- GRID --}}
    <div class="blog-grid">
        <a href="/blog/contrat-location" class="blog-card">
            <div class="blog-card-img img-blog-4"></div>
            <div class="blog-card-body-sm">
                <span class="blog-cat-tag">⚖️ Juridique</span>
                <div class="blog-title">Comprendre son contrat de location au Maroc</div>
                <div class="blog-excerpt">Les clauses importantes à vérifier avant de signer votre bail.</div>
                <div class="blog-meta">
                    <div class="blog-author-avatar">SE</div>
                    <span>Salmane Elouzi · 5 Mai 2026</span>
                </div>
            </div>
        </a>
        <a href="/blog/publier-annonce" class="blog-card">
            <div class="blog-card-img img-blog-5"></div>
            <div class="blog-card-body-sm">
                <span class="blog-cat-tag">🏠 Propriétaires</span>
                <div class="blog-title">Comment publier une annonce qui attire les locataires</div>
                <div class="blog-excerpt">Photos, description, prix : nos conseils pour une annonce efficace.</div>
                <div class="blog-meta">
                    <div class="blog-author-avatar">HT</div>
                    <span>Hajar Tanani · 3 Mai 2026</span>
                </div>
            </div>
        </a>
        <a href="/blog/colocation-maroc" class="blog-card">
            <div class="blog-card-img img-blog-6"></div>
            <div class="blog-card-body-sm">
                <span class="blog-cat-tag">🎓 Étudiants</span>
                <div class="blog-title">La colocation au Maroc : avantages et conseils pratiques</div>
                <div class="blog-excerpt">Tout savoir sur la colocation pour réduire vos charges et bien vivre ensemble.</div>
                <div class="blog-meta">
                    <div class="blog-author-avatar">SE</div>
                    <span>Salmane Elouzi · 1 Mai 2026</span>
                </div>
            </div>
        </a>
    </div>

    {{-- NEWSLETTER --}}
    <div class="blog-newsletter">
        <h2>Restez <span>informé</span> !</h2>
        <p>Recevez nos derniers conseils immobiliers directement dans votre boîte mail.</p>
        <div class="newsletter-form">
            <input type="email" class="newsletter-input" placeholder="votre@email.com">
            <button class="newsletter-btn">S'abonner</button>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    function filterCat(btn, cat) {
        document.querySelectorAll('.blog-cat').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
    }
</script>
@endsection