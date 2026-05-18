@extends('layouts.maskan')
@section('title', 'Conversation — ' . $user->name)

@section('styles')
body { overflow: hidden; }
.chat-wrap { display: flex; height: calc(100vh - 73px); }

/* SIDEBAR conversations */
.conv-sidebar {
    width: 300px; min-width: 300px;
    border-right: 1px solid #f0ede8;
    display: flex; flex-direction: column;
    background: #fff; overflow: hidden;
}
.conv-header { padding: 20px; border-bottom: 1px solid #f0ede8; }
.conv-title { font-family: 'Playfair Display', serif; font-size: 18px; font-weight: 700; color: #1a1a1a; margin-bottom: 10px; }
.conv-search { width: 100%; padding: 9px 13px; border: 1.5px solid #e8e3db; border-radius: 8px; font-size: 13px; outline: none; transition: border-color 0.2s; font-family: 'DM Sans', sans-serif; box-sizing: border-box; }
.conv-search:focus { border-color: #C8873A; }
.conv-list { overflow-y: auto; flex: 1; }
.conv-item { display: flex; align-items: center; gap: 12px; padding: 14px 18px; cursor: pointer; border-bottom: 1px solid #f8f7f4; transition: background 0.15s; text-decoration: none; }
.conv-item:hover { background: #fafaf8; }
.conv-item.active { background: #fdf6ee; border-left: 3px solid #C8873A; }
.conv-avatar { width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg, #C8873A, #E8A855); display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 700; color: #fff; flex-shrink: 0; }
.conv-info { flex: 1; min-width: 0; }
.conv-name { font-size: 13px; font-weight: 500; color: #1a1a1a; margin-bottom: 3px; }
.conv-preview { font-size: 12px; color: #888; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.conv-meta { text-align: right; }
.conv-time { font-size: 11px; color: #aaa; }
.conv-unread { background: #C8873A; color: #fff; font-size: 10px; font-weight: 700; width: 18px; height: 18px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-left: auto; margin-top: 4px; }

/* ZONE CHAT */
.chat-area { flex: 1; display: flex; flex-direction: column; background: #f8f7f4; min-width: 0; }
.chat-header { padding: 16px 24px; background: #fff; border-bottom: 1px solid #f0ede8; display: flex; align-items: center; gap: 14px; }
.chat-header-avatar { width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #C8873A, #E8A855); display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 700; color: #fff; flex-shrink: 0; }
.chat-header-name { font-size: 15px; font-weight: 500; color: #1a1a1a; }
.chat-header-role { font-size: 12px; color: #888; margin-top: 2px; }

/* MESSAGES */
.chat-messages { flex: 1; overflow-y: auto; padding: 24px; display: flex; flex-direction: column; gap: 14px; }
.msg { display: flex; gap: 10px; max-width: 68%; }
.msg.sent { margin-left: auto; flex-direction: row-reverse; }
.msg-avatar { width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #C8873A, #E8A855); display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; color: #fff; flex-shrink: 0; align-self: flex-end; }
.msg-bubble { padding: 11px 15px; border-radius: 16px; font-size: 14px; line-height: 1.6; color: #1a1a1a; background: #fff; border: 1px solid #f0ede8; }
.msg.sent .msg-bubble { background: #C8873A; color: #fff; border-color: #C8873A; }
.msg-time { font-size: 11px; color: #aaa; margin-top: 4px; }
.msg.sent .msg-time { text-align: left; }
.date-sep { text-align: center; font-size: 12px; color: #aaa; margin: 8px 0; }
.empty-chat { flex: 1; display: flex; align-items: center; justify-content: center; flex-direction: column; gap: 10px; color: #888; }
.empty-chat-icon { font-size: 48px; }

/* INPUT */
.chat-input-area { padding: 14px 24px; background: #fff; border-top: 1px solid #f0ede8; }
.chat-input-form { display: flex; gap: 12px; align-items: flex-end; }
.chat-input { flex: 1; padding: 11px 16px; border: 1.5px solid #e8e3db; border-radius: 24px; font-size: 14px; font-family: 'DM Sans', sans-serif; outline: none; transition: border-color 0.2s; resize: none; max-height: 100px; }
.chat-input:focus { border-color: #C8873A; }
.send-btn { width: 42px; height: 42px; border-radius: 50%; background: #C8873A; color: #fff; border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background 0.2s; flex-shrink: 0; font-size: 16px; }
.send-btn:hover { background: #b07530; }
@endsection

@section('content')
<div class="chat-wrap">

    {{-- SIDEBAR: liste des conversations --}}
    <div class="conv-sidebar">
        <div class="conv-header">
            <div class="conv-title">Messages</div>
            <input type="text" class="conv-search" placeholder="🔍 Rechercher..." id="convSearch">
        </div>
        <div class="conv-list" id="convList">
            {{-- Conversation active en premier --}}
            <a href="{{ route('messages.show', $user) }}" class="conv-item active">
                <div class="conv-avatar">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
                <div class="conv-info">
                    <div class="conv-name">{{ $user->name }}</div>
                    <div class="conv-preview">
                        {{ $messages->last()?->message ?? 'Démarrer la conversation' }}
                    </div>
                </div>
                <div class="conv-meta">
                    <div class="conv-time">{{ $messages->last()?->created_at->format('H:i') ?? '' }}</div>
                </div>
            </a>
            {{-- Autres conversations --}}
            @php
                $others = \App\Models\Message::where('sender_id', auth()->id())
                    ->orWhere('receiver_id', auth()->id())
                    ->with(['sender', 'receiver'])
                    ->latest()->get()
                    ->groupBy(fn($m) => $m->sender_id === auth()->id() ? $m->receiver_id : $m->sender_id)
                    ->map(fn($msgs) => $msgs->first())
                    ->filter(fn($m, $id) => $id != $user->id)
                    ->take(10);
            @endphp
            @foreach($others as $otherId => $lastMsg)
            @php $other = $lastMsg->sender_id === auth()->id() ? $lastMsg->receiver : $lastMsg->sender; @endphp
            <a href="{{ route('messages.show', $other) }}" class="conv-item">
                <div class="conv-avatar" style="background:linear-gradient(135deg,#185FA5,#3a7fc1)">
                    {{ strtoupper(substr($other->name, 0, 2)) }}
                </div>
                <div class="conv-info">
                    <div class="conv-name">{{ $other->name }}</div>
                    <div class="conv-preview">{{ Str::limit($lastMsg->message, 35) }}</div>
                </div>
                <div class="conv-meta">
                    <div class="conv-time">{{ $lastMsg->created_at->format('H:i') }}</div>
                    @if(!$lastMsg->is_read && $lastMsg->receiver_id === auth()->id())
                        <div class="conv-unread">!</div>
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </div>

    {{-- ZONE CHAT principale --}}
    <div class="chat-area">

        {{-- En-tête --}}
        <div class="chat-header">
            <div class="chat-header-avatar">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
            <div>
                <div class="chat-header-name">{{ $user->name }}</div>
                <div class="chat-header-role">{{ $user->role_label }}</div>
            </div>
        </div>

        {{-- Messages --}}
        <div class="chat-messages" id="chatMessages">
            @if($messages->isEmpty())
                <div class="empty-chat">
                    <div class="empty-chat-icon">💬</div>
                    <p style="font-size:15px;font-weight:500;color:#1a1a1a">Démarrez la conversation</p>
                    <p style="font-size:13px">Envoyez un premier message à {{ $user->name }}</p>
                </div>
            @else
                @php $prevDate = null; @endphp
                @foreach($messages as $msg)
                    @php $date = $msg->created_at->format('Y-m-d'); @endphp
                    @if($date !== $prevDate)
                        <div class="date-sep">
                            {{ $msg->created_at->isToday() ? "Aujourd'hui" : ($msg->created_at->isYesterday() ? 'Hier' : $msg->created_at->format('d/m/Y')) }}
                        </div>
                        @php $prevDate = $date; @endphp
                    @endif
                    <div class="msg {{ $msg->sender_id === auth()->id() ? 'sent' : '' }}">
                        <div class="msg-avatar"
                             style="{{ $msg->sender_id === auth()->id() ? 'background:linear-gradient(135deg,#185FA5,#3a7fc1)' : '' }}">
                            {{ strtoupper(substr($msg->sender->name, 0, 2)) }}
                        </div>
                        <div>
                            <div class="msg-bubble">{{ $msg->message }}</div>
                            <div class="msg-time">{{ $msg->created_at->format('H:i') }}</div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        {{-- Formulaire d'envoi --}}
        <div class="chat-input-area">
            <form method="POST" action="{{ route('messages.store') }}" class="chat-input-form">
                @csrf
                <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                <textarea name="message" class="chat-input" rows="1"
                          placeholder="Écrire un message..." required
                          onkeydown="if(event.key==='Enter'&&!event.shiftKey){event.preventDefault();this.form.submit()}"></textarea>
                <button type="submit" class="send-btn">➤</button>
            </form>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    // Scroll auto en bas
    const msgs = document.getElementById('chatMessages');
    if (msgs) msgs.scrollTop = msgs.scrollHeight;

    // Filtre conversations
    document.getElementById('convSearch')?.addEventListener('input', function() {
        const q = this.value.toLowerCase();
        document.querySelectorAll('#convList .conv-item').forEach(item => {
            const name = item.querySelector('.conv-name')?.textContent.toLowerCase() || '';
            item.style.display = name.includes(q) ? '' : 'none';
        });
    });
</script>
@endpush
