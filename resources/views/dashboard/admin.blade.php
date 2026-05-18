@extends('layouts.maskan')
@section('title', 'MaskanTech — Panel Admin')

@section('styles')
.admin-wrap { display: flex; min-height: calc(100vh - 73px); }

/* SIDEBAR */
.admin-sidebar { width: 250px; min-width: 250px; background: #111; padding: 28px 0; position: sticky; top: 73px; height: calc(100vh - 73px); overflow-y: auto; }
.admin-logo { padding: 0 20px 24px; border-bottom: 1px solid rgba(255,255,255,0.07); margin-bottom: 20px; }
.admin-logo-text { font-family: 'Playfair Display', serif; font-size: 17px; font-weight: 700; color: #fff; }
.admin-logo-text span { color: #C8873A; }
.admin-badge { display: inline-block; font-size: 10px; padding: 2px 8px; border-radius: 10px; background: rgba(220,50,50,0.3); color: #ff8080; margin-left: 8px; }
.admin-nav { padding: 0 10px; }
.admin-nav-section { font-size: 10px; color: rgba(255,255,255,0.3); letter-spacing: 2px; text-transform: uppercase; padding: 0 10px; margin: 18px 0 6px; }
.admin-nav-link { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 8px; text-decoration: none; font-size: 13px; color: rgba(255,255,255,0.55); transition: all 0.2s; margin-bottom: 2px; }
.admin-nav-link:hover { background: rgba(255,255,255,0.07); color: #fff; }
.admin-nav-link.active { background: rgba(200,135,58,0.2); color: #E8A855; }
.admin-nav-icon { font-size: 16px; width: 18px; text-align: center; }

/* MAIN */
.admin-main { flex: 1; padding: 32px 36px; background: #f8f7f4; min-width: 0; }
.admin-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 28px; }
.admin-title { font-family: 'Playfair Display', serif; font-size: 26px; font-weight: 700; color: #1a1a1a; }
.admin-subtitle { font-size: 13px; color: #888; margin-top: 4px; }
.admin-actions { display: flex; gap: 10px; }
.admin-btn { padding: 9px 18px; border-radius: 8px; font-size: 12px; font-weight: 500; cursor: pointer; font-family: 'DM Sans', sans-serif; transition: all 0.2s; text-decoration: none; }
.admin-btn-primary { background: #1a1a1a; color: #fff; border: none; }
.admin-btn-primary:hover { background: #C8873A; color: #fff; }
.admin-btn-outline { background: transparent; border: 1.5px solid #e8e3db; color: #555; }
.admin-btn-outline:hover { border-color: #C8873A; color: #C8873A; }

/* STATS */
.stats-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 18px; margin-bottom: 24px; }
.stat-card { background: #fff; border: 1px solid #ede9e3; border-radius: 12px; padding: 22px; transition: transform 0.2s; }
.stat-card:hover { transform: translateY(-2px); }
.stat-icon { width: 42px; height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-bottom: 12px; }
.icon-blue { background: #e6f1fb; }
.icon-gold { background: #fdf6ee; }
.icon-green { background: #eaf3de; }
.icon-red { background: #fff0f0; }
.stat-value { font-family: 'Playfair Display', serif; font-size: 26px; font-weight: 700; color: #1a1a1a; }
.stat-label { font-size: 12px; color: #888; margin-top: 3px; }
.stat-sub { font-size: 11px; color: #aaa; margin-top: 4px; }

/* SECTIONS */
.admin-section { background: #fff; border: 1px solid #ede9e3; border-radius: 12px; padding: 22px; margin-bottom: 20px; }
.section-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 18px; padding-bottom: 14px; border-bottom: 1px solid #f0ede8; }
.section-title { font-family: 'Playfair Display', serif; font-size: 17px; font-weight: 700; color: #1a1a1a; }

/* TABLE */
.admin-table { width: 100%; border-collapse: collapse; }
.admin-table th { font-size: 11px; color: #888; letter-spacing: 1.5px; text-transform: uppercase; padding: 10px 14px; text-align: left; border-bottom: 1px solid #f0ede8; background: #fafaf8; }
.admin-table td { padding: 13px 14px; font-size: 13px; color: #555; border-bottom: 1px solid #f8f7f4; vertical-align: middle; }
.admin-table tr:last-child td { border-bottom: none; }
.admin-table tr:hover td { background: #fafaf8; }
.table-avatar { width: 30px; height: 30px; border-radius: 50%; background: linear-gradient(135deg, #C8873A, #E8A855); display: inline-flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; color: #fff; margin-right: 8px; vertical-align: middle; flex-shrink: 0; }
.table-actions { display: flex; gap: 6px; flex-wrap: wrap; }
.tbl-btn { padding: 5px 12px; border-radius: 6px; font-size: 11px; font-weight: 500; cursor: pointer; font-family: 'DM Sans', sans-serif; transition: all 0.2s; text-decoration: none; border: none; }
.tbl-btn-outline { background: transparent; border: 1.5px solid #e8e3db; color: #555; }
.tbl-btn-outline:hover { border-color: #C8873A; color: #C8873A; }
.tbl-btn-danger { background: transparent; border: 1.5px solid #ffcdd2; color: #dc3545; }
.tbl-btn-danger:hover { background: #fff0f0; }

/* BADGE */
.badge { display: inline-block; font-size: 11px; font-weight: 500; padding: 3px 9px; border-radius: 20px; }
.badge-green { background: #eaf3de; color: #27500A; }
.badge-gold { background: #fdf6ee; color: #C8873A; }
.badge-blue { background: #e6f1fb; color: #1e40af; }
.badge-red { background: #fff0f0; color: #dc3545; }
.badge-gray { background: #f5f2ee; color: #888; }

/* CHARTS */
.charts-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
.chart-card { background: #fff; border: 1px solid #ede9e3; border-radius: 12px; padding: 22px; }
.chart-title { font-size: 14px; font-weight: 600; color: #1a1a1a; margin-bottom: 18px; }
.chart-bars { display: flex; align-items: flex-end; gap: 6px; height: 100px; }
.chart-bar { flex: 1; border-radius: 4px 4px 0 0; background: linear-gradient(to top, #C8873A, #E8A855); cursor: pointer; transition: opacity 0.2s; }
.chart-bar:hover { opacity: 0.8; }
.chart-labels { display: flex; gap: 6px; margin-top: 6px; }
.chart-label { flex: 1; font-size: 10px; color: #aaa; text-align: center; }

/* ACTIVITY */
.activity-list { display: flex; flex-direction: column; gap: 12px; }
.activity-item { display: flex; align-items: center; gap: 12px; padding: 12px 0; border-bottom: 1px solid #f8f7f4; }
.activity-item:last-child { border-bottom: none; }
.activity-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
.dot-gold { background: #C8873A; }
.dot-blue { background: #185FA5; }
.activity-info { flex: 1; min-width: 0; }
.activity-title { font-size: 13px; color: #1a1a1a; font-weight: 500; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.activity-sub { font-size: 12px; color: #888; margin-top: 2px; }
.activity-time { font-size: 11px; color: #aaa; flex-shrink: 0; }

@media(max-width:1200px) { .stats-grid { grid-template-columns: repeat(2,1fr); } .charts-grid { grid-template-columns: 1fr; } }
@media(max-width:900px) { .admin-sidebar { display: none; } }
@endsection

@section('content')
<div class="admin-wrap">

    {{-- SIDEBAR --}}
    <div class="admin-sidebar">
        <div class="admin-logo">
            <div class="admin-logo-text">Maskan<span>Tech</span> <span class="admin-badge">ADMIN</span></div>
        </div>
        <div class="admin-nav">
            <div class="admin-nav-section">Tableau de bord</div>
            <a href="{{ route('dashboard') }}" class="admin-nav-link active">
                <span class="admin-nav-icon">📊</span> Vue globale
            </a>
            <div class="admin-nav-section">Gestion</div>
            <a href="{{ route('admin.users') }}" class="admin-nav-link">
                <span class="admin-nav-icon">👥</span> Utilisateurs
            </a>
            <a href="{{ route('admin.properties') }}" class="admin-nav-link">
                <span class="admin-nav-icon">🏘️</span> Annonces
            </a>
            <a href="{{ route('admin.contacts') }}" class="admin-nav-link">
                <span class="admin-nav-icon">💬</span> Messages contact
            </a>
            <div class="admin-nav-section">Mon compte</div>
            <a href="{{ route('profile.edit') }}" class="admin-nav-link">
                <span class="admin-nav-icon">⚙️</span> Mon profil
            </a>
            <form method="POST" action="{{ route('logout') }}" style="padding:0 10px">
                @csrf
                <button type="submit" class="admin-nav-link" style="width:100%;background:none;border:none;cursor:pointer;color:rgba(255,100,100,0.7)">
                    <span class="admin-nav-icon">🚪</span> Déconnexion
                </button>
            </form>
        </div>
    </div>

    {{-- MAIN --}}
    <div class="admin-main">

        {{-- HEADER --}}
        <div class="admin-header">
            <div>
                <div class="admin-title">👑 Panel Administrateur</div>
                <div class="admin-subtitle">Vue globale — {{ now()->isoFormat('dddd D MMMM YYYY') }}</div>
            </div>
            <div class="admin-actions">
                <a href="{{ route('properties.create') }}" class="admin-btn admin-btn-primary">+ Nouvelle annonce</a>
            </div>
        </div>

        {{-- STATS --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon icon-blue">👥</div>
                <div class="stat-value">{{ $stats['total_users'] }}</div>
                <div class="stat-label">Utilisateurs</div>
                <div class="stat-sub">{{ $stats['total_students'] }} étudiants · {{ $stats['total_owners'] }} propriétaires</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-gold">🏘️</div>
                <div class="stat-value">{{ $stats['total_properties'] }}</div>
                <div class="stat-label">Annonces</div>
                <div class="stat-sub">{{ $stats['available_properties'] }} disponibles · {{ $stats['rented_properties'] }} louées</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-green">📅</div>
                <div class="stat-value">{{ $stats['appointments_month'] }}</div>
                <div class="stat-label">RDV ce mois</div>
                <div class="stat-sub">{{ $stats['pending_appointments'] }} en attente</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon icon-red">💬</div>
                <div class="stat-value">{{ $stats['unread_messages'] }}</div>
                <div class="stat-label">Messages non lus</div>
                <div class="stat-sub">{{ $stats['active_agents'] }} agents actifs</div>
            </div>
        </div>

        {{-- CHARTS --}}
        <div class="charts-grid">
            <div class="chart-card">
                <div class="chart-title">📈 Annonces publiées — 12 derniers mois</div>
                @php $maxVal = max(1, max($chartData)); @endphp
                <div class="chart-bars">
                    @foreach($chartData as $val)
                    <div class="chart-bar" style="height:{{ max(4, ($val / $maxVal) * 100) }}%" title="{{ $val }} annonce(s)"></div>
                    @endforeach
                </div>
                <div class="chart-labels">
                    @foreach($chartLabels as $lbl)
                    <div class="chart-label">{{ $lbl }}</div>
                    @endforeach
                </div>
            </div>

            <div class="chart-card">
                <div class="chart-title">🎯 Activité récente</div>
                <div class="activity-list">
                    @forelse($recentActivity->take(6) as $act)
                    <div class="activity-item">
                        <div class="activity-dot {{ $act['type'] === 'loué' ? 'dot-blue' : 'dot-gold' }}"></div>
                        <div class="activity-info">
                            <div class="activity-title">{{ $act['title'] }}</div>
                            <div class="activity-sub">{{ $act['sub'] }}</div>
                        </div>
                        <div class="activity-time">{{ $act['time'] }}</div>
                    </div>
                    @empty
                    <p style="font-size:13px;color:#888">Aucune activité récente.</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- RACCOURCIS ADMIN --}}
        <div class="admin-section">
            <div class="section-header">
                <div class="section-title">⚡ Accès rapide</div>
            </div>
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px">
                <a href="{{ route('admin.users') }}" class="admin-btn admin-btn-outline" style="text-align:center;display:block;padding:14px">
                    👥 Gérer les utilisateurs
                </a>
                <a href="{{ route('admin.properties') }}" class="admin-btn admin-btn-outline" style="text-align:center;display:block;padding:14px">
                    🏘️ Gérer les annonces
                </a>
                <a href="{{ route('admin.contacts') }}" class="admin-btn admin-btn-outline" style="text-align:center;display:block;padding:14px">
                    📧 Messages de contact
                </a>
            </div>
        </div>

        {{-- AGENTS ACTIFS --}}
        @if($activeAgents->count())
        <div class="admin-section">
            <div class="section-header">
                <div class="section-title">🏢 Agents actifs</div>
                <a href="{{ route('admin.users') }}?role=agent" class="admin-btn admin-btn-outline">Voir tous</a>
            </div>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Agent</th>
                        <th>Email</th>
                        <th>Inscrit le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activeAgents as $agent)
                    <tr>
                        <td>
                            <span class="table-avatar">{{ strtoupper(substr($agent->name, 0, 2)) }}</span>
                            {{ $agent->name }}
                        </td>
                        <td>{{ $agent->email }}</td>
                        <td>{{ $agent->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="table-actions">
                                <a href="{{ route('messages.show', $agent) }}" class="tbl-btn tbl-btn-outline">💬 Message</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

    </div>
</div>
@endsection
