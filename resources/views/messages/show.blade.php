@extends('dashboard.layout')

@section('title', 'Conversation avec {{ $user->name }}')

@section('styles')
.conversation-wrap { display: flex; flex-direction: column; height: calc(100vh - 200px); }
.conv-header { display: flex; align-items: center; gap: 16px; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid #f0ede8; }
.conv-avatar { width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg,#C8873A,#E8A855); display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: 700; color: #fff; }
.conv-name { font-size: 16px; font-weight: 500; color: #1a1a1a; }
.conv-back { font-size: 13px; color: #C8873A; text-decoration: none; margin-right: 8px; }
.messages-list { flex: 1; overflow-y: auto; display: flex; flex-direction: column; gap: 12px; margin-bottom: 24px; padding: 4px; }
.msg-bubble { max-width: 65%; padding: 12px 16px; border-radius: 12px; font-size: 14px; line-height: 1.6; }
.msg-me { align-self: flex-end; background: #1a1a1a; color: #fff; border-bottom-right-radius: 4px; }
.msg-other { align-self: flex-start; background: #f0ede8; color: #1a1a1a; border-bottom-left-radius: 4px; }
.msg-time { font-size: 11px; color: #aaa; margin-top: 4px; text-align: right; }
.msg-other .msg-time { text-align: left; }
.conv-form { display: flex; gap: 12px; }
.conv-input { flex: 1; padding: 13px 16px; border: 1.5px solid #e8e3db; border-radius: 8px; font-size: 14px; font-family: 'DM Sans', sans-serif; outline: none; transition: border-color 0.2s; }
.conv-input:focus { border-color: #C8873A; }
.conv-send { padding: 13px 24px; background: #1a1a1a; color: #fff; border: none; border-radius: 8px; font-size: 14px; font-weight: 500; cursor: pointer; font-family: 'DM Sans', sans-serif; transition: background 0.2s; }
.conv-send:hover { background: #C8873A; }
@endsection

@section('dashboard-content')

<div class="dash-header">
    <div style="display:flex;align-items:center;gap:12px;">
        <a href="{{ route('messages.index') }}" style="color:#C8873A;text-decoration:none;font-size:20px;">←</a>
        <div class="conv-avatar">{{ strtoupper(substr($user->name, 0, 2)) }}</div>
        <div>
            <div class="dash-title" style="font-size:22px;">{{ $user->name }}</div>
            <div class="dash-subtitle">Conversation</div>
        </div>
    </div>
</div>

<div class="dash-section">
    {{-- MESSAGES --}}
    <div class="messages-list" id="messages-list">
        @forelse($messages as $message)
            <div style="display:flex;flex-direction:column;align-items:{{ $message->sender_id === auth()->id() ? 'flex-end' : 'flex-start' }};">
                <div class="msg-bubble {{ $message->sender_id === auth()->id() ? 'msg-me' : 'msg-other' }}">
                    {{ $message->message }}
                    <div class="msg-time">{{ $message->created_at->format('d/m H:i') }}</div>
                </div>
            </div>
        @empty
            <div class="dash-empty">
                <div class="dash-empty-icon">💬</div>
                <div class="dash-empty-text">Démarrez la conversation !</div>
            </div>
        @endforelse
    </div>

    {{-- FORMULAIRE ENVOI --}}
    <form action="{{ route('messages.store') }}" method="POST" class="conv-form">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $user->id }}">
        <input type="text" name="message" class="conv-input" placeholder="Écrivez votre message..." required>
        <button type="submit" class="conv-send">Envoyer →</button>
    </form>
</div>

@endsection

@section('scripts')
<script>
    // Scroll automatique vers le bas
    const list = document.getElementById('messages-list');
    if (list) list.scrollTop = list.scrollHeight;
</script>
@endsection