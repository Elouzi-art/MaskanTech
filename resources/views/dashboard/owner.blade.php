@extends('dashboard.layout')

@section('title', 'MaskanTech — Dashboard Propriétaire')

@section('dashboard-content')

{{-- HEADER --}}
<div class="dash-header">
    <div class="dash-title">Bonjour, {{ auth()->check() ? auth()->user()->name : 'Propriétaire' }} 🏠</div>
    <div class="dash-subtitle">Gérez vos annonces et suivez vos performances.</div>
</div>

{{-- STATS --}}
<div class="dash-stats">
    <div class="dash-stat-card">
        <div class="dash-stat-icon">📋</div>
        <div class="dash-stat-value">4</div>
        <div class="dash-stat-label">Annonces actives</div>
        <div class="dash-stat-change">↑ 1 ce mois</div>
    </div>
    <div class="dash-stat-card">
        <div class="dash-stat-icon">👁️</div>
        <div class="dash-stat-value">342</div>
        <div class="dash-stat-label">Vues totales</div>
        <div class="dash-stat-change">↑ 48 cette semaine</div>
    </div>
    <div class="dash-stat-card">
        <div class="dash-stat-icon">💬</div>
        <div class="dash-stat-value">12</div>
        <div class="dash-stat-label">Messages reçus</div>
        <div class="dash-stat-change">5 non lus</div>
    </div>
    <div class="dash-stat-card">
        <div class="dash-stat-icon">📅</div>
        <div class="dash-stat-value">3</div>
        <div class="dash-stat-label">Rendez-vous</div>
        <div class="dash-stat-change">2 à venir</div>
    </div>
</div>

{{-- ANNONCES --}}
<div class="dash-section">
    <div class="dash-section-header">
        <div class="dash-section-title">Mes annonces</div>
        <a href="#" class="dash-section-link">+ Publier une annonce</a>
    </div>
    <table class="dash-table">
        <thead>
            <tr>
                <th>Annonce</th>
                <th>Ville</th>
                <th>Prix</th>
                <th>Vues</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>🏠 Studio meublé — Guéliz</td>
                <td>Marrakech</td>
                <td>2 500 MAD</td>
                <td>142</td>
                <td><span class="mk-badge mk-badge-green">Active</span></td>
                <td>
                    <a href="/biens/1" style="color:#C8873A;font-size:13px;margin-right:8px;">Voir</a>
                    <a href="#" style="color:#888;font-size:13px;">Modifier</a>
                </td>
            </tr>
            <tr>
                <td>🏠 Appartement F2 moderne</td>
                <td>Casablanca</td>
                <td>4 200 MAD</td>
                <td>98</td>
                <td><span class="mk-badge mk-badge-green">Active</span></td>
                <td>
                    <a href="/biens/2" style="color:#C8873A;font-size:13px;margin-right:8px;">Voir</a>
                    <a href="#" style="color:#888;font-size:13px;">Modifier</a>
                </td>
            </tr>
            <tr>
                <td>🏠 Villa avec piscine</td>
                <td>Agadir</td>
                <td>7 000 MAD</td>
                <td>56</td>
                <td><span class="mk-badge mk-badge-gold">En pause</span></td>
                <td>
                    <a href="/biens/6" style="color:#C8873A;font-size:13px;margin-right:8px;">Voir</a>
                    <a href="#" style="color:#888;font-size:13px;">Modifier</a>
                </td>
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
                <th>Locataire</th>
                <th>Annonce</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>👤 Sara Benali</td>
                <td>Studio Guéliz</td>
                <td style="color:#888;font-style:italic;">"Bonjour, est-ce que le logement..."</td>
                <td>Aujourd'hui</td>
            </tr>
            <tr>
                <td>👤 Youssef Bennani</td>
                <td>Appartement F2</td>
                <td style="color:#888;font-style:italic;">"Je suis intéressé par votre..."</td>
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
                <th>Locataire</th>
                <th>Annonce</th>
                <th>Date</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>👤 Sara Benali</td>
                <td>Studio Guéliz</td>
                <td>15 Mai 2026 à 10h00</td>
                <td><span class="mk-badge mk-badge-blue">Confirmé</span></td>
            </tr>
            <tr>
                <td>👤 Karim Mansouri</td>
                <td>Appartement F2</td>
                <td>16 Mai 2026 à 14h00</td>
                <td><span class="mk-badge mk-badge-gold">En attente</span></td>
            </tr>
        </tbody>
    </table>
</div>

{{-- FAVORIS LOCATAIRE --}}
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
                <td>🏠 Appartement luxueux — Hivernage</td>
                <td>Marrakech</td>
                <td>5 500 MAD/mois</td>
                <td><span class="mk-badge mk-badge-green">Disponible</span></td>
                <td><a href="/biens/4" style="color:#C8873A;font-size:13px;">Voir →</a></td>
            </tr>
        </tbody>
    </table>
</div>

@endsection