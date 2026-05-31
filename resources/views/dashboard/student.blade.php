@extends('dashboard.layout')

@section('title', 'MaskanTech — Dashboard Étudiant')

@section('dashboard-content')

<div class="dash-header">
    <div class="dash-title">Bonjour, {{ auth()->user()->name }} 🎓</div>
    <div class="dash-subtitle">Voici un résumé de votre activité étudiante sur MaskanTech.</div>
</div>

{{-- BADGE ÉTUDIANT --}}
<div style="background:linear-gradient(135deg,#185FA5,#0d3d6e);border-radius:12px;padding:20px 24px;margin-bottom:28px;display:flex;align-items:center;justify-content:space-between;">
    <div style="display:flex;align-items:center;gap:16px;">
        <div style="font-size:32px;">🎓</div>
        <div>
            <div style="font-size:15px;font-weight:600;color:#fff;">Compte Étudiant</div>
            <div style="font-size:13px;color:rgba(255,255,255,0.6);margin-top:4px;">Vous avez accès aux annonces exclusives étudiants</div>
        </div>
    </div>
    <a href="{{ route('properties.index', ['audience' => 'student']) }}" style="background:rgba(255,255,255,0.15);color:#fff;padding:10px 20px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:500;">
        Voir les annonces étudiants →
    </a>
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

{{-- ANNONCES ÉTUDIANTS RECOMMANDÉES --}}
@php
    $studentProperties = \App\Models\Property::where('target_audience', 'student')
        ->where('status', 'available')
        ->limit(5)->get();
@endphp
<div class="dash-section">
    <div class="dash-section-header">
        <div class="dash-section-title">Annonces étudiants disponibles</div>
        <a href="{{ route('properties.index') }}" class="dash-section-link">Voir toutes →</a>
    </div>

    @if($studentProperties->isEmpty())
        <div class="dash-empty">
            <div class="dash-empty-icon">🎓</div>
            <div class="dash-empty-text">Aucune annonce étudiant disponible pour le moment</div>
        </div>
    @else
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
                @foreach($studentProperties as $property)
                <tr>
                    <td>🎓 {{ $property->title }}</td>
                    <td>{{ $property->city }}</td>
                    <td>{{ number_format($property->price, 0, ',', ' ') }} MAD/mois</td>
                    <td><span class="mk-badge mk-badge-blue">Étudiant</span></td>
                    <td><a href="{{ route('properties.show', $property) }}" style="color:#C8873A;font-size:13px;">Voir →</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

{{-- FAVORIS --}}
<div class="dash-section">
    <div class="dash-section-header">
        <div class="dash-section-title">Mes favoris</div>
        <a href="{{ route('favorites.index') }}" class="dash-section-link">Voir tous →</a>
    </div>

    @if($favorites->isEmpty())
        <div class="dash-empty">
            <div class="dash-empty-icon">❤️</div>
            <div class="dash-empty-text">Aucun favori pour le moment</div>
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
                        @else
                            <span class="mk-badge mk-badge-gold">Loué</span>
                        @endif
                    </td>
                    <td><a href="{{ route('properties.show', $property) }}" style="color:#C8873A;font-size:13px;">Voir →</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

{{-- RENDEZ-VOUS --}}
<div class="dash-section">
    <div class="dash-section-header">
        <div class="dash-section-title">Mes rendez-vous</div>
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
                    <th>Propriétaire</th>
                    <th>Date</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach($myAppointments as $apt)
                <tr>
                    <td>🏠 {{ $apt->property->title }}</td>
                    <td>{{ $apt->agent->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($apt->date)->format('d/m/Y') }} à {{ $apt->time }}</td>
                    <td>
                        @if($apt->status === 'confirmed')
                            <span class="mk-badge mk-badge-green">Confirmé</span>
                        @elseif($apt->status === 'pending')
                            <span class="mk-badge mk-badge-gold">En attente</span>
                        @elseif($apt->status === 'refused')
                            <span class="mk-badge" style="background:#fee;color:#c00;">Refusé</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection