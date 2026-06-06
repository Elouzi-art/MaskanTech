@extends('layouts.admin')
@section('title', 'Messages de contact')

@section('content')
<div class="p-4 flex flex-col gap-4">

    <div>
        <h1 class="text-sm font-medium text-white tracking-widest">MESSAGES DE CONTACT</h1>
        <p class="text-[10px] text-dark-muted tracking-wider mt-0.5">{{ $contacts->total() }} message(s) reçu(s)</p>
    </div>

    @if($contacts->isEmpty())
        <div class="bg-dark-card border border-dark-border rounded-sm p-10 text-center">
            <p class="text-dark-muted text-[11px] tracking-wider">Aucun message de contact.</p>
        </div>
    @else
        <div class="flex flex-col gap-2">
            @foreach($contacts as $contact)
            <div class="bg-dark-card border border-dark-border rounded-sm p-3 flex flex-col gap-2 hover:border-dark-border2 transition-colors">
                <div class="flex items-start justify-between gap-3">
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded-sm bg-dark-card3 border border-dark-border flex items-center justify-center text-[10px] text-white shrink-0">
                            {{ strtoupper(substr($contact->name, 0, 2)) }}
                        </div>
                        <div>
                            <p class="text-[11px] text-white tracking-wide">{{ $contact->name }}</p>
                            <p class="text-[9px] text-dark-muted">{{ $contact->email }}</p>
                            @if($contact->phone)
                                <p class="text-[9px] text-dark-dim">{{ $contact->phone }}</p>
                            @endif
                        </div>
                    </div>
                    <p class="text-[9px] text-dark-dim shrink-0 mt-0.5">{{ $contact->created_at->format('d/m/Y H:i') }}</p>
                </div>
                @if($contact->subject)
                    <p class="text-[10px] text-indigo-300 tracking-wider border-l-2 border-indigo-800 pl-2">{{ $contact->subject }}</p>
                @endif
                <p class="text-[11px] text-dark-muted leading-relaxed">{{ $contact->message }}</p>
                <div class="flex gap-2 pt-1 border-t border-dark-border">
                    <a href="mailto:{{ $contact->email }}"
                       class="text-[10px] text-indigo-400 hover:text-indigo-300 transition-colors tracking-wider">RÉPONDRE →</a>
                </div>
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