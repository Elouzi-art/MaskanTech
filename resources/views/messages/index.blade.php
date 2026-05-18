@extends('layouts.maskan')
@section('title', 'MaskanTech — Messagerie')

@section('styles')
body { overflow: hidden; }
.msgs-wrap { display: flex; height: calc(100vh - 73px); }

/* SIDEBAR */
.msgs-sidebar {
    width: 320px; min-width: 320px;
    border-right: 1px solid #f0ede8;
    display: flex; flex-direction: column;
    background: #fff; overflow: hidden;
}
.msgs-header { padding: 24px 20px 16px; border-bottom: 1px solid #f0ede8; }
.msgs-title { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; color: #1a1a1a; margin-bottom: 14px; }
.msgs-search {
    width: 100%; padding: 10px 14px;
    border: 1.5px solid #e8e3db; border-radius: 8px;
    font-size: 13px; outline: none; transition: border-color 0.2s;
    font-family: 'DM Sans', sans-serif; box-sizing: border-box;
    background: #f8f7f4;
}
.msgs-search:focus { border-color: #C8873A; background: #fff; }

.conv-list { overflow-y: auto; flex: 1; }
.conv-item {
    display: flex; align-items: center; gap: 13px;
    padding: 16px 20px; cursor: pointer;
    border-bottom: 1px solid #f8f7f4; transition: background 0.15s;
    text-decoration: none;
}
.conv-item:hover { background: #fafaf8; }
.conv-item.active { background: #fdf6ee; border-left: 3px solid #C8873A; padding-left: 17px; }

.conv-avatar {
    width: 44px; height: 44px; border-radius: 50%; flex-shrink: 0;
    background: linear-gradient(135deg, #C8873A, #E8A855);
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; font-weight: 700; color: #fff;
}
.conv-avatar.blue { background: linear-gradient(135deg, #185FA5, #3a7fc1); }

.conv-info { flex: 1; min-width: 0; }
.conv-name { font-size: 14px; font-weight: 500; color: #1a1a1a; margin-bottom: 3px; }
.conv-preview { font-size: 12px; color: #888; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.conv-preview.unread { color: #1a1a1a; font-weight: 500; }

.conv-meta { text-align: right; flex-shrink: 0; }
.conv-time { font-size: 11px; color: #aaa; margin-bottom: 4px; }
.conv-unread-dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: #C8873A; margin-left: auto;
}

/* EMPTY STATE */
.msgs-empty {
    flex: 1; display: flex; flex-direction: column;
    align-items: center; justify-content: center; gap: 12px;
    background: #f8f7f4;
}
.msgs-empty-icon { font-size: 52px; }
.msgs-empty-title { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 700; color: #1a1a1a; }
.msgs-empty-sub { font-size: 14px; color: #888; text-align: center; max-width: 300px; line-height: 1.6; }
.msgs-empty-cta {
    margin-top: 8px; padding: 11px 24px;
    background: #1a1a1a; color: #fff; border-radius: 8px;
    font-size: 14px; font-weight: 500; text-decoration: none;
    transition: background 0.2s;
}
.msgs-empty-cta:hover { background: #C8873A; }

/* PLACEHOLDER (aucune conv sélectionnée) */
.chat-placeholder {
    flex: 1; display: flex; flex-direction: column;
    align-items: center; justify-content: center; gap: 10px;
    background: #f8f7f4;
}
.chat-placeholder-icon { font-size: 56px; }
.chat-placeholder-title { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; color: #1a1a1a; }
.chat-placeholder-sub { font-size: 13px; color: #888; }

/* RESPONSIVE */
@media(max-width: 640px) {
    .msgs-sidebar { width: 100%; min-width: 100%; }
    .chat-placeholder { display: none; }
}
@endsection

@section('content')
<div class="msgs-wrap">

    {{-- SIDEBAR : liste des conversations --}}
    <div class="msgs-sidebar">
        <div class="msgs-header">
            <div class="msgs-title">💬 Messages</div>
            <input type="text" class="msgs-search" placeholder="Rechercher une conversation..." id="convSearch">
        </div>

        <div class="conv-list" id="convList">
            {{--
                MessageController passe $conversations comme une Collection de Messages
                (un par interlocuteur, le dernier de chaque conversation), indexée par l'ID de l'autre user.
            --}}
            @forelse($conversations as $otherId => $lastMessage)
            @php
                $other  = $lastMessage->sender_id === auth()->id() ? $lastMessage->receiver : $lastMessage->sender;
                $unread = \App\Models\Message::where('sender_id', $other->id)
                    ->where('receiver_id', auth()->id())
                    ->where('is_read', false)->count();
            @endphp
            <a href="{{ route('messages.show', $other) }}" class="conv-item">
                <div class="conv-avatar {{ $other->isAgent() || $other->isAdmin() ? 'blue' : '' }}">
                    {{ strtoupper(substr($other->name, 0, 2)) }}
                </div>
                <div class="conv-info">
                    <div class="conv-name">{{ $other->name }}</div>
                    <div class="conv-preview {{ $unread > 0 ? 'unread' : '' }}">
                        @if($lastMessage->sender_id === auth()->id()) Vous : @endif
                        {{ Str::limit($lastMessage->message, 38) }}
                    </div>
                </div>
                <div class="conv-meta">
                    <div class="conv-time">
                        {{ $lastMessage->created_at->isToday()
                            ? $lastMessage->created_at->format('H:i')
                            : $lastMessage->created_at->format('d/m') }}
                    </div>
                    @if($unread > 0)
                        <div class="conv-unread-dot"></div>
                    @endif
                </div>
            </a>
            @empty
            <div style="padding: 48px 24px; text-align:center">
                <div style="font-size:36px;margin-bottom:12px">💬</div>
                <p style="font-size:14px;color:#888;line-height:1.6">
                    Aucune conversation.<br>Contactez un agent depuis une annonce.
                </p>
                <a href="{{ route('properties.index') }}"
                   style="display:inline-block;margin-top:16px;padding:10px 20px;background:#1a1a1a;color:#fff;border-radius:8px;font-size:13px;text-decoration:none;transition:background 0.2s"
                   onmouseover="this.style.background='#C8873A'" onmouseout="this.style.background='#1a1a1a'">
                    Voir les annonces →
                </a>
            </div>
            @endforelse
        </div>
    </div>

    {{-- ZONE DROITE : invite à sélectionner une conv --}}
    <div class="chat-placeholder">
        <div class="chat-placeholder-icon">✉️</div>
        <div class="chat-placeholder-title">Sélectionnez une conversation</div>
        <div class="chat-placeholder-sub">Cliquez sur un contact à gauche pour ouvrir la discussion.</div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.getElementById('convSearch')?.addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#convList .conv-item').forEach(item => {
        const name = item.querySelector('.conv-name')?.textContent.toLowerCase() || '';
        item.style.display = name.includes(q) ? '' : 'none';
    });
});
</script>
@endpush
