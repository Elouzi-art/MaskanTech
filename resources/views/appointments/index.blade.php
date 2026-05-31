@extends('dashboard.layout')

@section('title', 'MaskanTech — Rendez-vous')

@section('dashboard-content')

<div class="dash-header">
    <div class="dash-title">Rendez-vous 📅</div>
    <div class="dash-subtitle">{{ $appointments->total() }} rendez-vous au total</div>
</div>

@if(session('success'))
    <div style="background:#eaf3de;color:#27500A;padding:14px 20px;border-radius:10px;margin-bottom:24px;font-size:14px;">
        ✅ {{ session('success') }}
    </div>
@endif

<div class="dash-section">
    <div class="dash-section-header">
        <div class="dash-section-title">Mes rendez-vous</div>
    </div>

    @if($appointments->isEmpty())
        <div class="dash-empty">
            <div class="dash-empty-icon">📅</div>
            <div class="dash-empty-text">Aucun rendez-vous pour le moment</div>
            <a href="{{ route('properties.index') }}" class="mk-btn-gold">Chercher un logement</a>
        </div>
    @else
        <table class="dash-table">
            <thead>
                <tr>
                    <th>Logement</th>
                    <th>{{ auth()->user()->role === 'agent' ? 'Client' : 'Agent' }}</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $apt)
                <tr>
                    <td>
                        <a href="{{ route('properties.show', $apt->property) }}" style="color:#C8873A;text-decoration:none;">
                            🏠 {{ Str::limit($apt->property->title, 30) }}
                        </a>
                    </td>
                    <td>
                        @if(auth()->user()->role === 'agent')
                            👤 {{ $apt->client->name }}
                        @else
                            👤 {{ $apt->agent->name }}
                        @endif
                    </td>
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
                    <td>
                        {{-- Agent peut confirmer/refuser --}}
                        @if(auth()->user()->role === 'agent' && $apt->status === 'pending')
                            <form action="{{ route('appointments.status', $apt) }}" method="POST" style="display:inline;">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="confirmed">
                                <button type="submit" style="background:#eaf3de;color:#27500A;border:none;padding:5px 10px;border-radius:6px;font-size:12px;cursor:pointer;margin-right:4px;">
                                    ✅ Confirmer
                                </button>
                            </form>
                            <form action="{{ route('appointments.status', $apt) }}" method="POST" style="display:inline;">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="refused">
                                <button type="submit" style="background:#fee;color:#c00;border:none;padding:5px 10px;border-radius:6px;font-size:12px;cursor:pointer;">
                                    ❌ Refuser
                                </button>
                            </form>
                        @endif
                        {{-- Client peut annuler si pending --}}
                        @if(auth()->user()->role !== 'agent' && $apt->status === 'pending')
                            <form action="{{ route('appointments.destroy', $apt) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" style="background:#fee;color:#c00;border:none;padding:5px 10px;border-radius:6px;font-size:12px;cursor:pointer;">
                                    Annuler
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top:24px;">
            {{ $appointments->links() }}
        </div>
    @endif
</div>

@endsection