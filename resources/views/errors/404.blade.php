@extends('layouts.maskan')

@section('title', 'MaskanTech — Page introuvable')

@section('styles')
.error-wrap {
    min-height: 70vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 80px 48px;
}
.error-number {
    font-family: 'Playfair Display', serif;
    font-size: 120px;
    font-weight: 700;
    color: #C8873A;
    line-height: 1;
    margin-bottom: 16px;
}
.error-title {
    font-family: 'Playfair Display', serif;
    font-size: 32px;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 12px;
}
.error-sub {
    font-size: 15px;
    color: #888;
    line-height: 1.7;
    max-width: 400px;
    margin: 0 auto 36px;
}
.error-btns {
    display: flex;
    gap: 12px;
    justify-content: center;
}
@endsection

@section('content')
<div class="error-wrap">
    <div>
        <div class="error-number">404</div>
        <div class="error-title">Page introuvable</div>
        <p class="error-sub">
            Oops ! La page que vous cherchez n'existe pas ou a été déplacée.
        </p>
        <div class="error-btns">
            <a href="/" class="mk-btn-dark">Retour à l'accueil</a>
            <a href="/biens" class="mk-btn-outline">Voir les logements</a>
        </div>
    </div>
</div>
@endsection