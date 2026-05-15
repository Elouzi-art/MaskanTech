@extends('layouts.maskan')

@section('title', 'À propos — MaskanTech')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap');

    :root {
        --sand:      #F5EFE0;
        --sand-dark: #E8DCC8;
        --terra:     #C4622D;
        --terra-dk:  #9E4A1F;
        --ink:       #1C1A17;
        --ink-soft:  #4A4540;
        --cream:     #FDFAF4;
        --gold:      #B8924A;
        --gold-lt:   #D4B06A;
        --border:    rgba(180,150,100,0.25);
    }

    .about-root {
        font-family: 'DM Sans', sans-serif;
        background: var(--cream);
        color: var(--ink);
        overflow-x: hidden;
    }

    /* ─── HERO ─────────────────────────────────────────── */
    .about-hero {
        position: relative;
        min-height: 82vh;
        display: grid;
        grid-template-columns: 1fr 1fr;
        align-items: center;
        overflow: hidden;
    }

    .hero-left {
        padding: 7rem 4rem 7rem 6rem;
        position: relative;
        z-index: 2;
    }

    .hero-eyebrow {
        font-family: 'DM Sans', sans-serif;
        font-weight: 300;
        font-size: 0.75rem;
        letter-spacing: 0.25em;
        text-transform: uppercase;
        color: var(--terra);
        margin-bottom: 1.5rem;
    }

    .hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(3.2rem, 5vw, 5.5rem);
        font-weight: 300;
        line-height: 1.05;
        color: var(--ink);
        margin: 0 0 1.5rem;
    }

    .hero-title em {
        font-style: italic;
        color: var(--terra);
    }

    .hero-sub {
        font-size: 1.05rem;
        font-weight: 300;
        color: var(--ink-soft);
        line-height: 1.75;
        max-width: 44ch;
        margin-bottom: 2.5rem;
    }

    .hero-cta {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.8rem 1.75rem;
        background: var(--terra);
        color: #fff;
        border-radius: 2px;
        font-size: 0.85rem;
        font-weight: 500;
        letter-spacing: 0.05em;
        text-decoration: none;
        transition: background 0.2s;
    }

    .hero-cta:hover { background: var(--terra-dk); }

    .hero-right {
        position: relative;
        height: 100%;
        min-height: 82vh;
        overflow: hidden;
    }

    .hero-pattern {
        position: absolute;
        inset: 0;
        background:
            repeating-linear-gradient(
                45deg,
                transparent,
                transparent 18px,
                rgba(196,98,45,0.06) 18px,
                rgba(196,98,45,0.06) 19px
            ),
            repeating-linear-gradient(
                -45deg,
                transparent,
                transparent 18px,
                rgba(196,98,45,0.06) 18px,
                rgba(196,98,45,0.06) 19px
            );
        background-color: var(--sand);
    }

    .hero-pattern::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at 60% 50%, rgba(196,98,45,0.12) 0%, transparent 70%);
    }

    .hero-motif {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 340px;
        height: 340px;
        opacity: 0.18;
    }

    .hero-img-badge {
        position: absolute;
        bottom: 3rem;
        left: 3rem;
        background: var(--ink);
        color: var(--gold-lt);
        padding: 1.25rem 1.75rem;
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.1rem;
        font-style: italic;
        font-weight: 300;
        line-height: 1.5;
        max-width: 240px;
        border-left: 2px solid var(--terra);
    }

    /* ─── STATS BAR ─────────────────────────────────────── */
    .stats-bar {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        background: var(--sand);
    }

    .stat-cell {
        padding: 2.5rem 2rem;
        text-align: center;
        border-right: 1px solid var(--border);
    }

    .stat-cell:last-child { border-right: none; }

    .stat-number {
        font-family: 'Cormorant Garamond', serif;
        font-size: 3rem;
        font-weight: 300;
        color: var(--terra);
        line-height: 1;
        display: block;
        margin-bottom: 0.4rem;
    }

    .stat-label {
        font-size: 0.78rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--ink-soft);
        font-weight: 400;
    }

    /* ─── MISSION ───────────────────────────────────────── */
    .section {
        padding: 6rem 6rem;
    }

    .section-eyebrow {
        font-size: 0.72rem;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: var(--terra);
        font-weight: 400;
        margin-bottom: 1rem;
    }

    .section-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(2rem, 3.5vw, 3rem);
        font-weight: 300;
        line-height: 1.2;
        color: var(--ink);
        margin: 0 0 1.5rem;
    }

    .mission-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 6rem;
        align-items: center;
    }

    .mission-text p {
        font-size: 1rem;
        font-weight: 300;
        color: var(--ink-soft);
        line-height: 1.85;
        margin-bottom: 1.25rem;
    }

    .mission-text p strong {
        color: var(--ink);
        font-weight: 500;
    }

    .mission-visual {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1px;
        background: var(--border);
        border: 1px solid var(--border);
    }

    .mission-card {
        background: var(--cream);
        padding: 2rem;
    }

    .mission-card-icon {
        width: 36px;
        height: 36px;
        margin-bottom: 1rem;
        color: var(--terra);
    }

    .mission-card h4 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.2rem;
        font-weight: 400;
        color: var(--ink);
        margin: 0 0 0.5rem;
    }

    .mission-card p {
        font-size: 0.88rem;
        font-weight: 300;
        color: var(--ink-soft);
        line-height: 1.65;
        margin: 0;
    }

    /* ─── VALUES ────────────────────────────────────────── */
    .values-section {
        background: var(--ink);
        padding: 6rem;
        color: var(--cream);
    }

    .values-section .section-eyebrow { color: var(--gold-lt); }
    .values-section .section-title { color: var(--cream); }

    .values-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 3px;
        background: rgba(255,255,255,0.06);
        margin-top: 3rem;
    }

    .value-card {
        background: var(--ink);
        padding: 2.5rem 2rem;
        position: relative;
        overflow: hidden;
        transition: background 0.3s;
    }

    .value-card:hover { background: rgba(255,255,255,0.04); }

    .value-number {
        font-family: 'Cormorant Garamond', serif;
        font-size: 4rem;
        font-weight: 300;
        color: rgba(196,98,45,0.2);
        position: absolute;
        top: 1rem;
        right: 1.5rem;
        line-height: 1;
        pointer-events: none;
    }

    .value-icon {
        width: 28px;
        height: 28px;
        color: var(--gold-lt);
        margin-bottom: 1.25rem;
    }

    .value-card h3 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.35rem;
        font-weight: 400;
        color: var(--cream);
        margin: 0 0 0.75rem;
    }

    .value-card p {
        font-size: 0.88rem;
        font-weight: 300;
        color: rgba(253,250,244,0.65);
        line-height: 1.7;
        margin: 0;
    }

    /* ─── TEAM ──────────────────────────────────────────── */
    .team-section {
        padding: 6rem;
        background: var(--sand);
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
        margin-top: 3rem;
    }

    .team-card {
        background: var(--cream);
        border: 1px solid var(--border);
        overflow: hidden;
        transition: transform 0.25s, box-shadow 0.25s;
    }

    .team-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(28,26,23,0.1);
    }

    .team-avatar {
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Cormorant Garamond', serif;
        font-size: 4rem;
        font-weight: 300;
        color: var(--cream);
        position: relative;
        overflow: hidden;
    }

    .team-avatar::after {
        content: '';
        position: absolute;
        inset: 0;
        background:
            repeating-linear-gradient(
                45deg,
                transparent,
                transparent 8px,
                rgba(255,255,255,0.07) 8px,
                rgba(255,255,255,0.07) 9px
            );
    }

    .ta-1 { background: #C4622D; }
    .ta-2 { background: #1C5E8A; }

    .team-info { padding: 1.25rem; }

    .team-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.15rem;
        font-weight: 400;
        color: var(--ink);
        margin: 0 0 0.2rem;
    }

    .team-role {
        font-size: 0.78rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--terra);
        font-weight: 400;
        margin: 0 0 0.75rem;
    }

    .team-bio {
        font-size: 0.85rem;
        font-weight: 300;
        color: var(--ink-soft);
        line-height: 1.65;
        margin: 0;
    }

    /* ─── HISTOIRE ──────────────────────────────────────── */
    .histoire-section { padding: 6rem; }

    .timeline {
        margin-top: 3rem;
        position: relative;
        padding-left: 2rem;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0.5rem;
        bottom: 0.5rem;
        width: 1px;
        background: var(--border);
    }

    .tl-item {
        position: relative;
        padding: 0 0 3rem 2.5rem;
    }

    .tl-item:last-child { padding-bottom: 0; }

    .tl-dot {
        position: absolute;
        left: -2.08rem;
        top: 0.35rem;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: var(--terra);
        border: 2px solid var(--cream);
        box-shadow: 0 0 0 2px var(--border);
    }

    .tl-year {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1rem;
        font-weight: 600;
        color: var(--terra);
        margin-bottom: 0.35rem;
    }

    .tl-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.3rem;
        font-weight: 400;
        color: var(--ink);
        margin: 0 0 0.5rem;
    }

    .tl-desc {
        font-size: 0.9rem;
        font-weight: 300;
        color: var(--ink-soft);
        line-height: 1.7;
        margin: 0;
        max-width: 55ch;
    }

    /* ─── CTA FINAL ─────────────────────────────────────── */
    .cta-section {
        background: var(--terra);
        padding: 5rem 6rem;
        display: grid;
        grid-template-columns: 1fr auto;
        align-items: center;
        gap: 3rem;
    }

    .cta-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(1.8rem, 3vw, 2.75rem);
        font-weight: 300;
        color: #fff;
        margin: 0 0 0.5rem;
    }

    .cta-sub {
        font-size: 0.95rem;
        font-weight: 300;
        color: rgba(255,255,255,0.75);
        margin: 0;
    }

    .cta-actions {
        display: flex;
        gap: 1rem;
        flex-shrink: 0;
    }

    .btn-light {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.85rem 1.75rem;
        background: #fff;
        color: var(--terra);
        border-radius: 2px;
        font-size: 0.85rem;
        font-weight: 500;
        letter-spacing: 0.04em;
        text-decoration: none;
        transition: opacity 0.2s;
    }

    .btn-light:hover { opacity: 0.9; }

    .btn-outline-w {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.85rem 1.75rem;
        background: transparent;
        color: #fff;
        border: 1px solid rgba(255,255,255,0.5);
        border-radius: 2px;
        font-size: 0.85rem;
        font-weight: 500;
        letter-spacing: 0.04em;
        text-decoration: none;
        transition: border-color 0.2s, background 0.2s;
    }

    .btn-outline-w:hover {
        border-color: #fff;
        background: rgba(255,255,255,0.08);
    }

    /* ─── RESPONSIVE ─────────────────────────────────────── */
    @media (max-width: 960px) {
        .about-hero { grid-template-columns: 1fr; min-height: auto; }
        .hero-right { min-height: 320px; }
        .hero-left { padding: 4rem 2rem; }
        .stats-bar { grid-template-columns: repeat(2, 1fr); }
        .section { padding: 4rem 2rem; }
        .mission-grid { grid-template-columns: 1fr; gap: 3rem; }
        .values-section { padding: 4rem 2rem; }
        .values-grid { grid-template-columns: 1fr; }
        .team-section { padding: 4rem 2rem; }
        .team-grid { grid-template-columns: repeat(2, 1fr); }
        .histoire-section { padding: 4rem 2rem; }
        .cta-section { grid-template-columns: 1fr; padding: 4rem 2rem; }
        .cta-actions { flex-wrap: wrap; }
    }

    @media (max-width: 600px) {
        .team-grid { grid-template-columns: 1fr; }
        .stats-bar { grid-template-columns: 1fr 1fr; }
        .mission-visual { grid-template-columns: 1fr; }
    }
