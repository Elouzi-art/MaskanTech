@extends('dashboard.layout')

@section('title', 'MaskanTech — Dashboard Propriétaire')

@section('dashboard-content')

<div class="dash-header">
    <div class="dash-title">Bonjour, {{ auth()->user()->name }} 🏠</div>
    <div class="dash-subtitle">Gérez vos annonces et suivez vos performances.</div>
</div>

{{-- STATS --}}
<div class="dash-stats">
    <div class="dash-stat-card">
        <div class="dash-stat-icon">📋</div>
        <div class="dash-stat-value">{{ $stats['my_properties'] }}</div>
        <div class="dash-stat-label">Mes annonces</div>
        <div class="dash-stat-change">publiées</div>
    </div>
    <div class="dash-stat-card">
        <div class="dash-stat-icon">👁️</div>
        <div class="dash-stat-value">{{ $stats['total_views'] }}</div>
        <div class="dash-stat-label">Vues totales</div>
        <div class="dash-stat-change">sur mes annonces</div>
    </div>
    <div class="dash-stat-card">
        <div class="dash-stat-icon">📅</div>
        <div class="dash-stat-value">{{ $stats['appointments'] }}</div>
        <div class="dash-stat-label">Rendez-vous</div>
        <div class="dash-stat-change">reçus</div>
    </div>
    <div class="dash-stat-card">
        <div class="dash-stat-icon">💬</div>
        <div class="dash-stat-value">{{ $stats['unread_messages'] }}</div>
        <div class="dash-stat-label">Messages</div>
        <div class="dash-stat-change">non lus</div>
    </div>
</div>

{{-- MES ANNONCES --}}
<div class="dash-section">
    <div class="dash-section-header">
        <div class="dash-section-title">Mes annonces</div>
        <a href="{{ route('properties.create') }}" class="dash-section-link">+ Publier une annonce</a>
    </div>

    @if($myProperties->isEmpty())
        <div class="dash-empty">
            <div class="dash-empty-icon">📋</div>
            <div class="dash-empty-text">Aucune annonce publiée</div>
            <a href="{{ route('properties.create') }}" class="mk-btn-gold">Publier mon premier bien</a>
        </div>
    @else
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
                @foreach($myProperties as $property)
                <tr>
                    <td>🏠 {{ Str::limit($property->title, 35) }}</td>
                    <td>{{ $property->city }}</td>
                    <td>{{ number_format($property->price, 0, ',', ' ') }} MAD</td>
                    <td>{{ $property->views_count }}</td>
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
                        <a href="{{ route('properties.show', $property) }}" style="color:#C8873A;font-size:13px;margin-right:12px;">Voir</a>
                        <a href="{{ route('properties.edit', $property) }}" style="color:#888;font-size:13px;margin-right:12px;">Modifier</a>
                        <form action="{{ route('properties.destroy', $property) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" style="color:#c00;font-size:13px;background:none;border:none;cursor:pointer;"
                                onclick="return confirm('Supprimer cette annonce ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top:16px;">{{ $myProperties->links() }}</div>
    @endif
</div>

{{-- RENDEZ-VOUS À VENIR --}}
<div class="dash-section">
    <div class="dash-section-header">
        <div class="dash-section-title">Rendez-vous à venir</div>
        <a href="{{ route('appointments.index') }}" class="dash-section-link">Voir tous →</a>
    </div>

    @if($upcomingAppointments->isEmpty())
        <div class="dash-empty">
            <div class="dash-empty-icon">📅</div>
            <div class="dash-empty-text">Aucun rendez-vous à venir</div>
        </div>
    @else
        <table class="dash-table">
            <thead>
                <tr>
                    <th>Logement</th>
                    <th>Client</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($upcomingAppointments as $apt)
                <tr>
                    <td>🏠 {{ Str::limit($apt->property->title, 30) }}</td>
                    <td>👤 {{ $apt->client->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($apt->date)->format('d/m/Y') }}</td>
                    <td>{{ $apt->time }}</td>
                    <td>
                        @if($apt->status === 'confirmed')
                            <span class="mk-badge mk-badge-green">Confirmé</span>
                        @elseif($apt->status === 'pending')
                            <span class="mk-badge mk-badge-gold">En attente</span>
                        @elseif($apt->status === 'refused')
                            <span class="mk-badge" style="background:#fee;color:#c00;">Refusé</span>
                        @endif
                    </td>
                    <td>
                        @if($apt->status === 'pending')
                            <form action="{{ route('appointments.status', $apt) }}" method="POST" style="display:inline;">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="confirmed">
                                <button type="submit" style="background:#eaf3de;color:#27500A;border:none;padding:5px 10px;border-radius:6px;font-size:12px;cursor:pointer;margin-right:4px;">✅ Confirmer</button>
                            </form>
                            <form action="{{ route('appointments.status', $apt) }}" method="POST" style="display:inline;">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="refused">
                                <button type="submit" style="background:#fee;color:#c00;border:none;padding:5px 10px;border-radius:6px;font-size:12px;cursor:pointer;">❌ Refuser</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

{{-- MESSAGES RÉCENTS --}}
<div class="dash-section">
    <div class="dash-section-header">
        <div class="dash-section-title">Messages récents</div>
        <a href="{{ route('messages.index') }}" class="dash-section-link">Voir tous →</a>
    </div>

    @if($recentMessages->isEmpty())
        <div class="dash-empty">
            <div class="dash-empty-icon">💬</div>
            <div class="dash-empty-text">Aucun message reçu</div>
        </div>
    @else
        <table class="dash-table">
            <thead>
                <tr>
                    <th>Expéditeur</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentMessages as $message)
                <tr>
                    <td>👤 {{ $message->sender->name }}</td>
                    <td style="color:#888;font-style:italic;">{{ Str::limit($message->message, 50) }}</td>
                    <td>{{ $message->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('messages.show', $message->sender) }}" style="color:#C8873A;font-size:13px;">Répondre →</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection