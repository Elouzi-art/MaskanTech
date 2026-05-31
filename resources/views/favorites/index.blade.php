@extends('dashboard.layout')

@section('title', 'MaskanTech — Mes favoris')

@section('dashboard-content')

<div class="dash-header">
    <div class="dash-title">Mes favoris ❤️</div>
    <div class="dash-subtitle">{{ $favorites->total() }} logement(s) sauvegardé(s)</div>
</div>

<div class="dash-section">
    <div class="dash-section-header">
        <div class="dash-section-title">Mes logements favoris</div>
        <a href="{{ route('properties.index') }}" class="dash-section-link">Explorer les biens →</a>
    </div>

    @if($favorites->isEmpty())
        <div class="dash-empty">
            <div class="dash-empty-icon">❤️</div>
            <div class="dash-empty-text">Aucun favori pour le moment</div>
            <a href="{{ route('properties.index') }}" class="mk-btn-gold">Parcourir les logements</a>
        </div>
    @else
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;">
            @foreach($favorites as $property)
            <div style="border-radius:12px;overflow:hidden;border:1px solid #ede9e3;background:#fff;transition:transform 0.25s,box-shadow 0.25s;" onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 16px 40px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='';this.style.boxShadow=''">

                {{-- IMAGE --}}
                <div style="height:180px;background-size:cover;background-position:center;background-color:#f0ede8;position:relative;
                    @if($property->primaryImage) background-image:url('{{ Storage::url($property->primaryImage->image_path) }}') @endif
                ">
                    <div style="position:absolute;top:12px;left:12px;">
                        <span style="background:#fff;font-size:11px;padding:4px 10px;border-radius:20px;font-weight:500;">
                            {{ ucfirst($property->type) }}
                        </span>
                    </div>
                    {{-- BOUTON RETIRER --}}
                    <form action="{{ route('favorites.toggle', $property) }}" method="POST" style="position:absolute;top:12px;right:12px;">
                        @csrf
                        <button type="submit" style="width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,0.9);border:none;cursor:pointer;font-size:16px;display:flex;align-items:center;justify-content:center;">
                            ❤️
                        </button>
                    </form>
                </div>

                {{-- BODY --}}
                <div style="padding:18px 20px;">
                    <div style="font-family:'Playfair Display',serif;font-size:20px;font-weight:700;color:#C8873A;">
                        {{ number_format($property->price, 0, ',', ' ') }} MAD
                        <span style="font-size:13px;font-family:'DM Sans',sans-serif;font-weight:300;color:#999;">/ mois</span>
                    </div>
                    <div style="font-size:15px;font-weight:500;color:#1a1a1a;margin:6px 0 4px;">{{ $property->title }}</div>
                    <div style="font-size:13px;color:#999;margin-bottom:12px;">📍 {{ $property->city }}</div>
                    <div style="display:flex;gap:8px;">
                        @if($property->bedrooms)
                            <span style="font-size:12px;color:#666;">🛏 {{ $property->bedrooms }} ch.</span>
                        @endif
                        @if($property->area)
                            <span style="font-size:12px;color:#666;">📐 {{ (int)$property->area }}m²</span>
                        @endif
                    </div>
                    <div style="margin-top:14px;display:flex;gap:8px;">
                        <a href="{{ route('properties.show', $property) }}" style="flex:1;padding:10px;background:#1a1a1a;color:#fff;border-radius:7px;font-size:13px;font-weight:500;text-align:center;text-decoration:none;transition:background 0.2s;" onmouseover="this.style.background='#C8873A'" onmouseout="this.style.background='#1a1a1a'">
                            Voir le détail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div style="margin-top:32px;display:flex;justify-content:center;">
            {{ $favorites->links() }}
        </div>
    @endif
</div>

@endsection