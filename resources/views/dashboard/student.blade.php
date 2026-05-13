@extends('dashboard.layout')

@section('title', 'MaskanTech — Dashboard Étudiant')

@section('dashboard-content')

{{-- HEADER --}}
<div class="dash-header">
    <div class="dash-title">Bonjour, {{ auth()->check() ? auth()->user()->name : 'Étudiant' }} 🎓</div>
    <div class="dash-subtitle">Voici un résumé de votre activité étudiante sur MaskanTech.</div>
</div>

{{-- BADGE ETUDIANT --}}
<div style="background: linear-gradient(135deg, #185FA5, #0d3d6e); border-radius: 12px; padding: 20px 24px; margin-bottom: 28px; display: flex; align-items: center; justify-content: space-between;">
    <div style="display:flex; align-items:center; gap:16px;">
        <div style="font-size:32px;">🎓</div>
        <div>
            <div style="font-size:15px; font-weight:600; color:#fff;">Compte Étudiant Vérifié</div>
            <div style="font-size:13px; color:rgba(255,255,255,0.6); margin-top:4px;">Vous avez accès aux annonces exclusives étudiants</div>
        </div>
    </div>
    <a href="/biens" style="background:rgba(255,255,255,0.15); color:#fff; padding:10px 20px; border-radius:8px; text-decoration:none; font-size:13px; font-weight:500;">
        Voir les annonces étudiants →
    </a>
</div>

{{-- STATS --}}
<div class="dash-stats">
    <div class="dash-stat-card">
        <div class="dash-stat-icon">❤️</div>
        <div class="dash-stat-value">8</div>
        <div class="dash-stat-label">Favoris</div>
        <div class="dash-stat-change">↑ 2 cette semaine</div>
    </div>
    <div class="dash-stat-card">
        <div class="dash-stat-icon">💬</div>
        <div class="dash-stat-value">3</div>
        <div class="dash-stat-label">Messages</div>
        <div class="dash-stat-change">2 non lus</div>
    </div>
    <div class="dash-stat-card">
        <div class="dash-stat-icon">📅</div>
        <div class="dash-stat-value">1</div>
        <div class="dash-stat-label">Rendez-vous</div>
        <div class="dash-stat-change">1 à venir</div>
    </div>
    <div class="dash-stat-card">
        <div class="dash-stat-icon">🎓</div>
        <div class="dash-stat-value">15</div>
        <div class="dash-stat-label">Annonces étudiants</div>
        <div class="dash-stat-change">disponibles près de vous</div>
    </div>
</div>

{{-- ANNONCES ETUDIANTS RECOMMANDEES --}}
<div class="dash-section">
    <div class="dash-section-header">
        <div class="dash-section-title">Annonces étudiants recommandées</div>
        <a href="/biens" class="dash-section-link">Voir toutes →</a>
    </div>
    <table class="dash-table">
        <thead>
            <tr>
                <th>Logement</th>
                <th>Ville</th>
                <th>Prix</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>🎓 Chambre en colocation</td>
                <td>Rabat</td>
                <td>1 200 MAD/mois</td>
                <td><span class="mk-badge mk-badge-blue">Étudiant</span></td>
                <td><a href="/biens/3" style="color:#C8873A;font-size:13px;">Voir →</a></td>
            </tr>
            <tr>
                <td>🎓 Studio près de l'université</td>
                <td>Fès</td>
                <td>1 800 MAD/mois</td>
                <td><span class="mk-badge mk-badge-blue">Étudiant</span></td>
                <td><a href="/biens/5" style="color:#C8873A;font-size:13px;">Voir →</a></td>
            </tr>
            <tr>
                <td>🏠 Studio meublé — Guéliz</td>
                <td>Marrakech</td>
                <td>2 500 MAD/mois</td>
                <td><span class="mk-badge mk-badge-gold">Général</span></td>
                <td><a href="/biens/1" style="color:#C8873A;font-size:13px;">Voir →</a></td>
            </tr>
        </tbody>
    </table>
</div>

{{-- FAVORIS --}}
<div class="dash-section">
    <div class="dash-section-header">
        <div class="dash-section-title">Mes favoris</div>
        <a href="#" class="dash-section-link">Voir tous →</a>
    </div>
    <table class="dash-table">
        <thead>
            <tr>
                <th>Logement</th>
                <th>Ville</th>
                <th>Prix</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>🏠 Chambre en colocation</td>
                <td>Rabat</td>
                <td>1 200 MAD/mois</td>
                <td><span class="mk-badge mk-badge-green">Disponible</span></td>
                <td><a href="/biens/3" style="color:#C8873A;font-size:13px;">Voir →</a></td>
            </tr>
        </tbody>
    </table>
</div>

{{-- MESSAGES --}}
<div class="dash-section">
    <div class="dash-section-header">
        <div class="dash-section-title">Messages récents</div>
        <a href="#" class="dash-section-link">Voir tous →</a>
    </div>
    <table class="dash-table">
        <thead>
            <tr>
                <th>Propriétaire</th>
                <th>Annonce</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>👤 Ahmed Karimi</td>
                <td>Studio Fès</td>
                <td style="color:#888;font-style:italic;">"Bonjour, la chambre est disponible..."</td>
                <td>Aujourd'hui</td>
            </tr>
        </tbody>
    </table>
</div>

@endsection