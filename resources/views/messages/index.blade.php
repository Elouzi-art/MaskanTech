@extends('dashboard.layout')

@section('title', 'MaskanTech — Messages')

@section('dashboard-content')

<div class="dash-header">
    <div class="dash-title">Messages 💬</div>
    <div class="dash-subtitle">{{ $conversations->count() }} conversation(s)</div>
</div>

<div class="dash-section">
    <div class="dash-section-header">
        <div class="dash-section-title">Mes conversations</div>
    </div>

    @if($conversations->isEmpty())
        <div class="dash-empty">
            <div class="dash-empty-icon">💬</div>
            <div class="dash-empty-text">Aucun message pour le moment</div>
            <a href="{{ route('properties.index') }}" class="mk-btn-gold">Parcourir les logements</a>
        </div>
    @else
        <div style="display:flex;flex-direction:column;gap:12px;">
            @foreach($conversations as $otherUserId => $lastMessage)
                @php
                    $me = auth()->id();
                    $other = $lastMessage->sender_id === $me ? $lastMessage->receiver : $lastMessage->sender;
                    $isUnread = !$lastMessage->is_read && $lastMessage->receiver_id === $me;
                @endphp
                <a href="{{ route('messages.show', $other) }}" style="text-decoration:none;">
                    <div style="
                        display:flex;align-items:center;gap:16px;
                        padding:16px 20px;border-radius:10px;
                        background:{{ $isUnread ? '#fdf6ee' : '#fafaf8' }};
                        border:1.5px solid {{ $isUnread ? '#C8873A' : '#ede9e3' }};
                        transition:all 0.2s;
                    ">
                        <div style="
                            width:44px;height:44px;border-radius:50%;
                            background:linear-gradient(135deg,#C8873A,#E8A855);
                            display:flex;align-items:center;justify-content:center;
                            font-size:16px;font-weight:700;color:#fff;flex-shrink:0;
                        ">
                            {{ strtoupper(substr($other->name, 0, 2)) }}
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-size:14px;font-weight:500;color:#1a1a1a;">
                                {{ $other->name }}
                                @if($isUnread)
                                    <span style="background:#C8873A;color:#fff;font-size:10px;padding:2px 7px;border-radius:10px;margin-left:8px;">Nouveau</span>
                                @endif
                            </div>
                            <div style="font-size:13px;color:#888;margin-top:3px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                {{ Str::limit($lastMessage->message, 60) }}
                            </div>
                        </div>
                        <div style="font-size:12px;color:#aaa;flex-shrink:0;">
                            {{ $lastMessage->created_at->diffForHumans() }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>

@endsection