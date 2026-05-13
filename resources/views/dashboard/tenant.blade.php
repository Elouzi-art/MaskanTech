@extends('dashboard.layout')

@section('title', 'MaskanTech — Mon Dashboard')

@section('dashboard-content')

{{-- HEADER --}}
<div class="dash-header">
    <div class="dash-title">Bonjour, {{ auth()->check() ? auth()->user()->name : 'Utilisateur' }} 👋</div>
    <div class="dash-subtitle">Voici un résumé de votre activité sur MaskanTech.</div>
</div>

{{-- STATS --}}
<div class="dash-stats">
    <div class="dash-stat-card">
        <div class="dash-stat-icon">❤️</div>
        <div class="dash-stat-value">12</div>
        <div class="dash-stat-label">Favoris</div>
        <div class="dash-stat-change">↑ 3 cette semaine</div>
    </div>
    <div class="dash-stat-card">
        <div class="dash-stat-icon">💬</div>
        <div class="dash-stat-value">5</div>
        <div class="dash-stat-label">Messages</div>
        <div class="dash-stat-change">3 non lus</div>
    </div>
    <div class="dash-stat-card">
        <div class="dash-stat-icon">📅</div>
        <div class="dash-stat-value">2</div>
        <div class="dash-stat-label">Rendez-vous</div>
        <div class="dash-stat-change">1 à venir</div>
    </div>
    <div class="dash-stat-card">
        <div class="dash-stat-icon">🔍</div>
        <div class="dash-stat-value">48</div>
        <div class="dash-stat-label">Annonces vues</div>
        <div class="dash-stat-change">↑ 8 aujourd'hui</div>
    </div>
</div>

{{-- FAVORIS RECENTS --}}
<div class="dash-section">
    <div class="dash-section-header">
        <div class="dash-section-title">Mes favoris récents</div>
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
                <td>🏠 Studio meublé — Guéliz</td>
                <td>Marrakech</td>
                <td>2 500 MAD/mois</td>
                <td><span class="mk-badge mk-badge-green">Disponible</span></td>
                <td><a href="/biens/1" style="color:#C8873A;font-size:13px;">Voir →</a></td>
            </tr>
            <tr>
                <td>🏠 Appartement F2 moderne</td>
                <td>Casablanca</td>
                <td>4 200 MAD/mois</td>
                <td><span class="mk-badge mk-badge-green">Disponible</span></td>
                <td><a href="/biens/2" style="color:#C8873A;font-size:13px;">Voir →</a></td>
            </tr>
            <tr>
                <td>🏠 Villa avec piscine</td>
                <td>Agadir</td>
                <td>7 000 MAD/mois</td>
                <td><span class="mk-badge mk-badge-gold">En demande</span></td>
                <td><a href="/biens/6" style="color:#C8873A;font-size:13px;">Voir →</a></td>
            </tr>
        </tbody>
    </table>
</div>

{{-- MESSAGES RECENTS --}}
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
                <td>👤 Mohammed Karimi</td>
                <td>Studio Guéliz</td>
                <td style="color:#888;font-style:italic;">"Bonjour, le logement est toujours..."</td>
                <td>Aujourd'hui</td>
            </tr>
            <tr>
                <td>👤 Sara Benali</td>
                <td>Appartement F2</td>
                <td style="color:#888;font-style:italic;">"Oui la visite est confirmée pour..."</td>
                <td>Hier</td>
            </tr>
        </tbody>
    </table>
</div>

{{-- RENDEZ-VOUS --}}
<div class="dash-section">
    <div class="dash-section-header">
        <div class="dash-section-title">Prochains rendez-vous</div>
        <a href="#" class="dash-section-link">Voir tous →</a>
    </div>
    <table class="dash-table">
        <thead>
            <tr>
                <th>Logement</th>
                <th>Propriétaire</th>
                <th>Date</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>🏠 Studio meublé — Guéliz</td>
                <td>Mohammed Karimi</td>
                <td>15 Mai 2026 à 10h00</td>
                <td><span class="mk-badge mk-badge-blue">Confirmé</span></td>
            </tr>
        </tbody>
    </table>
</div>

@endsection