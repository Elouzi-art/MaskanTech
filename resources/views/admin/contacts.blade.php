@extends('layouts.app')
@section('title', 'Messages de contact')

@section('content')
<div class="p-3 flex flex-col gap-3">

    <div>
        <h1 class="text-base font-medium text-white tracking-wider">Messages de contact</h1>
        <p class="text-[10px] text-dark-muted tracking-wider mt-0.5">{{ $contacts->total() }} message(s) reçu(s)</p>
    </div>

    @if($contacts->isEmpty())
        <div class="bg-dark-card border border-dark-border rounded-sm p-8 text-center">
            <p class="text-dark-muted text-sm tracking-wider">Aucun message de contact.</p>
        </div>
    @else
        <div class="flex flex-col gap-2">
            @foreach($contacts as $contact)
            <div class="bg-dark-card border border-dark-border rounded-sm p-3 flex flex-col gap-2">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-xs text-white font-medium tracking-wide">{{ $contact->name }}</p>
                        <p class="text-[10px] text-dark-muted">{{ $contact->email }}</p>
                        @if($contact->phone)
                            <p class="text-[10px] text-dark-muted">{{ $contact->phone }}</p>
                        @endif
                    </div>
                    <p class="text-[10px] text-dark-dim shrink-0">{{ $contact->created_at->format('d/m/Y H:i') }}</p>
                </div>
                @if($contact->subject)
                    <p class="text-[10px] text-dark-text tracking-wider border-l-2 border-indigo-800 pl-2">{{ $contact->subject }}</p>
                @endif
                <p class="text-xs text-dark-muted leading-relaxed">{{ $contact->message }}</p>
            </div>
            @endforeach
        </div>

        @if($contacts->hasPages())
        <div class="flex justify-center gap-1">
            @if(!$contacts->onFirstPage())
                <a href="{{ $contacts->previousPageUrl() }}" class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border rounded-sm hover:border-dark-border2 hover:text-dark-text transition-colors">←</a>
            @endif
            @if($contacts->hasMorePages())
                <a href="{{ $contacts->nextPageUrl() }}" class="px-3 py-1.5 text-[10px] text-dark-muted border border-dark-border rounded-sm hover:border-dark-border2 hover:text-dark-text transition-colors">→</a>
            @endif
        </div>
        @endif
    @endif

</div>
@endsection
