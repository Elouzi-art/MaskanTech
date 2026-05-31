@extends('dashboard.layout')

@section('title', 'MaskanTech — Mon Dashboard')

@section('dashboard-content')

{{-- HEADER --}}
<div class="dash-header">
    <div class="dash-title">Bonjour, {{ auth()->user()->name }} 👋</div>
    <div class="dash-subtitle">Voici un résumé de votre activité sur MaskanTech.</div>
</div>

{{-- STATS --}}
<div class="dash-stats">
    <div class="dash-stat-card">
        <div class="dash-stat-icon">❤️</div>
        <div class="dash-stat-value">{{ $stats['favorites'] }}</div>
        <div class="dash-stat-label">Favoris</div>
        <div class="dash-stat-change">biens sauvegardés</div>
    </div>
    <div class="dash-stat-card">
        <div class="dash-stat-icon">💬</div>
        <div class="dash-stat-value">{{ $stats['messages'] }}</div>
        <div class="dash-stat-label">Messages</div>
        <div class="dash-stat-change">envoyés</div>
    </div>
    <div class="dash-stat-card">
        <div class="dash-stat-icon">📅</div>
        <div class="dash-stat-value">{{ $stats['appointments'] }}</div>
        <div class="dash-stat-label">Rendez-vous</div>
        <div class="dash-stat-change">demandes effectuées</div>
    </div>
    <div class="dash-stat-card">
        <div class="dash-stat-icon">👁️</div>
        <div class="dash-stat-value">{{ $stats['viewed'] }}</div>
        <div class="dash-stat-label">Annonces vues</div>
        <div class="dash-stat-change">récemment consultées</div>
    </div>
</div>

{{-- FAVORIS --}}
<div class="dash-section">
    <div class="dash-section-header">
        <div class="dash-section-title">Mes favoris récents</div>
        <a href="{{ route('favorites.index') }}" class="dash-section-link">Voir tous →</a>
    </div>

    @if($favorites->isEmpty())
        <div class="dash-empty">
            <div class="dash-empty-icon">❤️</div>
            <div class="dash-empty-text">Vous n'avez pas encore de favoris</div>
            <a href="{{ route('properties.index') }}" class="mk-btn-gold">Explorer les biens</a>
        </div>
    @else
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
                @foreach($favorites as $property)
                <tr>
                    <td>🏠 {{ $property->title }}</td>
                    <td>{{ $property->city }}</td>
                    <td>{{ number_format($property->price, 0, ',', ' ') }} MAD/mois</td>
                    <td>
                        @if($property->status === 'available')
                            <span class="mk-badge mk-badge-green">Disponible</span>
                        @elseif($property->status === 'rented')
                            <span class="mk-badge mk-badge-gold">Loué</span>
                        @else
                            <span class="mk-badge">{{ $property->status }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('properties.show', $property) }}" style="color:#C8873A;font-size:13px;">Voir →</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

{{-- RENDEZ-VOUS --}}
<div class="dash-section">
    <div class="dash-section-header">
        <div class="dash-section-title">Prochains rendez-vous</div>
        <a href="{{ route('appointments.index') }}" class="dash-section-link">Voir tous →</a>
    </div>

    @if($myAppointments->isEmpty())
        <div class="dash-empty">
            <div class="dash-empty-icon">📅</div>
            <div class="dash-empty-text">Aucun rendez-vous pour le moment</div>
        </div>
    @else
        <table class="dash-table">
            <thead>
                <tr>
                    <th>Logement</th>
                    <th>Agent</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach($myAppointments as $apt)
                <tr>
                    <td>🏠 {{ $apt->property->title }}</td>
                    <td>{{ $apt->agent->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($apt->date)->format('d/m/Y') }}</td>
                    <td>{{ $apt->time }}</td>
                    <td>
                        @if($apt->status === 'confirmed')
                            <span class="mk-badge mk-badge-green">Confirmé</span>
                        @elseif($apt->status === 'pending')
                            <span class="mk-badge mk-badge-gold">En attente</span>
                        @elseif($apt->status === 'refused')
                            <span class="mk-badge" style="background:#fee;color:#c00;">Refusé</span>
                        @elseif($apt->status === 'completed')
                            <span class="mk-badge mk-badge-blue">Terminé</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

{{-- CONSULTÉS RÉCEMMENT --}}
<div class="dash-section">
    <div class="dash-section-header">
        <div class="dash-section-title">Consultés récemment</div>
        <a href="{{ route('properties.index') }}" class="dash-section-link">Explorer →</a>
    </div>

    @if($recentlyViewed->isEmpty())
        <div class="dash-empty">
            <div class="dash-empty-icon">👁️</div>
            <div class="dash-empty-text">Aucune consultation récente</div>
            <a href="{{ route('properties.index') }}" class="mk-btn-gold">Voir les annonces</a>
        </div>
    @else
        <table class="dash-table">
            <thead>
                <tr>
                    <th>Logement</th>
                    <th>Ville</th>
                    <th>Prix</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentlyViewed as $property)
                <tr>
                    <td>🏠 {{ $property->title }}</td>
                    <td>{{ $property->city }}</td>
                    <td>{{ number_format($property->price, 0, ',', ' ') }} MAD/mois</td>
                    <td>
                        <a href="{{ route('properties.show', $property) }}" style="color:#C8873A;font-size:13px;">Voir →</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection