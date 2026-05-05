@extends('layouts.app')
@section('title', 'Conversation avec ' . $user->name)

@section('content')
<div class="p-3 flex flex-col gap-3 h-full" style="height: calc(100vh - 44px);">

    {{-- Header conversation --}}
    <div class="flex items-center gap-3 pb-3 border-b border-dark-border">
        <a href="{{ route('messages.index') }}" class="text-[10px] text-dark-muted hover:text-dark-text transition-colors tracking-wider">← RETOUR</a>
        <div class="w-8 h-8 rounded-sm bg-dark-card3 border border-dark-border flex items-center justify-center text-xs text-white">
            {{ strtoupper(substr($user->name, 0, 2)) }}
        </div>
        <div>
            <p class="text-xs text-white font-medium tracking-wide">{{ $user->name }}</p>
            <p class="text-[10px] text-dark-muted tracking-wider">{{ $user->role_label }}</p>
        </div>
    </div>

    {{-- Messages --}}
    <div class="flex-1 flex flex-col gap-2 overflow-y-auto" id="messages-container" style="max-height: calc(100vh - 200px);">
        @if($messages->isEmpty())
            <div class="text-center py-8">
                <p class="text-dark-muted text-[11px] tracking-wider">Démarrez la conversation.</p>
            </div>
        @else
            @foreach($messages as $message)
            @php $isMe = $message->sender_id === auth()->id(); @endphp
            <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-xs {{ $isMe ? 'bg-indigo-950 border-indigo-800' : 'bg-dark-card border-dark-border' }} border rounded-sm p-2.5">
                    @if($message->property_id && $message->property)
                        <a href="{{ route('properties.show', $message->property) }}"
                           class="block text-[9px] text-indigo-400 tracking-wider border-b border-current border-opacity-30 pb-1 mb-1.5 hover:text-indigo-300">
                            re: {{ $message->property->title }}
                        </a>
                    @endif
                    <p class="text-xs text-dark-text leading-relaxed">{{ $message->message }}</p>
                    <p class="text-[9px] text-dark-dim mt-1 {{ $isMe ? 'text-right' : '' }}">
                        {{ $message->created_at->format('d/m H:i') }}
                    </p>
                </div>
            </div>
            @endforeach
        @endif
    </div>

    {{-- Formulaire d'envoi --}}
    <form method="POST" action="{{ route('messages.store') }}" class="flex gap-2 pt-3 border-t border-dark-border">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $user->id }}">

        <textarea name="message" rows="2" required
                  placeholder="Écrire un message..."
                  class="flex-1 bg-dark-card3 border border-dark-border text-dark-text text-xs px-2.5 py-2 rounded-sm placeholder-dark-dim focus:outline-none focus:border-indigo-700 font-mono resize-none">{{ old('message') }}</textarea>

        <button type="submit"
                class="text-xs border border-indigo-700 text-indigo-400 hover:bg-indigo-950 px-4 py-2 rounded-sm transition-colors tracking-wider font-mono self-end">
            ENVOYER
        </button>
    </form>
    @error('message') <p class="text-red-400 text-[10px]">{{ $message }}</p> @enderror
</div>

@push('scripts')
<script>
    // Scroll vers le bas à l'ouverture
    const container = document.getElementById('messages-container');
    if (container) container.scrollTop = container.scrollHeight;
</script>
@endpush
@endsection