</style>

<div class="about-root">

    {{-- ── HERO ────────────────────────────────────────── --}}
    <section class="about-hero">
        <div class="hero-left">
            <p class="hero-eyebrow">Notre histoire &amp; mission</p>
            <h1 class="hero-title">
                Trouver<br>
                son chez-soi<br>
                au <em>Maroc</em>
            </h1>
            <p class="hero-sub">
                MaskanTech est né d'un constat simple : le marché immobilier marocain méritait une plateforme honnête, transparente et vraiment utile — sans commission cachée, sans intermédiaire inutile.
            </p>
            <a href="{{ route('contact') }}" class="hero-cta">
                Contactez-nous
                <svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
        </div>
        <div class="hero-right">
            <div class="hero-pattern"></div>
            <svg class="hero-motif" viewBox="0 0 340 340" aria-hidden="true">
                <defs>
                    <pattern id="zellige" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                        <path d="M30 0 L60 30 L30 60 L0 30 Z" fill="none" stroke="#C4622D" stroke-width="1"/>
                        <path d="M30 10 L50 30 L30 50 L10 30 Z" fill="none" stroke="#C4622D" stroke-width="0.5"/>
                        <path d="M30 0 L30 10 M60 30 L50 30 M30 60 L30 50 M0 30 L10 30" stroke="#C4622D" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="340" height="340" fill="url(#zellige)"/>
            </svg>
            <div class="hero-img-badge">
                « L'immobilier marocain, enfin accessible à tous. »
            </div>
        </div>
    </section>

    {{-- ── STATS ───────────────────────────────────────── --}}
    <div class="stats-bar">
        <div class="stat-cell">
            <span class="stat-number">1 200+</span>
            <span class="stat-label">Annonces disponibles</span>
        </div>
        <div class="stat-cell">
            <span class="stat-number">50+</span>
            <span class="stat-label">Villes couvertes</span>
        </div>
        <div class="stat-cell">
            <span class="stat-number">0 DH</span>
            <span class="stat-label">Commission prélevée</span>
        </div>
        <div class="stat-cell">
            <span class="stat-number">8 000+</span>
            <span class="stat-label">Utilisateurs satisfaits</span>
        </div>
    </div>

    {{-- ── MISSION ──────────────────────────────────────── --}}
    <section class="section">
        <div class="mission-grid">
            <div class="mission-text">
                <p class="section-eyebrow">Notre mission</p>
                <h2 class="section-title">Simplifier la recherche de logement au Maroc</h2>
                <p>Nous croyons que trouver un logement devrait être une expérience simple, <strong>transparente et humaine</strong>. Trop longtemps, ce marché a été opaque, fragmenté et dominé par des intermédiaires qui ajoutaient du coût sans créer de valeur réelle.</p>
                <p>MaskanTech connecte directement propriétaires et locataires — étudiants, familles, professionnels — avec des outils modernes : messagerie intégrée, rendez-vous en ligne, annonces vérifiées.</p>
                <p>Notre promesse : <strong>zéro commission, zéro surprise</strong>. Juste un service fait par des Marocains, pour les Marocains. 🇲🇦</p>
            </div>
            <div class="mission-visual">
                <div class="mission-card">
                    <svg class="mission-card-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                        <path d="M9 22V12h6v10" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                    </svg>
                    <h4>Annonces vérifiées</h4>
                    <p>Chaque bien est contrôlé avant publication. Finis les faux listings.</p>
                </div>
                <div class="mission-card" style="background: var(--sand);">
                    <svg class="mission-card-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="1.5"/>
                        <path d="M12 7v5l3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    <h4>Mise en relation rapide</h4>
                    <p>Messagerie et rendez-vous en ligne directement sur la plateforme.</p>
                </div>
                <div class="mission-card" style="background: var(--sand);">
                    <svg class="mission-card-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 22s-8-5-8-11a8 8 0 1116 0c0 6-8 11-8 11z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                        <circle cx="12" cy="11" r="2.5" stroke="currentColor" stroke-width="1.5"/>
                    </svg>
                    <h4>Partout au Maroc</h4>
                    <p>Casablanca, Rabat, Marrakech, Fès, Tanger, Agadir et plus encore.</p>
                </div>
                <div class="mission-card">
                    <svg class="mission-card-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                    </svg>
                    <h4>Zéro commission</h4>
                    <p>Propriétaires et locataires se connectent sans frais d'agence.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ── VALUES ───────────────────────────────────────── --}}
    <section class="values-section">
        <p class="section-eyebrow">Nos valeurs</p>
        <h2 class="section-title" style="max-width: 30ch;">Ce en quoi nous croyons profondément</h2>
        <div class="values-grid">
            <div class="value-card">
                <span class="value-number" aria-hidden="true">01</span>
                <svg class="value-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12z" stroke="currentColor" stroke-width="1.5"/>
                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.5"/>
                </svg>
                <h3>Transparence totale</h3>
                <p>Tous les prix, conditions et informations sont visibles dès le départ. Aucun frais caché, aucune surprise.</p>
            </div>
            <div class="value-card">
                <span class="value-number" aria-hidden="true">02</span>
                <svg class="value-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2M9 11a4 4 0 100-8 4 4 0 000 8zM23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                <h3>Communauté d'abord</h3>
                <p>Nous construisons pour les Marocains, avec leurs réalités en tête — étudiants, familles, travailleurs mobiles.</p>
            </div>
            <div class="value-card">
                <span class="value-number" aria-hidden="true">03</span>
                <svg class="value-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <h3>Innovation responsable</h3>
                <p>La technologie au service des personnes — des outils utiles, pas de la complexité inutile.</p>
            </div>
            <div class="value-card">
                <span class="value-number" aria-hidden="true">04</span>
                <svg class="value-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M12 22C6.48 22 2 17.52 2 12S6.48 2 12 2s10 4.48 10 10-4.48 10-10 10z" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M12 6v6l4 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                <h3>Réactivité</h3>
                <p>Le marché du logement ne dort jamais. Notre équipe support est disponible 7j/7 pour vous accompagner.</p>
            </div>
            <div class="value-card">
                <span class="value-number" aria-hidden="true">05</span>
                <svg class="value-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M9 12l2 2 4-4M22 12c0 5.52-4.48 10-10 10S2 17.52 2 12 6.48 2 12 2s10 4.48 10 10z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                <h3>Confiance &amp; sécurité</h3>
                <p>Annonces vérifiées, avis authentiques, et signalement facilité pour protéger notre communauté.</p>
            </div>
            <div class="value-card">
                <span class="value-number" aria-hidden="true">06</span>
                <svg class="value-icon" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" stroke="currentColor" stroke-width="1.5"/>
                    <circle cx="12" cy="10" r="3" stroke="currentColor" stroke-width="1.5"/>
                </svg>
                <h3>Ancrage local</h3>
                <p>Une équipe marocaine, une compréhension profonde du marché local, des quartiers, des spécificités régionales.</p>
            </div>
        </div>
    </section>

    {{-- ── TEAM ─────────────────────────────────────────── --}}
    <section class="team-section">
        <p class="section-eyebrow">L'équipe</p>
        <h2 class="section-title">Les visages derrière MaskanTech</h2>
        <div class="team-grid" style="grid-template-columns: repeat(2,1fr); max-width: 700px; margin-top: 3rem;">
            <div class="team-card">
                <div class="team-avatar ta-1">HT</div>
                <div class="team-info">
                    <h3 class="team-name">Hajar Tanani</h3>
                    <p class="team-role">Co-fondatrice &amp; Frontend</p>
                    <p class="team-bio">Passionnée par le design et l'expérience utilisateur, Hajar s'occupe de l'interface et de l'expérience utilisateur de MaskanTech.</p>
                </div>
            </div>
            <div class="team-card">
                <div class="team-avatar ta-2">SE</div>
                <div class="team-info">
                    <h3 class="team-name">Salmane Elouzi</h3>
                    <p class="team-role">Co-fondateur &amp; Backend</p>
                    <p class="team-bio">Passionné par les systèmes et les bases de données, Salmane s'occupe de la logique métier et de l'architecture backend de MaskanTech.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ── HISTOIRE ─────────────────────────────────────── --}}
    <section class="histoire-section">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6rem; align-items: start;">
            <div>
                <p class="section-eyebrow">Notre histoire</p>
                <h2 class="section-title">Une aventure née à Marrakech</h2>
                <p style="font-size:0.95rem; font-weight:300; color:var(--ink-soft); line-height:1.8; margin:0;">
                    MaskanTech est né en 2026 d'une frustration partagée : trouver un logement correct au Maroc relevait du parcours du combattant. Des annonces mensongères, des agences opaques, des frais astronomiques. Deux étudiants marocains ont décidé de changer ça.
                </p>
            </div>
            <div class="timeline">
                <div class="tl-item">
                    <div class="tl-dot"></div>
                    <p class="tl-year">Janvier 2026</p>
                    <h3 class="tl-title">L'idée est née</h3>
                    <p class="tl-desc">Hajar et Salmane, deux étudiants marocains, décident de créer la solution qu'ils auraient aimé avoir pour trouver leur logement.</p>
                </div>
                <div class="tl-item">
                    <div class="tl-dot"></div>
                    <p class="tl-year">Mars 2026</p>
                    <h3 class="tl-title">Début du développement</h3>
                    <p class="tl-desc">Le développement de MaskanTech commence avec Laravel. Hajar prend en charge le frontend, Salmane le backend.</p>
                </div>
                <div class="tl-item">
                    <div class="tl-dot"></div>
                    <p class="tl-year">Mai 2026</p>
                    <h3 class="tl-title">Lancement de la plateforme</h3>
                    <p class="tl-desc">MaskanTech est en ligne avec des milliers d'annonces vérifiées partout au Maroc, sans commission, sans intermédiaire.</p>
                </div>
                <div class="tl-item">
                    <div class="tl-dot"></div>
                    <p class="tl-year">Futur →</p>
                    <h3 class="tl-title">La référence du logement au Maroc</h3>
                    <p class="tl-desc">Application mobile, intelligence artificielle, expansion dans toute l'Afrique du Nord... L'aventure ne fait que commencer !</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ── CTA FINAL ────────────────────────────────────── --}}
    <section class="cta-section">
        <div>
            <h2 class="cta-title">Prêt à trouver votre logement idéal ?</h2>
            <p class="cta-sub">Des milliers d'annonces vérifiées vous attendent, sans commission.</p>
        </div>
        <div class="cta-actions">
            <a href="{{ route('register') }}" class="btn-light">
                Créer un compte
                <svg width="14" height="14" viewBox="0 0 16 16" fill="none" aria-hidden="true">
                    <path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a>
            <a href="/biens" class="btn-outline-w">Voir les logements</a>
        </div>
    </section>

</div>

@endsection