@extends('layouts.maskan')

@section('title', 'MaskanTech — Messagerie')

@section('styles')
/* WRAP */
.messages-wrap {
    display: flex;
    height: calc(100vh - 73px);
    overflow: hidden;
}

/* CONVERSATIONS LIST */
.conv-list {
    width: 320px; min-width: 320px;
    border-right: 1px solid #f0ede8;
    display: flex; flex-direction: column;
    background: #fff;
}
.conv-list-header {
    padding: 20px 20px 16px;
    border-bottom: 1px solid #f0ede8;
}
.conv-list-title {
    font-family: 'Playfair Display', serif;
    font-size: 20px; font-weight: 700; color: #1a1a1a;
    margin-bottom: 12px;
}
.conv-search {
    width: 100%; padding: 10px 14px;
    border: 1.5px solid #e8e3db; border-radius: 8px;
    font-size: 13px; font-family: 'DM Sans', sans-serif;
    outline: none; transition: border-color 0.2s;
}
.conv-search:focus { border-color: #C8873A; }

/* CONVERSATION ITEMS */
.conv-items { overflow-y: auto; flex: 1; }
.conv-item {
    display: flex; align-items: center; gap: 12px;
    padding: 16px 20px; cursor: pointer;
    border-bottom: 1px solid #f8f7f4;
    transition: background 0.2s;
    position: relative;
}
.conv-item:hover { background: #fafaf8; }
.conv-item.active { background: #fdf6ee; border-left: 3px solid #C8873A; }
.conv-avatar {
    width: 46px; height: 46px; border-radius: 50%;
    background: linear-gradient(135deg, #C8873A, #E8A855);
    display: flex; align-items: center; justify-content: center;
    font-size: 16px; font-weight: 700; color: #fff;
    flex-shrink: 0;
}
.conv-avatar-blue {
    background: linear-gradient(135deg, #185FA5, #3a7fc1);
}
.conv-info { flex: 1; min-width: 0; }
.conv-name {
    font-size: 14px; font-weight: 500; color: #1a1a1a;
    margin-bottom: 4px;
}
.conv-preview {
    font-size: 12px; color: #888;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.conv-meta { text-align: right; flex-shrink: 0; }
.conv-time { font-size: 11px; color: #aaa; margin-bottom: 6px; }
.conv-unread {
    background: #C8873A; color: #fff;
    font-size: 11px; font-weight: 600;
    width: 20px; height: 20px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin-left: auto;
}

/* CHAT AREA */
.chat-area {
    flex: 1; display: flex; flex-direction: column;
    background: #f8f7f4;
}
.chat-header {
    padding: 16px 24px;
    background: #fff; border-bottom: 1px solid #f0ede8;
    display: flex; align-items: center; gap: 14px;
}
.chat-header-avatar {
    width: 42px; height: 42px; border-radius: 50%;
    background: linear-gradient(135deg, #C8873A, #E8A855);
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; font-weight: 700; color: #fff;
}
.chat-header-name {
    font-size: 15px; font-weight: 500; color: #1a1a1a;
}
.chat-header-status { font-size: 12px; color: #27500A; }
.chat-header-property {
    margin-left: auto;
    background: #fdf6ee; border: 1px solid #f0d9b5;
    border-radius: 8px; padding: 8px 14px;
    font-size: 12px; color: #C8873A; font-weight: 500;
    text-decoration: none;
}

/* MESSAGES */
.chat-messages {
    flex: 1; overflow-y: auto;
    padding: 24px; display: flex; flex-direction: column; gap: 16px;
}
.msg { display: flex; gap: 10px; max-width: 70%; }
.msg.sent { margin-left: auto; flex-direction: row-reverse; }
.msg-avatar {
    width: 34px; height: 34px; border-radius: 50%;
    background: linear-gradient(135deg, #C8873A, #E8A855);
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 700; color: #fff;
    flex-shrink: 0; align-self: flex-end;
}
.msg-bubble {
    padding: 12px 16px; border-radius: 16px;
    font-size: 14px; line-height: 1.6; color: #1a1a1a;
    background: #fff; border: 1px solid #f0ede8;
}
.msg.sent .msg-bubble {
    background: #C8873A; color: #fff; border-color: #C8873A;
}
.msg-time {
    font-size: 11px; color: #aaa; margin-top: 4px;
    text-align: right;
}
.msg.sent .msg-time { text-align: left; }

/* DATE SEPARATOR */
.date-sep {
    text-align: center; font-size: 12px; color: #aaa;
    margin: 8px 0; position: relative;
}
.date-sep::before, .date-sep::after {
    content: ''; position: absolute; top: 50%;
    width: 35%; height: 1px; background: #e8e3db;
}
.date-sep::before { left: 0; }
.date-sep::after { right: 0; }

/* PROPERTY CARD IN CHAT */
.chat-property-card {
    background: #fff; border: 1px solid #f0ede8;
    border-radius: 12px; padding: 14px 16px;
    display: flex; align-items: center; gap: 12px;
    margin-bottom: 8px; max-width: 400px;
}
.chat-property-img {
    width: 60px; height: 60px; border-radius: 8px;
    background-size: cover; background-position: center;
    flex-shrink: 0;
}
.chat-property-title { font-size: 13px; font-weight: 500; color: #1a1a1a; }
.chat-property-price { font-size: 14px; font-weight: 700; color: #C8873A; margin-top: 2px; }
.chat-property-loc { font-size: 12px; color: #888; }

/* INPUT */
.chat-input-area {
    padding: 16px 24px;
    background: #fff; border-top: 1px solid #f0ede8;
    display: flex; align-items: center; gap: 12px;
}
.chat-input {
    flex: 1; padding: 12px 16px;
    border: 1.5px solid #e8e3db; border-radius: 24px;
    font-size: 14px; font-family: 'DM Sans', sans-serif;
    outline: none; transition: border-color 0.2s;
    resize: none;
}
.chat-input:focus { border-color: #C8873A; }
.chat-send-btn {
    width: 44px; height: 44px; border-radius: 50%;
    background: #C8873A; color: #fff; border: none;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; cursor: pointer; transition: background 0.2s;
    flex-shrink: 0;
}
.chat-send-btn:hover { background: #b07530; }
.chat-attach-btn {
    width: 44px; height: 44px; border-radius: 50%;
    background: #f0ede8; color: #888; border: none;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; cursor: pointer; transition: all 0.2s;
    flex-shrink: 0;
}
.chat-attach-btn:hover { background: #e8e3db; }

/* EMPTY STATE */
.chat-empty {
    flex: 1; display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    color: #888; text-align: center; padding: 40px;
}
.chat-empty-icon { font-size: 64px; margin-bottom: 16px; }
.chat-empty-title { font-size: 18px; font-weight: 500; color: #1a1a1a; margin-bottom: 8px; }
.chat-empty-text { font-size: 14px; color: #888; }
@endsection

@section('content')
<div class="messages-wrap">

    {{-- LISTE CONVERSATIONS --}}
    <div class="conv-list">
        <div class="conv-list-header">
            <div class="conv-list-title">Messages</div>
            <input type="text" class="conv-search" placeholder="🔍 Rechercher une conversation...">
        </div>
        <div class="conv-items">

            <div class="conv-item active" onclick="openConv(this, 'MK')">
                <div class="conv-avatar">MK</div>
                <div class="conv-info">
                    <div class="conv-name">Mohammed Karimi</div>
                    <div class="conv-preview">Bonjour, le logement est toujours disponible</div>
                </div>
                <div class="conv-meta">
                    <div class="conv-time">10:24</div>
                    <div class="conv-unread">2</div>
                </div>
            </div>

            <div class="conv-item" onclick="openConv(this, 'SB')">
                <div class="conv-avatar conv-avatar-blue">SB</div>
                <div class="conv-info">
                    <div class="conv-name">Sara Benali</div>
                    <div class="conv-preview">Oui la visite est confirmée pour demain</div>
                </div>
                <div class="conv-meta">
                    <div class="conv-time">Hier</div>
                </div>
            </div>

            <div class="conv-item" onclick="openConv(this, 'AK')">
                <div class="conv-avatar">AK</div>
                <div class="conv-info">
                    <div class="conv-name">Ahmed Karimi</div>
                    <div class="conv-preview">Merci pour votre intérêt !</div>
                </div>
                <div class="conv-meta">
                    <div class="conv-time">Lun</div>
                    <div class="conv-unread">1</div>
                </div>
            </div>

            <div class="conv-item" onclick="openConv(this, 'YB')">
                <div class="conv-avatar conv-avatar-blue">YB</div>
                <div class="conv-info">
                    <div class="conv-name">Youssef Bennani</div>
                    <div class="conv-preview">Est-ce que le parking est inclus ?</div>
                </div>
                <div class="conv-meta">
                    <div class="conv-time">Dim</div>
                </div>
            </div>

        </div>
    </div>

    {{-- ZONE CHAT --}}
    <div class="chat-area" id="chatArea">

        {{-- HEADER --}}
        <div class="chat-header">
            <div class="chat-header-avatar">MK</div>
            <div>
                <div class="chat-header-name">Mohammed Karimi</div>
                <div class="chat-header-status">🟢 En ligne</div>
            </div>
            <a href="/biens/1" class="chat-header-property">
                🏠 Studio meublé — Guéliz · 2 500 MAD
            </a>
        </div>

        {{-- MESSAGES --}}
        <div class="chat-messages" id="chatMessages">

            <div class="date-sep">Aujourd'hui</div>

            {{-- PROPERTY CARD --}}
            <div class="chat-property-card">
                <div class="chat-property-img" style="background-image:url('https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=200&q=80')"></div>
                <div>
                    <div class="chat-property-title">Studio meublé — Guéliz</div>
                    <div class="chat-property-price">2 500 MAD/mois</div>
                    <div class="chat-property-loc">📍 Marrakech · 35m²</div>
                </div>
            </div>

            <div class="msg">
                <div class="msg-avatar">MK</div>
                <div>
                    <div class="msg-bubble">Bonjour ! Je vois que vous êtes intéressé par mon studio à Guéliz. Le logement est toujours disponible. 😊</div>
                    <div class="msg-time">10:20</div>
                </div>
            </div>

            <div class="msg sent">
                <div class="msg-avatar" style="background:linear-gradient(135deg,#185FA5,#3a7fc1)">Moi</div>
                <div>
                    <div class="msg-bubble">Bonjour ! Oui je suis très intéressé. Est-ce que je peux visiter cette semaine ?</div>
                    <div class="msg-time">10:22</div>
                </div>
            </div>

            <div class="msg">
                <div class="msg-avatar">MK</div>
                <div>
                    <div class="msg-bubble">Bien sûr ! Je suis disponible jeudi ou vendredi après-midi. Quelle date vous convient ?</div>
                    <div class="msg-time">10:24</div>
                </div>
            </div>

        </div>

        {{-- INPUT --}}
        <div class="chat-input-area">
            <button class="chat-attach-btn">📎</button>
            <input type="text" class="chat-input" placeholder="Écrivez votre message..." id="msgInput" onkeypress="sendOnEnter(event)">
            <button class="chat-send-btn" onclick="sendMessage()">➤</button>
        </div>

    </div>

</div>
@endsection

@section('scripts')
<script>
    function openConv(el, initials) {
        document.querySelectorAll('.conv-item').forEach(i => i.classList.remove('active'));
        el.classList.add('active');
        const unread = el.querySelector('.conv-unread');
        if (unread) unread.remove();
    }

    function sendMessage() {
        const input = document.getElementById('msgInput');
        const text = input.value.trim();
        if (!text) return;

        const msgs = document.getElementById('chatMessages');
        const msg = document.createElement('div');
        msg.className = 'msg sent';
        msg.innerHTML = `
            <div class="msg-avatar" style="background:linear-gradient(135deg,#185FA5,#3a7fc1)">Moi</div>
            <div>
                <div class="msg-bubble">${text}</div>
                <div class="msg-time">${new Date().toLocaleTimeString('fr-FR', {hour:'2-digit',minute:'2-digit'})}</div>
            </div>
        `;
        msgs.appendChild(msg);
        msgs.scrollTop = msgs.scrollHeight;
        input.value = '';
    }

    function sendOnEnter(e) {
        if (e.key === 'Enter') sendMessage();
    }
</script>
@endsection