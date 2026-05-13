@extends('layouts.maskan')

@section('title', 'MaskanTech — Guide complet pour louer au Maroc')

@section('styles')
.article-wrap { max-width: 1100px; margin: 0 auto; padding: 48px; }

/* LAYOUT */
.article-grid { display: grid; grid-template-columns: 1fr 320px; gap: 48px; }

/* ARTICLE */
.article-header { margin-bottom: 32px; }
.article-cat {
    display: inline-block; font-size: 11px; font-weight: 500;
    padding: 5px 14px; border-radius: 20px;
    background: #fdf6ee; color: #C8873A; margin-bottom: 16px;
}
.article-title {
    font-family: 'Playfair Display', serif;
    font-size: 36px; font-weight: 700; color: #1a1a1a;
    line-height: 1.2; margin-bottom: 16px;
}
.article-meta {
    display: flex; align-items: center; gap: 16px;
    font-size: 13px; color: #888; margin-bottom: 24px;
    flex-wrap: wrap;
}
.article-author-avatar {
    width: 36px; height: 36px; border-radius: 50%;
    background: linear-gradient(135deg, #C8873A, #E8A855);
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 700; color: #fff;
}
.article-cover {
    height: 420px; border-radius: 16px;
    background-size: cover; background-position: center;
    margin-bottom: 36px;
}

/* CONTENT */
.article-content { font-size: 15px; color: #444; line-height: 1.9; }
.article-content h2 {
    font-family: 'Playfair Display', serif;
    font-size: 24px; font-weight: 700; color: #1a1a1a;
    margin: 36px 0 16px;
}
.article-content h3 {
    font-size: 18px; font-weight: 600; color: #1a1a1a;
    margin: 24px 0 12px;
}
.article-content p { margin-bottom: 18px; }
.article-content ul { margin: 0 0 18px 24px; }
.article-content ul li { margin-bottom: 8px; }
.article-tip {
    background: #fdf6ee; border-left: 4px solid #C8873A;
    border-radius: 0 8px 8px 0; padding: 16px 20px;
    margin: 24px 0; font-size: 14px; color: #555;
}
.article-tip strong { color: #C8873A; }

/* SHARE */
.article-share {
    display: flex; align-items: center; gap: 12px;
    margin-top: 40px; padding-top: 24px;
    border-top: 1px solid #f0ede8;
}
.article-share-text { font-size: 14px; font-weight: 500; color: #1a1a1a; }
.share-btn {
    padding: 8px 16px; border-radius: 8px;
    font-size: 13px; font-weight: 500; cursor: pointer;
    border: 1.5px solid #e8e3db; background: transparent;
    font-family: 'DM Sans', sans-serif; transition: all 0.2s;
}
.share-btn:hover { border-color: #C8873A; color: #C8873A; }

/* SIDEBAR */
.article-sidebar { }
.sidebar-card {
    background: #fff; border: 1px solid #ede9e3;
    border-radius: 12px; padding: 20px; margin-bottom: 20px;
    position: sticky; top: 93px;
}
.sidebar-title {
    font-family: 'Playfair Display', serif;
    font-size: 16px; font-weight: 700; color: #1a1a1a;
    margin-bottom: 16px;
}
.sidebar-author { display: flex; align-items: center; gap: 12px; margin-bottom: 16px; }
.sidebar-author-avatar {
    width: 52px; height: 52px; border-radius: 50%;
    background: linear-gradient(135deg, #C8873A, #E8A855);
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; font-weight: 700; color: #fff;
}
.sidebar-author-name { font-size: 15px; font-weight: 500; color: #1a1a1a; }
.sidebar-author-role { font-size: 12px; color: #888; }
.sidebar-toc a {
    display: block; font-size: 13px; color: #555;
    text-decoration: none; padding: 7px 0;
    border-bottom: 1px solid #f8f7f4;
    transition: color 0.2s;
}
.sidebar-toc a:hover { color: #C8873A; }
.sidebar-toc a:last-child { border-bottom: none; }

/* RELATED */
.related-wrap { margin-top: 56px; }
.related-title {
    font-family: 'Playfair Display', serif;
    font-size: 24px; font-weight: 700; color: #1a1a1a;
    margin-bottom: 24px;
}
.related-grid { display: grid; grid-template-columns: repeat(3,1fr); gap: 20px; }
.related-card {
    border-radius: 12px; overflow: hidden;
    border: 1px solid #ede9e3; text-decoration: none;
    color: inherit; display: block; transition: transform 0.2s;
}
.related-card:hover { transform: translateY(-3px); }
.related-img { height: 150px; background-size: cover; background-position: center; }
.related-body { padding: 16px; }
.related-card-title { font-size: 14px; font-weight: 500; color: #1a1a1a; margin-bottom: 6px; }
.related-card-meta { font-size: 12px; color: #aaa; }
@endsection

@section('content')
<div class="article-wrap">

    {{-- BREADCRUMB --}}
    <div class="breadcrumb" style="margin-bottom:28px;">
        <a href="/">Accueil</a>
        <span style="color:#ccc;">›</span>
        <a href="/blog">Blog</a>
        <span style="color:#ccc;">›</span>
        <span style="color:#1a1a1a;font-weight:500;">Guide complet pour louer au Maroc</span>
    </div>

    <div class="article-grid">

        {{-- ARTICLE --}}
        <div>
            <div class="article-header">
                <span class="article-cat">💡 Conseils locataires</span>
                <div class="article-title">Guide complet pour louer un appartement au Maroc en 2026</div>
                <div class="article-meta">
                    <div class="article-author-avatar">HT</div>
                    <span><strong>Hajar Tanani</strong></span>
                    <span>·</span>
                    <span>12 Mai 2026</span>
                    <span>·</span>
                    <span>8 min de lecture</span>
                    <span>·</span>
                    <span>👁 1 234 vues</span>
                </div>
            </div>

            <div class="article-cover" style="background-image:url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=900&q=85')"></div>

            <div class="article-content">
                <p>Trouver un logement au Maroc peut sembler complexe, surtout si c'est votre première expérience. Entre les quartiers, les prix, les documents à fournir et les pièges à éviter, il y a beaucoup à savoir. Ce guide vous accompagne pas à pas.</p>

                <h2>1. Définir votre budget</h2>
                <p>Avant de commencer vos recherches, il est essentiel de définir un budget réaliste. En règle générale, le loyer ne devrait pas dépasser 30% de vos revenus mensuels.</p>
                <ul>
                    <li>Studio à Casablanca : 2 000 – 4 000 MAD/mois</li>
                    <li>Appartement F2 à Marrakech : 3 000 – 6 000 MAD/mois</li>
                    <li>Chambre en colocation : 800 – 1 500 MAD/mois</li>
                </ul>

                <div class="article-tip">
                    <strong>💡 Conseil MaskanTech :</strong> N'oubliez pas d'inclure les charges (eau, électricité, internet) dans votre budget total. Elles peuvent représenter 300 à 600 MAD supplémentaires par mois.
                </div>

                <h2>2. Choisir le bon quartier</h2>
                <p>Le choix du quartier est crucial. Il dépend de votre lieu de travail, de votre mode de vie et de votre budget. Voici quelques quartiers populaires :</p>

                <h3>À Casablanca</h3>
                <ul>
                    <li><strong>Maarif :</strong> Quartier moderne, bien desservi, idéal pour les jeunes actifs</li>
                    <li><strong>Ain Diab :</strong> Proche de la corniche, ambiance détendue</li>
                    <li><strong>Hay Hassani :</strong> Plus abordable, bien connecté en transport</li>
                </ul>

                <h3>À Marrakech</h3>
                <ul>
                    <li><strong>Guéliz :</strong> Centre-ville moderne, commerces et restaurants</li>
                    <li><strong>Hivernage :</strong> Quartier résidentiel haut de gamme</li>
                    <li><strong>Massira :</strong> Quartier familial, plus abordable</li>
                </ul>

                <h2>3. Les documents nécessaires</h2>
                <p>Pour louer un appartement au Maroc, vous aurez généralement besoin de :</p>
                <ul>
                    <li>Carte nationale d'identité (CIN) ou passeport</li>
                    <li>Justificatif de revenus (3 derniers bulletins de salaire)</li>
                    <li>Caution (généralement 1 à 3 mois de loyer)</li>
                    <li>Pour les étudiants : carte étudiante et attestation d'inscription</li>
                </ul>

                <div class="article-tip">
                    <strong>⚠️ Attention :</strong> Ne versez jamais de caution sans avoir visité le logement et signé un contrat officiel. Méfiez-vous des annonces avec des prix anormalement bas.
                </div>

                <h2>4. Signer le contrat de location</h2>
                <p>Le contrat de location est un document légal qui protège à la fois le locataire et le propriétaire. Vérifiez toujours ces points avant de signer :</p>
                <ul>
                    <li>Le montant du loyer et les modalités de paiement</li>
                    <li>La durée du bail et les conditions de renouvellement</li>
                    <li>Les charges incluses ou non dans le loyer</li>
                    <li>Les conditions de résiliation</li>
                    <li>L'état des lieux d'entrée</li>
                </ul>
            </div>

            {{-- SHARE --}}
            <div class="article-share">
                <span class="article-share-text">Partager :</span>
                <button class="share-btn">📘 Facebook</button>
                <button class="share-btn">🐦 Twitter</button>
                <button class="share-btn">💼 LinkedIn</button>
                <button class="share-btn">🔗 Copier le lien</button>
            </div>
        </div>

        {{-- SIDEBAR --}}
        <div class="article-sidebar">
            <div class="sidebar-card">
                <div class="sidebar-title">À propos de l'auteur</div>
                <div class="sidebar-author">
                    <div class="sidebar-author-avatar">HT</div>
                    <div>
                        <div class="sidebar-author-name">Hajar Tanani</div>
                        <div class="sidebar-author-role">Co-fondatrice MaskanTech</div>
                    </div>
                </div>
                <p style="font-size:13px;color:#888;line-height:1.7;">Passionnée par l'immobilier et la tech, Hajar partage ses conseils pour simplifier la recherche de logement au Maroc.</p>
            </div>

            <div class="sidebar-card">
                <div class="sidebar-title">Sommaire</div>
                <div class="sidebar-toc">
                    <a href="#">1. Définir votre budget</a>
                    <a href="#">2. Choisir le bon quartier</a>
                    <a href="#">3. Les documents nécessaires</a>
                    <a href="#">4. Signer le contrat</a>
                </div>
            </div>

            <div class="sidebar-card">
                <div class="sidebar-title">Trouvez votre logement</div>
                <p style="font-size:13px;color:#888;margin-bottom:16px;line-height:1.7;">Prêt à trouver votre appartement idéal au Maroc ?</p>
                <a href="/biens" class="mk-btn-gold" style="display:block;text-align:center;">Voir les annonces</a>
            </div>
        </div>

    </div>

    {{-- RELATED --}}
    <div class="related-wrap">
        <div class="related-title">Articles similaires</div>
        <div class="related-grid">
            <a href="/blog/logement-etudiant-marrakech" class="related-card">
                <div class="related-img" style="background-image:url('https://images.unsplash.com/photo-1554995207-c18c203602cb?w=400&q=80')"></div>
                <div class="related-body">
                    <div class="related-card-title">Top 5 quartiers étudiants à Marrakech</div>
                    <div class="related-card-meta">Salmane Elouzi · 10 Mai 2026</div>
                </div>
            </a>
            <a href="/blog/contrat-location" class="related-card">
                <div class="related-img" style="background-image:url('https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=400&q=80')"></div>
                <div class="related-body">
                    <div class="related-card-title">Comprendre son contrat de location</div>
                    <div class="related-card-meta">Salmane Elouzi · 5 Mai 2026</div>
                </div>
            </a>
            <a href="/blog/colocation-maroc" class="related-card">
                <div class="related-img" style="background-image:url('https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=400&q=80')"></div>
                <div class="related-body">
                    <div class="related-card-title">La colocation au Maroc : conseils pratiques</div>
                    <div class="related-card-meta">Salmane Elouzi · 1 Mai 2026</div>
                </div>
            </a>
        </div>
    </div>

</div>
@endsection