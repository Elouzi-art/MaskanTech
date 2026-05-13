@extends('layouts.maskan')

@section('title', 'MaskanTech — Panel Admin')

@section('styles')
.admin-wrap { display: flex; min-height: calc(100vh - 73px); }

/* SIDEBAR */
.admin-sidebar {
    width: 260px; min-width: 260px;
    background: #111; padding: 32px 0;
    position: sticky; top: 73px;
    height: calc(100vh - 73px); overflow-y: auto;
}
.admin-logo {
    padding: 0 24px 28px;
    border-bottom: 1px solid rgba(255,255,255,0.07);
    margin-bottom: 24px;
}
.admin-logo-text {
    font-family: 'Playfair Display', serif;
    font-size: 18px; font-weight: 700; color: #fff;
}
.admin-logo-text span { color: #C8873A; }
.admin-logo-badge {
    display: inline-block; font-size: 10px; font-weight: 500;
    padding: 2px 8px; border-radius: 10px;
    background: rgba(220,50,50,0.3); color: #ff8080;
    margin-left: 8px;
}
.admin-nav { padding: 0 12px; }
.admin-nav-section {
    font-size: 10px; color: rgba(255,255,255,0.3);
    letter-spacing: 2px; text-transform: uppercase;
    padding: 0 12px; margin-bottom: 8px; margin-top: 20px;
}
.admin-nav-link {
    display: flex; align-items: center; gap: 12px;
    padding: 11px 12px; border-radius: 8px;
    text-decoration: none; font-size: 14px;
    color: rgba(255,255,255,0.6); transition: all 0.2s; margin-bottom: 2px;
}
.admin-nav-link:hover { background: rgba(255,255,255,0.07); color: #fff; }
.admin-nav-link.active { background: rgba(200,135,58,0.2); color: #E8A855; }
.admin-nav-icon { font-size: 18px; width: 20px; text-align: center; }
.admin-nav-badge {
    margin-left: auto; background: #C8873A; color: #fff;
    font-size: 11px; font-weight: 600; padding: 2px 7px;
    border-radius: 10px;
}
.admin-nav-badge-red {
    margin-left: auto; background: #dc3545; color: #fff;
    font-size: 11px; font-weight: 600; padding: 2px 7px;
    border-radius: 10px;
}

/* MAIN */
.admin-main { flex: 1; padding: 36px 40px; background: #f8f7f4; }
.admin-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 32px;
}
.admin-title {
    font-family: 'Playfair Display', serif;
    font-size: 28px; font-weight: 700; color: #1a1a1a;
}
.admin-subtitle { font-size: 14px; color: #888; margin-top: 4px; }
.admin-header-actions { display: flex; gap: 10px; }

/* STATS */
.admin-stats { display: grid; grid-template-columns: repeat(4,1fr); gap: 20px; margin-bottom: 28px; }
.admin-stat-card {
    background: #fff; border: 1px solid #ede9e3;
    border-radius: 12px; padding: 24px;
    transition: transform 0.2s;
}
.admin-stat-card:hover { transform: translateY(-3px); }
.admin-stat-icon {
    width: 44px; height: 44px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px; margin-bottom: 14px;
}
.icon-blue { background: #e6f1fb; }
.icon-gold { background: #fdf6ee; }
.icon-green { background: #eaf3de; }
.icon-red { background: #fff0f0; }
.admin-stat-value {
    font-family: 'Playfair Display', serif;
    font-size: 28px; font-weight: 700; color: #1a1a1a;
}
.admin-stat-label { font-size: 13px; color: #888; margin-top: 4px; }
.admin-stat-change { font-size: 12px; margin-top: 6px; }
.change-up { color: #27500A; }
.change-down { color: #dc3545; }
.change-warn { color: #C8873A; }

/* TABLES */
.admin-section {
    background: #fff; border: 1px solid #ede9e3;
    border-radius: 12px; padding: 24px; margin-bottom: 24px;
}
.admin-section-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 20px; padding-bottom: 16px;
    border-bottom: 1px solid #f0ede8;
}
.admin-section-title {
    font-family: 'Playfair Display', serif;
    font-size: 18px; font-weight: 700; color: #1a1a1a;
}
.admin-section-actions { display: flex; gap: 8px; }
.admin-btn {
    padding: 8px 16px; border-radius: 7px;
    font-size: 12px; font-weight: 500; cursor: pointer;
    font-family: 'DM Sans', sans-serif; transition: all 0.2s;
}
.admin-btn-primary { background: #1a1a1a; color: #fff; border: none; }
.admin-btn-primary:hover { background: #C8873A; }
.admin-btn-outline { background: transparent; border: 1.5px solid #e8e3db; color: #555; }
.admin-btn-outline:hover { border-color: #C8873A; color: #C8873A; }
.admin-btn-danger { background: transparent; border: 1.5px solid #ffcdd2; color: #dc3545; }
.admin-btn-danger:hover { background: #fff0f0; }
.admin-btn-success { background: transparent; border: 1.5px solid #c8e6c9; color: #27500A; }
.admin-btn-success:hover { background: #eaf3de; }

/* TABLE */
.admin-table { width: 100%; border-collapse: collapse; }
.admin-table th {
    font-size: 11px; color: #888; letter-spacing: 1.5px;
    text-transform: uppercase; font-weight: 500;
    padding: 10px 16px; text-align: left;
    border-bottom: 1px solid #f0ede8; background: #fafaf8;
}
.admin-table td {
    padding: 14px 16px; font-size: 13px; color: #555;
    border-bottom: 1px solid #f8f7f4;
    vertical-align: middle;
}
.admin-table tr:last-child td { border-bottom: none; }
.admin-table tr:hover td { background: #fafaf8; }
.admin-table-actions { display: flex; gap: 6px; }

/* USER AVATAR */
.table-avatar {
    width: 32px; height: 32px; border-radius: 50%;
    background: linear-gradient(135deg, #C8873A, #E8A855);
    display: flex; align-items: center; justify-content: center;
    font-size: 11px; font-weight: 700; color: #fff;
    display: inline-flex; margin-right: 8px;
    vertical-align: middle;
}

/* SEARCH & FILTER */
.admin-filters {
    display: flex; gap: 12px; margin-bottom: 20px; flex-wrap: wrap;
}
.admin-search {
    flex: 1; padding: 10px 16px;
    border: 1.5px solid #e8e3db; border-radius: 8px;
    font-size: 13px; font-family: 'DM Sans', sans-serif;
    outline: none; transition: border-color 0.2s; min-width: 200px;
}
.admin-search:focus { border-color: #C8873A; }
.admin-filter-select {
    padding: 10px 16px; border: 1.5px solid #e8e3db;
    border-radius: 8px; font-size: 13px; color: #555;
    font-family: 'DM Sans', sans-serif; outline: none; cursor: pointer;
}
.admin-filter-select:focus { border-color: #C8873A; }

/* TABS */
.admin-tabs {
    display: flex; gap: 4px; margin-bottom: 20px;
    background: #f0ede8; border-radius: 10px;
    padding: 4px; width: fit-content;
}
.admin-tab {
    padding: 8px 20px; border-radius: 8px;
    font-size: 13px; font-weight: 500; cursor: pointer;
    transition: all 0.2s; color: #888; border: none;
    background: transparent; font-family: 'DM Sans', sans-serif;
}
.admin-tab.active {
    background: #fff; color: #1a1a1a;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

/* CHARTS PLACEHOLDER */
.admin-charts { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px; }
.chart-card {
    background: #fff; border: 1px solid #ede9e3;
    border-radius: 12px; padding: 24px;
}
.chart-title {
    font-family: 'Playfair Display', serif;
    font-size: 16px; font-weight: 700; color: #1a1a1a;
    margin-bottom: 20px;
}
.chart-bars { display: flex; align-items: flex-end; gap: 8px; height: 120px; }
.chart-bar {
    flex: 1; border-radius: 4px 4px 0 0;
    background: linear-gradient(to top, #C8873A, #E8A855);
    transition: opacity 0.2s; cursor: pointer;
}
.chart-bar:hover { opacity: 0.8; }
.chart-labels { display: flex; gap: 8px; margin-top: 8px; }
.chart-label { flex: 1; font-size: 10px; color: #aaa; text-align: center; }
.chart-donut {
    width: 120px; height: 120px; border-radius: 50%;
    background: conic-gradient(#C8873A 0% 45%, #185FA5 45% 75%, #27500A 75% 90%, #888 90% 100%);
    margin: 0 auto 16px;
    display: flex; align-items: center; justify-content: center;
    position: relative;
}
.chart-donut-inner {
    width: 70px; height: 70px; border-radius: 50%;
    background: #fff; position: absolute;
}
.chart-legend { display: flex; flex-direction: column; gap: 8px; }
.chart-legend-item { display: flex; align-items: center; gap: 8px; font-size: 12px; color: #555; }
.chart-legend-dot { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
@endsection

@section('content')
<div class="admin-wrap">

    {{-- SIDEBAR --}}
    <div class="admin-sidebar">
        <div class="admin-logo">
            <div class="admin-logo-text">Maskan<span>Tech</span> <span class="admin-logo-badge">ADMIN</span></div>
        </div>
        <div class="admin-nav">
            <div class="admin-nav-section">Tableau de bord</div>
            <a href="/admin" class="admin-nav-link active">
                <span class="admin-nav-icon">📊</span> Vue globale
            </a>

            <div class="admin-nav-section">Gestion</div>
            <a href="#" class="admin-nav-link" onclick="showSection('users')">
                <span class="admin-nav-icon">👥</span> Utilisateurs
                <span class="admin-nav-badge">8 234</span>
            </a>
            <a href="#" class="admin-nav-link" onclick="showSection('properties')">
                <span class="admin-nav-icon">🏘️</span> Annonces
                <span class="admin-nav-badge">1 247</span>
            </a>
            <a href="#" class="admin-nav-link" onclick="showSection('reports')">
                <span class="admin-nav-icon">⚠️</span> Signalements
                <span class="admin-nav-badge-red">7</span>
            </a>
            <a href="#" class="admin-nav-link" onclick="showSection('messages')">
                <span class="admin-nav-icon">💬</span> Messages
            </a>
            <a href="#" class="admin-nav-link" onclick="showSection('appointments')">
                <span class="admin-nav-icon">📅</span> Rendez-vous
            </a>

            <div class="admin-nav-section">Contenu</div>
            <a href="#" class="admin-nav-link">
                <span class="admin-nav-icon">📰</span> Blog
            </a>

            <div class="admin-nav-section">Système</div>
            <a href="#" class="admin-nav-link">
                <span class="admin-nav-icon">⚙️</span> Paramètres
            </a>
            <a href="#" class="admin-nav-link" style="color:#ff6b6b;">
                <span class="admin-nav-icon">🚪</span> Déconnexion
            </a>
        </div>
    </div>

    {{-- MAIN --}}
    <div class="admin-main">

        {{-- HEADER --}}
        <div class="admin-header">
            <div>
                <div class="admin-title">👑 Panel Administrateur</div>
                <div class="admin-subtitle">Vue globale de MaskanTech — Mercredi 13 Mai 2026</div>
            </div>
            <div class="admin-header-actions">
                <button class="admin-btn admin-btn-outline">📥 Exporter</button>
                <button class="admin-btn admin-btn-primary">+ Ajouter</button>
            </div>
        </div>

        {{-- STATS --}}
        <div class="admin-stats">
            <div class="admin-stat-card">
                <div class="admin-stat-icon icon-blue">👥</div>
                <div class="admin-stat-value">8 234</div>
                <div class="admin-stat-label">Utilisateurs totaux</div>
                <div class="admin-stat-change change-up">↑ 124 ce mois</div>
            </div>
            <div class="admin-stat-card">
                <div class="admin-stat-icon icon-gold">🏘️</div>
                <div class="admin-stat-value">1 247</div>
                <div class="admin-stat-label">Annonces actives</div>
                <div class="admin-stat-change change-up">↑ 38 cette semaine</div>
            </div>
            <div class="admin-stat-card">
                <div class="admin-stat-icon icon-red">⚠️</div>
                <div class="admin-stat-value">7</div>
                <div class="admin-stat-label">Signalements</div>
                <div class="admin-stat-change change-warn">À traiter</div>
            </div>
            <div class="admin-stat-card">
                <div class="admin-stat-icon icon-green">💬</div>
                <div class="admin-stat-value">3 456</div>
                <div class="admin-stat-label">Messages échangés</div>
                <div class="admin-stat-change change-up">↑ 89 aujourd'hui</div>
            </div>
        </div>

        {{-- CHARTS --}}
        <div class="admin-charts">
            <div class="chart-card">
                <div class="chart-title">📈 Inscriptions — 6 derniers mois</div>
                <div class="chart-bars">
                    <div class="chart-bar" style="height:40%;" title="Déc: 180"></div>
                    <div class="chart-bar" style="height:55%;" title="Jan: 240"></div>
                    <div class="chart-bar" style="height:45%;" title="Fév: 200"></div>
                    <div class="chart-bar" style="height:70%;" title="Mar: 310"></div>
                    <div class="chart-bar" style="height:85%;" title="Avr: 380"></div>
                    <div class="chart-bar" style="height:100%;" title="Mai: 124"></div>
                </div>
                <div class="chart-labels">
                    <div class="chart-label">Déc</div>
                    <div class="chart-label">Jan</div>
                    <div class="chart-label">Fév</div>
                    <div class="chart-label">Mar</div>
                    <div class="chart-label">Avr</div>
                    <div class="chart-label">Mai</div>
                </div>
            </div>
            <div class="chart-card">
                <div class="chart-title">🎯 Répartition des utilisateurs</div>
                <div class="chart-donut">
                    <div class="chart-donut-inner"></div>
                </div>
                <div class="chart-legend">
                    <div class="chart-legend-item">
                        <div class="chart-legend-dot" style="background:#C8873A;"></div>
                        <span>Locataires — 45%</span>
                    </div>
                    <div class="chart-legend-item">
                        <div class="chart-legend-dot" style="background:#185FA5;"></div>
                        <span>Étudiants — 30%</span>
                    </div>
                    <div class="chart-legend-item">
                        <div class="chart-legend-dot" style="background:#27500A;"></div>
                        <span>Propriétaires — 15%</span>
                    </div>
                    <div class="chart-legend-item">
                        <div class="chart-legend-dot" style="background:#888;"></div>
                        <span>Autres — 10%</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- UTILISATEURS --}}
        <div class="admin-section" id="section-users">
            <div class="admin-section-header">
                <div class="admin-section-title">👥 Utilisateurs récents</div>
                <div class="admin-section-actions">
                    <button class="admin-btn admin-btn-outline">📥 Exporter</button>
                    <button class="admin-btn admin-btn-primary">+ Ajouter</button>
                </div>
            </div>

            <div class="admin-filters">
                <input type="text" class="admin-search" placeholder="🔍 Rechercher un utilisateur...">
                <select class="admin-filter-select">
                    <option>Tous les rôles</option>
                    <option>Locataire</option>
                    <option>Étudiant</option>
                    <option>Propriétaire</option>
                    <option>Admin</option>
                </select>
                <select class="admin-filter-select">
                    <option>Tous les statuts</option>
                    <option>Actif</option>
                    <option>Suspendu</option>
                    <option>En attente</option>
                </select>
            </div>

            <div class="admin-tabs">
                <button class="admin-tab active">Tous (8 234)</button>
                <button class="admin-tab">Actifs (7 890)</button>
                <button class="admin-tab">Suspendus (12)</button>
                <button class="admin-tab">En attente (332)</button>
            </div>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Inscription</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="table-avatar">SB</span>Sara Benali</td>
                        <td>sara@email.com</td>
                        <td><span class="mk-badge mk-badge-blue">Locataire</span></td>
                        <td>Aujourd'hui</td>
                        <td><span class="mk-badge mk-badge-green">Actif</span></td>
                        <td>
                            <div class="admin-table-actions">
                                <button class="admin-btn admin-btn-outline">👁 Voir</button>
                                <button class="admin-btn admin-btn-danger">🚫 Suspendre</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-avatar">AK</span>Ahmed Karimi</td>
                        <td>ahmed@email.com</td>
                        <td><span class="mk-badge mk-badge-gold">Propriétaire</span></td>
                        <td>Hier</td>
                        <td><span class="mk-badge mk-badge-green">Actif</span></td>
                        <td>
                            <div class="admin-table-actions">
                                <button class="admin-btn admin-btn-outline">👁 Voir</button>
                                <button class="admin-btn admin-btn-danger">🚫 Suspendre</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-avatar">YB</span>Youssef Bennani</td>
                        <td>youssef@email.com</td>
                        <td><span class="mk-badge" style="background:#e6f1fb;color:#185FA5;">Étudiant</span></td>
                        <td>12 Mai 2026</td>
                        <td><span class="mk-badge mk-badge-green">Actif</span></td>
                        <td>
                            <div class="admin-table-actions">
                                <button class="admin-btn admin-btn-outline">👁 Voir</button>
                                <button class="admin-btn admin-btn-danger">🚫 Suspendre</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="table-avatar">KM</span>Karim Mansouri</td>
                        <td>karim@email.com</td>
                        <td><span class="mk-badge mk-badge-blue">Locataire</span></td>
                        <td>10 Mai 2026</td>
                        <td><span class="mk-badge" style="background:#fff3e0;color:#e65100;">En attente</span></td>
                        <td>
                            <div class="admin-table-actions">
                                <button class="admin-btn admin-btn-success">✅ Valider</button>
                                <button class="admin-btn admin-btn-danger">✕ Refuser</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- ANNONCES --}}
        <div class="admin-section" id="section-properties">
            <div class="admin-section-header">
                <div class="admin-section-title">🏘️ Annonces récentes</div>
                <div class="admin-section-actions">
                    <button class="admin-btn admin-btn-outline">📥 Exporter</button>
                </div>
            </div>

            <div class="admin-filters">
                <input type="text" class="admin-search" placeholder="🔍 Rechercher une annonce...">
                <select class="admin-filter-select">
                    <option>Toutes les villes</option>
                    <option>Marrakech</option>
                    <option>Casablanca</option>
                    <option>Rabat</option>
                    <option>Fès</option>
                </select>
                <select class="admin-filter-select">
                    <option>Tous les statuts</option>
                    <option>Active</option>
                    <option>En attente</option>
                    <option>Suspendue</option>
                </select>
            </div>

            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Annonce</th>
                        <th>Propriétaire</th>
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
                        <td>Mohammed Karimi</td>
                        <td>Marrakech</td>
                        <td>2 500 MAD</td>
                        <td>142</td>
                        <td><span class="mk-badge mk-badge-green">Active</span></td>
                        <td>
                            <div class="admin-table-actions">
                                <button class="admin-btn admin-btn-outline">👁 Voir</button>
                                <button class="admin-btn admin-btn-danger">🗑 Supprimer</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>🏠 Appartement F2 moderne</td>
                        <td>Sara Benali</td>
                        <td>Casablanca</td>
                        <td>4 200 MAD</td>
                        <td>98</td>
                        <td><span class="mk-badge mk-badge-green">Active</span></td>
                        <td>
                            <div class="admin-table-actions">
                                <button class="admin-btn admin-btn-outline">👁 Voir</button>
                                <button class="admin-btn admin-btn-danger">🗑 Supprimer</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>🏠 Villa avec piscine</td>
                        <td>Ahmed Karimi</td>
                        <td>Agadir</td>
                        <td>7 000 MAD</td>
                        <td>56</td>
                        <td><span class="mk-badge" style="background:#fff3e0;color:#e65100;">En attente</span></td>
                        <td>
                            <div class="admin-table-actions">
                                <button class="admin-btn admin-btn-success">✅ Valider</button>
                                <button class="admin-btn admin-btn-danger">✕ Refuser</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- SIGNALEMENTS --}}
        <div class="admin-section" id="section-reports">
            <div class="admin-section-header">
                <div class="admin-section-title">⚠️ Signalements à traiter</div>
                <span class="admin-nav-badge-red" style="font-size:12px;padding:4px 10px;border-radius:10px;">7 en attente</span>
            </div>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Annonce signalée</th>
                        <th>Signalé par</th>
                        <th>Raison</th>
                        <th>Date</th>
                        <th>Priorité</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>🏠 Studio Guéliz</td>
                        <td><span class="table-avatar">KM</span>Karim M.</td>
                        <td>Photos incorrectes</td>
                        <td>Aujourd'hui</td>
                        <td><span class="mk-badge" style="background:#fff0f0;color:#dc3545;">Haute</span></td>
                        <td>
                            <div class="admin-table-actions">
                                <button class="admin-btn admin-btn-success">✅ Traiter</button>
                                <button class="admin-btn admin-btn-outline">👁 Voir</button>
                                <button class="admin-btn admin-btn-danger">✕ Ignorer</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>🏠 Appartement F2</td>
                        <td><span class="table-avatar">YB</span>Youssef B.</td>
                        <td>Prix trompeur</td>
                        <td>Hier</td>
                        <td><span class="mk-badge mk-badge-gold">Moyenne</span></td>
                        <td>
                            <div class="admin-table-actions">
                                <button class="admin-btn admin-btn-success">✅ Traiter</button>
                                <button class="admin-btn admin-btn-outline">👁 Voir</button>
                                <button class="admin-btn admin-btn-danger">✕ Ignorer</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>🏠 Villa Agadir</td>
                        <td><span class="table-avatar">SB</span>Sara B.</td>
                        <td>Annonce frauduleuse</td>
                        <td>12 Mai 2026</td>
                        <td><span class="mk-badge" style="background:#fff0f0;color:#dc3545;">Haute</span></td>
                        <td>
                            <div class="admin-table-actions">
                                <button class="admin-btn admin-btn-success">✅ Traiter</button>
                                <button class="admin-btn admin-btn-outline">👁 Voir</button>
                                <button class="admin-btn admin-btn-danger">✕ Ignorer</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    function showSection(section) {
        document.querySelectorAll('.admin-nav-link').forEach(l => l.classList.remove('active'));
        event.currentTarget.classList.add('active');

        const target = document.getElementById('section-' + section);
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    document.querySelectorAll('.admin-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            this.closest('.admin-tabs').querySelectorAll('.admin-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>
@endsection