@extends('layouts.app')
@section('title', 'Messages')

@section('content')
<div class="p-3 flex flex-col gap-3">

    <div>
        <h1 class="text-base font-medium text-white tracking-wider">Messages</h1>
        <p class="text-[10px] text-dark-muted tracking-wider mt-0.5">{{ $conversations->count() }} conversation(s)</p>
    </div>

    @if($conversations->isEmpty())
        <div class="bg-dark-card border border-dark-border rounded-sm p-8 text-center">
            <p class="text-dark-muted text-sm tracking-wider">Aucun message pour le moment.</p>
            <a href="{{ route('properties.index') }}" class="text-[10px] text-indigo-400 hover:text-indigo-300 mt-2 inline-block">Parcourir les logements</a>
        </div>
    @else
        <div class="flex flex-col gap-1.5">
            @foreach($conversations as $otherUserId => $lastMessage)
                @php
                    $me = auth()->id();
                    $other = $lastMessage->sender_id === $me ? $lastMessage->receiver : $lastMessage->sender;
                    $isUnread = ! $lastMessage->is_read && $lastMessage->receiver_id === $me;
                @endphp

                <a href="{{ route('messages.show', $other) }}"
                   class="bg-dark-card border {{ $isUnread ? 'border-indigo-800' : 'border-dark-border' }} rounded-sm p-3 flex items-center gap-3 hover:border-dark-border2 transition-colors">

                    {{-- Avatar --}}
                    <div class="w-9 h-9 rounded-sm bg-dark-card3 border border-dark-border flex items-center justify-center text-xs text-white shrink-0">
                        {{ strtoupper(substr($other->name, 0, 2)) }}
                    </div>

                    {{-- Contenu --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between gap-2">
                            <span class="text-xs {{ $isUnread ? 'text-white font-medium' : 'text-dark-text' }} tracking-wide truncate">
                                {{ $other->name }}
                            </span>
                            <span class="text-[10px] text-dark-dim shrink-0">
                                {{ $lastMessage->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <div class="flex items-center gap-2 mt-0.5">
                            <p class="text-[10px] text-dark-muted truncate flex-1">
                                @if($lastMessage->sender_id === $me) <span class="text-dark-dim">Vous : </span> @endif
                                {{ $lastMessage->message }}
                            </p>
                            @if($isUnread)
                                <span class="w-2 h-2 rounded-full bg-indigo-400 shrink-0"></span>
                            @endif
                        </div>
                        <p class="text-[9px] text-dark-dim mt-0.5 tracking-wider">{{ $other->role_label }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    @endif

</div>
@endsection
