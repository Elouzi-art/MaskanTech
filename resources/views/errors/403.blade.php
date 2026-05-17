@extends('layouts.maskan')

@section('title', 'Accès refusé — MaskanTech')

@section('styles')
.error-wrap {
    min-height: 70vh; display: flex; align-items: center;
    justify-content: center; padding: 60px 20px; text-align: center;
}
.error-card { max-width: 500px; width: 100%; }
.error-code {
    font-family: 'Playfair Display', serif;
    font-size: 100px; font-weight: 700; color: #f0ede8;
    line-height: 1; margin-bottom: 24px;
}
.error-title { font-family: 'Playfair Display', serif; font-size: 28px; font-weight: 700; color: #1a1a1a; margin-bottom: 12px; }
.error-sub { font-size: 15px; color: #888; margin-bottom: 32px; line-height: 1.7; }
@endsection

@section('content')
<div class="error-wrap">
    <div class="error-card">
        <div class="error-code">403</div>
        <h1 class="error-title">Accès refusé</h1>
        <p class="error-sub">Vous n'avez pas les droits nécessaires pour accéder à cette page.</p>
        <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
            <a href="{{ route('home') }}" class="mk-btn-gold">Retour à l'accueil</a>
            <a href="{{ route('dashboard') }}" class="mk-btn-outline">Mon dashboard</a>
        </div>
    </div>
</div>
@endsection
