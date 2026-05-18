@extends('layouts.maskan')
@section('title', 'MaskanTech — Messages de contact')

@section('styles')
.contacts-wrap { max-width: 900px; margin: 0 auto; padding: 40px 24px; }
.contacts-title { font-family: 'Playfair Display', serif; font-size: 26px; font-weight: 700; color: #1a1a1a; margin-bottom: 4px; }
.contacts-count { font-size: 13px; color: #888; margin-bottom: 28px; }
.contact-card { background: #fff; border: 1px solid #ede9e3; border-radius: 12px; padding: 22px 24px; margin-bottom: 16px; transition: box-shadow 0.2s; }
.contact-card:hover { box-shadow: 0 6px 24px rgba(0,0,0,0.07); }
.contact-header { display: flex; justify-content: space-between; align-items: flex-start; gap: 16px; margin-bottom: 12px; }
.contact-name { font-size: 15px; font-weight: 600; color: #1a1a1a; }
.contact-meta { font-size: 12px; color: #888; margin-top: 3px; }
.contact-date { font-size: 12px; color: #aaa; white-space: nowrap; flex-shrink: 0; }
.contact-subject { font-size: 13px; font-weight: 500; color: #C8873A; margin-bottom: 10px; padding-left: 10px; border-left: 2px solid #C8873A; }
.contact-message { font-size: 14px; color: #555; line-height: 1.7; }
.empty-state { text-align: center; padding: 64px 24px; }
.empty-state p { font-size: 15px; color: #888; }
.pagination { display: flex; justify-content: center; gap: 6px; margin-top: 28px; }
.pagination a, .pagination span { padding: 8px 14px; border-radius: 8px; font-size: 13px; border: 1.5px solid #e8e3db; text-decoration: none; color: #555; transition: all 0.2s; }
.pagination a:hover { border-color: #C8873A; color: #C8873A; }
.pagination span.current { background: #1a1a1a; color: #fff; border-color: #1a1a1a; }
.pagination span.disabled { color: #ccc; }
.back-link { display: inline-flex; align-items: center; gap: 6px; font-size: 13px; color: #888; text-decoration: none; margin-bottom: 24px; transition: color 0.2s; }
.back-link:hover { color: #C8873A; }
@endsection

@section('content')
<div class="contacts-wrap">

    <a href="{{ route('dashboard') }}" class="back-link">← Retour au dashboard</a>

    <div class="contacts-title">Messages de contact</div>
    <div class="contacts-count">{{ $contacts->total() }} message(s) reçu(s)</div>

    @if($contacts->isEmpty())
        <div class="empty-state">
            <p>Aucun message de contact pour l'instant.</p>
        </div>
    @else
        @foreach($contacts as $contact)
        <div class="contact-card">
            <div class="contact-header">
                <div>
                    <div class="contact-name">{{ $contact->name }}</div>
                    <div class="contact-meta">
                        {{ $contact->email }}
                        @if($contact->phone) · {{ $contact->phone }} @endif
                    </div>
                </div>
                <div class="contact-date">{{ $contact->created_at->format('d/m/Y à H:i') }}</div>
            </div>
            @if($contact->subject)
                <div class="contact-subject">{{ $contact->subject }}</div>
            @endif
            <div class="contact-message">{{ $contact->message }}</div>
        </div>
        @endforeach

        @if($contacts->hasPages())
        <div class="pagination">
            @if($contacts->onFirstPage())
                <span class="disabled">←</span>
            @else
                <a href="{{ $contacts->previousPageUrl() }}">←</a>
            @endif
            @foreach($contacts->getUrlRange(max(1,$contacts->currentPage()-2), min($contacts->lastPage(),$contacts->currentPage()+2)) as $page => $url)
                @if($page == $contacts->currentPage())
                    <span class="current">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach
            @if($contacts->hasMorePages())
                <a href="{{ $contacts->nextPageUrl() }}">→</a>
            @else
                <span class="disabled">→</span>
            @endif
        </div>
        @endif
    @endif

</div>
@endsection
