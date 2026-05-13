@extends('dashboard.layout')

@section('title', 'MaskanTech — Panel Admin')

@section('dashboard-content')

{{-- HEADER --}}
<div class="dash-header">
    <div class="dash-title">Panel Admin 👑</div>
    <div class="dash-subtitle">Vue globale de la plateforme MaskanTech.</div>
</div>

{{-- STATS --}}
<div class="dash-stats">
    <div class="dash-stat-card">
        <div class="dash-stat-icon">👥</div>
        <div class="dash-stat-value">8 234</div>
        <div class="dash-stat-label">Utilisateurs</div>
        <div class="dash-stat-change">↑ 124 ce mois</div>
    </div>
    <div class="dash-stat-card">
        <div class="dash-stat-icon">🏘️</div>
        <div class="dash-stat-value">1 247</div>
        <div class="dash-stat-label">Annonces actives</div>
        <div class="dash-stat-change">↑ 38 cette semaine</div>
    </div>
    <div class="dash-stat-card">
        <div class="dash-stat-icon">⚠️</div>
        <div class="dash-stat-value">7</div>
        <div class="dash-stat-label">Signalements</div>
        <div class="dash-stat-change" style="color:#C8873A;">À traiter</div>
    </div>
    <div class="dash-stat-card">
        <div class="dash-stat-icon">💬</div>
        <div class="dash-stat-value">3 456</div>
        <div class="dash-stat-label">Messages échangés</div>
        <div class="dash-stat-change">↑ 89 aujourd'hui</div>
    </div>
</div>

{{-- UTILISATEURS RECENTS --}}
<div class="dash-section">
    <div class="dash-section-header">
        <div class="dash-section-title">Utilisateurs récents</div>
        <a href="#" class="dash-section-link">Voir tous →</a>
    </div>
    <table class="dash-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Inscription</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>👤 Sara Benali</td>
                <td>sara@email.com</td>
                <td><span class="mk-badge mk-badge-blue">Locataire</span></td>
                <td>Aujourd'hui</td>
                <td><span class="mk-badge mk-badge-green">Actif</span></td>
                <td><a href="#" style="color:#C8873A;font-size:13px;">Gérer</a></td>
            </tr>
            <tr>
                <td>👤 Ahmed Karimi</td>
                <td>ahmed@email.com</td>
                <td><span class="mk-badge mk-badge-gold">Propriétaire</span></td>
                <td>Hier</td>
                <td><span class="mk-badge mk-badge-green">Actif</span></td>
                <td><a href="#" style="color:#C8873A;font-size:13px;">Gérer</a></td>
            </tr>
            <tr>
                <td>👤 Youssef Bennani</td>
                <td>youssef@email.com</td>
                <td><span class="mk-badge" style="background:#e6f1fb;color:#185FA5;">Étudiant</span></td>
                <td>12 Mai 2026</td>
                <td><span class="mk-badge mk-badge-green">Actif</span></td>
                <td><a href="#" style="color:#C8873A;font-size:13px;">Gérer</a></td>
            </tr>
        </tbody>
    </table>
</div>

{{-- ANNONCES RECENTES --}}
<div class="dash-section">
    <div class="dash-section-header">
        <div class="dash-section-title">Annonces récentes</div>
        <a href="#" class="dash-section-link">Voir toutes →</a>
    </div>
    <table class="dash-table">
        <thead>
            <tr>
                <th>Annonce</th>
                <th>Propriétaire</th>
                <th>Ville</th>
                <th>Prix</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>🏠 Studio meublé — Guéliz</td>
                <td>Mohammed Karimi</td>
                <td>Marrakech</td>
                <td>2 500 MAD</td>
                <td><span class="mk-badge mk-badge-green">Active</span></td>
                <td>
                    <a href="#" style="color:#C8873A;font-size:13px;margin-right:8px;">Voir</a>
                    <a href="#" style="color:#ff6b6b;font-size:13px;">Supprimer</a>
                </td>
            </tr>
            <tr>
                <td>🏠 Appartement F2 moderne</td>
                <td>Sara Benali</td>
                <td>Casablanca</td>
                <td>4 200 MAD</td>
                <td><span class="mk-badge mk-badge-green">Active</span></td>
                <td>
                    <a href="#" style="color:#C8873A;font-size:13px;margin-right:8px;">Voir</a>
                    <a href="#" style="color:#ff6b6b;font-size:13px;">Supprimer</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

{{-- SIGNALEMENTS --}}
<div class="dash-section">
    <div class="dash-section-header">
        <div class="dash-section-title">⚠️ Signalements à traiter</div>
        <a href="#" class="dash-section-link">Voir tous →</a>
    </div>
    <table class="dash-table">
        <thead>
            <tr>
                <th>Annonce signalée</th>
                <th>Signalé par</th>
                <th>Raison</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>🏠 Studio Guéliz</td>
                <td>👤 Karim M.</td>
                <td>Photos incorrectes</td>
                <td>Aujourd'hui</td>
                <td>
                    <a href="#" style="color:#C8873A;font-size:13px;margin-right:8px;">Traiter</a>
                    <a href="#" style="color:#ff6b6b;font-size:13px;">Ignorer</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@endsection