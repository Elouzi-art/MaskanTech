@extends('layouts.maskan')

@section('title', 'Dashboard — MaskanTech')

@section('styles')
.dash-wrap { max-width: 1280px; margin: 0 auto; padding: 36px 40px; }

/* Header */
.dash-header {
    display: flex; align-items: flex-start; justify-content: space-between;
    margin-bottom: 32px; gap: 20px; flex-wrap: wrap;
}
.dash-welcome { font-family: 'Playfair Display', serif; font-size: 26px; font-weight: 700; color: #1a1a1a; }
.dash-welcome span { color: #C8873A; }
.dash-sub { font-size: 14px; color: #888; margin-top: 4px; }
.dash-role-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: #fdf6ee; border: 1px solid #f0d9b5;
    color: #C8873A; font-size: 12px; font-weight: 500;
    padding: 6px 14px; border-radius: 20px; white-space: nowrap; align-self: flex-start;
}
.dash-cta-btn {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 12px 22px; background: #1a1a1a; color: #fff;
    border-radius: 8px; font-size: 13px; font-weight: 500;
    text-decoration: none; transition: background 0.2s; white-space: nowrap;
}
.dash-cta-btn:hover { background: #C8873A; color: #fff; }

/* Stats grid */
.stats-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 16px; margin-bottom: 32px; }
@media (max-width: 900px) { .stats-grid { grid-template-columns: repeat(2,1fr); } }
@media (max-width: 480px)  { .stats-grid { grid-template-columns: 1fr 1fr; } }

.stat-card {
    background: #fff; border: 1.5px solid #ede9e3;
    border-radius: 14px; padding: 22px 24px;
    transition: transform 0.2s, box-shadow 0.2s;
}
.stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 28px rgba(0,0,0,0.08); }
.stat-icon { font-size: 24px; margin-bottom: 12px; }
.stat-value { font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 700; color: #C8873A; }
.stat-label { font-size: 13px; color: #888; margin-top: 3px; }
.stat-sub { font-size: 11px; color: #bbb; margin-top: 2px; }

/* Section title */
.sec-title {
    font-family: 'Playfair Display', serif;
    font-size: 20px; font-weight: 700; color: #1a1a1a; margin-bottom: 18px;
}

/* Dash grid layout */
.dash-grid { display: grid; grid-template-columns: 1fr 340px; gap: 24px; }
@media (max-width: 1024px) { .dash-grid { grid-template-columns: 1fr; } }

/* Property list */
.prop-list { display: flex; flex-direction: column; gap: 12px; }
.prop-list-item {
    background: #fff; border: 1.5px solid #ede9e3;
    border-radius: 12px; padding: 16px 18px;
    display: flex; align-items: center; gap: 14px;
    transition: border-color 0.2s;
}
.prop-list-item:hover { border-color: #f0d9b5; }
.prop-list-thumb {
    width: 68px; height: 52px; border-radius: 8px;
    overflow: hidden; background: #f0ede8; flex-shrink: 0;
}
.prop-list-thumb img { width: 100%; height: 100%; object-fit: cover; }
.prop-list-thumb .ph { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 22px; }
.prop-list-info { flex: 1; min-width: 0; }
.prop-list-title { font-size: 14px; font-weight: 500; color: #1a1a1a; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.prop-list-meta { font-size: 12px; color: #aaa; margin-top: 3px; }
.prop-list-price { font-size: 13px; font-weight: 600; color: #C8873A; margin-top: 3px; }
.prop-list-actions { display: flex; gap: 8px; flex-shrink: 0; }
.prop-action-btn {
    padding: 6px 12px; border-radius: 6px; font-size: 12px;
    text-decoration: none; transition: all 0.2s; border: 1.5px solid;
    white-space: nowrap;
}
.prop-action-edit { border-color: #185FA5; color: #185FA5; }
.prop-action-edit:hover { background: #185FA5; color: #fff; }
.prop-action-view { border-color: #e8e3db; color: #888; }
.prop-action-view:hover { border-color: #C8873A; color: #C8873A; }

/* Status badge */
.status-pill {
    display: inline-block; font-size: 11px; font-weight: 500;
    padding: 3px 10px; border-radius: 20px;
}
.status-available { background: #eaf3de; color: #27500A; }
.status-rented    { background: #f0f0f0; color: #888; }
.status-pending   { background: #fff3e0; color: #e65100; }
.status-confirmed { background: #e6f1fb; color: #185FA5; }
.status-cancelled { background: #fff0f0; color: #dc3545; }
.status-done      { background: #eaf3de; color: #27500A; }

/* Right sidebar panels */
.side-panel {
    background: #fff; border: 1.5px solid #ede9e3;
    border-radius: 14px; padding: 22px; margin-bottom: 18px;
}
.side-panel-title { font-size: 14px; font-weight: 600; color: #1a1a1a; margin-bottom: 16px; }
.apt-item { display: flex; align-items: flex-start; gap: 12px; padding: 10px 0; border-bottom: 1px solid #f5f2ee; }
.apt-item:last-child { border-bottom: none; }
.apt-date {
    min-width: 48px; text-align: center; padding: 8px;
    background: #fdf6ee; border-radius: 8px; flex-shrink: 0;
}
.apt-date-day { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: #C8873A; line-height: 1; }
.apt-date-mo { font-size: 11px; color: #aaa; margin-top: 2px; }
.apt-info {}
.apt-prop { font-size: 13px; font-weight: 500; color: #1a1a1a; }
.apt-meta { font-size: 12px; color: #aaa; margin-top: 2px; }

/* Quick links */
.quick-links { display: flex; flex-direction: column; gap: 8px; }
.quick-link {
    display: flex; align-items: center; gap: 12px;
    padding: 12px 14px; border: 1.5px solid #ede9e3;
    border-radius: 10px; text-decoration: none;
    transition: all 0.2s; color: #444;
}
.quick-link:hover { border-color: #C8873A; color: #C8873A; background: #fdf6ee; }
.quick-link-icon { font-size: 18px; flex-shrink: 0; }
.quick-link-text { font-size: 13px; font-weight: 500; }
.quick-link-arrow { margin-left: auto; font-size: 16px; color: #ccc; }

/* Favoris cards */
.fav-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.fav-card {
    background: #fff; border: 1.5px solid #ede9e3; border-radius: 10px; overflow: hidden;
    text-decoration: none; display: block; transition: transform 0.2s;
}
.fav-card:hover { transform: translateY(-2px); }
.fav-img { height: 90px; background: #f0ede8; }
.fav-img img { width: 100%; height: 100%; object-fit: cover; }
.fav-img-ph { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; font-size: 28px; }
.fav-body { padding: 10px 12px; }
.fav-price { font-size: 14px; font-weight: 700; color: #C8873A; }
.fav-title { font-size: 12px; color: #555; margin-top: 2px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

/* Empty states */
.empty-dash { text-align: center; padding: 40px 20px; color: #aaa; font-size: 13px; }
.empty-dash span { font-size: 32px; display: block; margin-bottom: 10px; }
@endsection

@section('content')
<div class="dash-wrap">

    {{-- Header --}}
    <div class="dash-header">
        <div>
            <h1 class="dash-welcome">Bonjour, <span>{{ auth()->user()->name }}</span> 👋</h1>
            <p class="dash-sub">{{ now()->locale('fr')->isoFormat('dddd D MMMM YYYY') }} — Tableau de bord</p>
        </div>
        <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;">
            <span class="dash-role-badge">{{ auth()->user()->role_label }}</span>
            @can('create', \App\Models\Property::class)
            <a href="{{ route('properties.create') }}" class="dash-cta-btn">+ Publier un bien</a>
            @else
            <a href="{{ route('properties.index') }}" class="dash-cta-btn">🔍 Rechercher</a>
            @endcan
        </div>
    </div>

    {{-- Stats --}}
    <div class="stats-grid">
        @if(in_array(auth()->user()->role, ['agent','owner','admin']))
        <div class="stat-card">
            <div class="stat-icon">🏘️</div>
            <div class="stat-value">{{ $stats['my_properties'] ?? 0 }}</div>
            <div class="stat-label">Mes annonces</div>
            <div class="stat-sub">publiées</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">👁️</div>
            <div class="stat-value">{{ $stats['total_views'] ?? 0 }}</div>
            <div class="stat-label">Vues totales</div>
            <div class="stat-sub">sur mes biens</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">📅</div>
            <div class="stat-value">{{ $stats['appointments'] ?? 0 }}</div>
            <div class="stat-label">Rendez-vous</div>
            <div class="stat-sub">ce mois</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">💬</div>
            <div class="stat-value">{{ $stats['unread_messages'] ?? 0 }}</div>
            <div class="stat-label">Messages</div>
            <div class="stat-sub">non lus</div>
        </div>
        @else
        <div class="stat-card">
            <div class="stat-icon">❤️</div>
            <div class="stat-value">{{ $stats['favorites'] ?? 0 }}</div>
            <div class="stat-label">Favoris</div>
            <div class="stat-sub">sauvegardés</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">📅</div>
            <div class="stat-value">{{ $stats['appointments'] ?? 0 }}</div>
            <div class="stat-label">Visites</div>
            <div class="stat-sub">demandées</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">💬</div>
            <div class="stat-value">{{ $stats['messages'] ?? 0 }}</div>
            <div class="stat-label">Messages</div>
            <div class="stat-sub">envoyés</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">👁️</div>
            <div class="stat-value">{{ $stats['viewed'] ?? 0 }}</div>
            <div class="stat-label">Biens consultés</div>
            <div class="stat-sub">au total</div>
        </div>
        @endif
    </div>

    {{-- Main grid --}}
    <div class="dash-grid">

        {{-- COLONNE PRINCIPALE --}}
        <div>
            @if(in_array(auth()->user()->role, ['agent','owner','admin']))
            {{-- Mes annonces --}}
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                <div class="sec-title" style="margin-bottom:0;">Mes annonces récentes</div>
                <a href="{{ route('properties.create') }}" style="font-size:13px;color:#C8873A;text-decoration:none;">+ Nouvelle annonce</a>
            </div>
            <div class="prop-list">
                @forelse($myProperties as $prop)
                <div class="prop-list-item">
                    <div class="prop-list-thumb">
                        @if($prop->primaryImage)
                            <img src="{{ Storage::url($prop->primaryImage->image_path) }}" alt="">
                        @else
                            <div class="ph">🏠</div>
                        @endif
                    </div>
                    <div class="prop-list-info">
                        <div class="prop-list-title">{{ $prop->title }}</div>
                        <div class="prop-list-meta">📍 {{ $prop->city }} · 👁 {{ $prop->views_count ?? 0 }}</div>
                        <div class="prop-list-price">{{ number_format($prop->price, 0, ',', ' ') }} MAD/mois</div>
                    </div>
                    <div style="display:flex;flex-direction:column;align-items:flex-end;gap:8px;flex-shrink:0;">
                        <span class="status-pill status-{{ $prop->status }}">{{ $prop->status === 'available' ? 'Disponible' : 'Loué' }}</span>
                        <div class="prop-list-actions">
                            <a href="{{ route('properties.edit', $prop) }}" class="prop-action-btn prop-action-edit">✏️</a>
                            <a href="{{ route('properties.show', $prop) }}" class="prop-action-btn prop-action-view">👁</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="empty-dash">
                    <span>🏚️</span>
                    Aucune annonce publiée.<br>
                    <a href="{{ route('properties.create') }}" style="color:#C8873A;font-weight:500;">Publiez votre premier bien →</a>
                </div>
                @endforelse
            </div>
            @if(isset($myProperties) && method_exists($myProperties, 'hasMorePages') && $myProperties->hasMorePages())
            <div style="text-align:center;margin-top:16px;">
                <a href="{{ route('properties.index') }}" style="font-size:13px;color:#C8873A;text-decoration:none;">Voir toutes mes annonces →</a>
            </div>
            @endif

            @else
            {{-- Favoris pour client/étudiant --}}
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                <div class="sec-title" style="margin-bottom:0;">Mes favoris récents</div>
                <a href="{{ route('favorites.index') }}" style="font-size:13px;color:#C8873A;text-decoration:none;">Voir tout →</a>
            </div>
            @if(isset($favorites) && $favorites->count() > 0)
            <div class="fav-grid">
                @foreach($favorites->take(4) as $fav)
                @php $prop = $fav->property; @endphp
                <a href="{{ route('properties.show', $prop) }}" class="fav-card">
                    <div class="fav-img">
                        @if($prop->primaryImage)
                            <img src="{{ Storage::url($prop->primaryImage->image_path) }}" alt="">
                        @else
                            <div class="fav-img-ph">🏠</div>
                        @endif
                    </div>
                    <div class="fav-body">
                        <div class="fav-price">{{ number_format($prop->price, 0, ',', ' ') }} MAD</div>
                        <div class="fav-title">{{ $prop->title }}</div>
                    </div>
                </a>
                @endforeach
            </div>
            @else
            <div class="empty-dash">
                <span>❤️</span>
                Aucun favori pour le moment.<br>
                <a href="{{ route('properties.index') }}" style="color:#C8873A;font-weight:500;">Explorer les logements →</a>
            </div>
            @endif
            @endif

            {{-- Rendez-vous récents (commun) --}}
            <div style="margin-top:32px;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                    <div class="sec-title" style="margin-bottom:0;">Rendez-vous récents</div>
                    <a href="{{ route('appointments.index') }}" style="font-size:13px;color:#C8873A;text-decoration:none;">Tout voir →</a>
                </div>
                <div class="prop-list">
                    @forelse($upcomingAppointments ?? [] as $apt)
                    <div class="prop-list-item">
                        <div class="apt-date">
                            <div class="apt-date-day">{{ $apt->date ? $apt->date->format('d') : '—' }}</div>
                            <div class="apt-date-mo">{{ $apt->date ? $apt->date->locale('fr')->isoFormat('MMM') : '' }}</div>
                        </div>
                        <div class="prop-list-info">
                            <div class="prop-list-title">{{ $apt->property->title ?? 'Bien supprimé' }}</div>
                            <div class="prop-list-meta">
                                @if(in_array(auth()->user()->role, ['agent','owner','admin']))
                                    👤 {{ $apt->client->name ?? '—' }}
                                @else
                                    👤 {{ $apt->agent->name ?? '—' }}
                                @endif
                                · {{ $apt->time ?? '' }}
                            </div>
                        </div>
                        <span class="status-pill status-{{ $apt->status }}">
                            @switch($apt->status)
                                @case('pending')   En attente @break
                                @case('confirmed') Confirmé @break
                                @case('cancelled') Annulé @break
                                @case('done')      Effectué @break
                                @default {{ $apt->status }}
                            @endswitch
                        </span>
                    </div>
                    @empty
                    <div class="empty-dash">
                        <span>📅</span>
                        Aucun rendez-vous à venir.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- COLONNE DROITE --}}
        <div>
            {{-- Liens rapides --}}
            <div class="side-panel">
                <div class="side-panel-title">Navigation rapide</div>
                <div class="quick-links">
                    @if(in_array(auth()->user()->role, ['agent','owner','admin']))
                    <a href="{{ route('properties.create') }}" class="quick-link">
                        <span class="quick-link-icon">➕</span>
                        <span class="quick-link-text">Publier un bien</span>
                        <span class="quick-link-arrow">›</span>
                    </a>
                    @endif
                    <a href="{{ route('properties.index') }}" class="quick-link">
                        <span class="quick-link-icon">🏘️</span>
                        <span class="quick-link-text">Explorer les logements</span>
                        <span class="quick-link-arrow">›</span>
                    </a>
                    <a href="{{ route('favorites.index') }}" class="quick-link">
                        <span class="quick-link-icon">❤️</span>
                        <span class="quick-link-text">Mes favoris</span>
                        <span class="quick-link-arrow">›</span>
                    </a>
                    <a href="{{ route('appointments.index') }}" class="quick-link">
                        <span class="quick-link-icon">📅</span>
                        <span class="quick-link-text">Mes rendez-vous</span>
                        <span class="quick-link-arrow">›</span>
                    </a>
                    <a href="{{ route('messages.index') }}" class="quick-link">
                        <span class="quick-link-icon">💬</span>
                        <span class="quick-link-text">Messagerie
                            @if(($stats['unread_messages'] ?? 0) > 0)
                            <span style="background:#C8873A;color:#fff;font-size:10px;padding:1px 7px;border-radius:10px;margin-left:6px;">{{ $stats['unread_messages'] }}</span>
                            @endif
                        </span>
                        <span class="quick-link-arrow">›</span>
                    </a>
                    <a href="{{ route('profile.edit') }}" class="quick-link">
                        <span class="quick-link-icon">⚙️</span>
                        <span class="quick-link-text">Mon profil</span>
                        <span class="quick-link-arrow">›</span>
                    </a>
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.users') }}" class="quick-link" style="border-color:#dc3545;color:#dc3545;">
                        <span class="quick-link-icon">🛡️</span>
                        <span class="quick-link-text">Administration</span>
                        <span class="quick-link-arrow">›</span>
                    </a>
                    @endif
                </div>
            </div>

            {{-- Profil --}}
            <div class="side-panel">
                <div class="side-panel-title">Mon compte</div>
                <div style="display:flex;align-items:center;gap:14px;margin-bottom:14px;">
                    <div style="width:48px;height:48px;border-radius:50%;background:linear-gradient(135deg,#C8873A,#E8A855);display:flex;align-items:center;justify-content:center;font-size:18px;font-weight:700;color:#fff;flex-shrink:0;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div>
                        <div style="font-size:15px;font-weight:600;color:#1a1a1a;">{{ auth()->user()->name }}</div>
                        <div style="font-size:12px;color:#aaa;margin-top:2px;">{{ auth()->user()->email }}</div>
                        <div style="font-size:11px;color:#C8873A;margin-top:3px;font-weight:500;">{{ auth()->user()->role_label }}</div>
                    </div>
                </div>
                <a href="{{ route('profile.edit') }}"
                   style="display:block;text-align:center;padding:10px;border:1.5px solid #e8e3db;border-radius:8px;font-size:13px;color:#555;text-decoration:none;transition:all 0.2s;"
                   onmouseover="this.style.borderColor='#C8873A';this.style.color='#C8873A';"
                   onmouseout="this.style.borderColor='#e8e3db';this.style.color='#555';">
                    Modifier mon profil →
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
