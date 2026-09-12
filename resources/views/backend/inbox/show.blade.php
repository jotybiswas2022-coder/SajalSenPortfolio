@extends('backend.app')

@section('content')
<style>
    .chat-messages {
        max-height: 500px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        padding: 1rem;
    }
    .chat-messages::-webkit-scrollbar { width: 4px; }
    .chat-messages::-webkit-scrollbar-thumb { background: rgba(0,217,255,0.3); border-radius: 2px; }

    .msg {
        display: flex;
        gap: 0.75rem;
        max-width: 85%;
    }
    .msg.incoming { align-self: flex-start; }
    .msg.outgoing { align-self: flex-end; flex-direction: row-reverse; }

    .msg-avatar {
        width: 34px; height: 34px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.8rem; font-weight: 700; color: #fff;
        flex-shrink: 0;
    }
    .msg .bubble {
        padding: 0.7rem 1rem;
        border-radius: 16px;
        font-size: 0.9rem;
        line-height: 1.5;
        word-break: break-word;
        border: 1px solid rgba(0,217,255,0.12);
    }
    .msg.incoming .bubble {
        background: rgba(0,217,255,0.06);
        border-bottom-left-radius: 4px;
    }
    .msg.outgoing .bubble {
        background: rgba(0,217,255,0.12);
        border-color: rgba(0,217,255,0.2);
        border-bottom-right-radius: 4px;
    }
    .bubble .time {
        display: block; font-size: 0.7rem;
        color: var(--admin-text-muted); margin-top: 0.4rem;
    }
    .bubble img {
        max-width: 260px; max-height: 260px;
        width: auto; height: auto;
        border-radius: 12px; margin-top: 0.4rem; display: block;
        object-fit: cover;
        box-shadow: 0 2px 12px rgba(0,0,0,0.2);
    }
    .bubble .sender-label {
        font-size: 0.7rem; color: var(--admin-text-muted); margin-bottom: 0.2rem;
    }

    .inbox-header-row {
        position: relative; z-index: 1;
        display: flex; align-items: center; gap: 0.85rem; flex-wrap: wrap;
    }
    .inbox-header-info {
        flex: 1; min-width: 0;
        display: flex; flex-direction: column; gap: 0.2rem;
    }
    .inbox-header-info .ae-title {
        overflow: hidden; word-break: break-word;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
        text-overflow: ellipsis;
    }
    .inbox-header-info .ae-sub {
        overflow: hidden; white-space: nowrap; text-overflow: ellipsis;
    }
    .inbox-header-row > .ae-status-badge { margin-left: auto; flex-shrink: 0; }

    @media (max-width: 575.98px) {
        .ae-page-header { padding: 12px 12px; gap: 0.6rem !important; }
        .ae-page-header .header-ico { width: 40px !important; height: 40px !important; border-radius: 11px !important; }
        .ae-page-header .header-ico i { font-size: 1.05rem !important; }
        .ae-page-header .ae-title { font-size: 0.95rem; line-height: 1.3; }
        .ae-page-header .ae-sub { font-size: 0.7rem; line-height: 1.35; }
        .ae-page-header .ae-status-badge { font-size: 0.68rem; padding: 0.2rem 0.55rem; }
        .inbox-header-row { gap: 0.55rem; }
        .inbox-header-row > .ae-status-badge { order: 2; }
        .inbox-header-info { order: 3; flex: 1 1 100%; padding-top: 0.15rem; }
        .inbox-header-info .ae-title { font-size: 0.95rem; }
        .ae-card-body .package-label { font-size: 0.65rem !important; }
        .package-value { font-size: 0.86rem; }
        .package-price { font-size: 0.78rem; }
        .package-card-inner { flex-direction: column !important; align-items: stretch !important; gap: 0.7rem !important; }
        .package-details { display: flex; flex-wrap: wrap; align-items: baseline; column-gap: 0.5rem; }
        .package-card-inner > .ae-btn { width: 100%; margin-left: 0 !important; font-size: 0.78rem; }
        .package-card .ae-card-body { padding: 1rem !important; }
        .msg { max-width: 95%; gap: 0.5rem; }
        .msg-avatar { width: 28px !important; height: 28px !important; font-size: 0.68rem; }
        .msg .bubble { font-size: 0.8rem; padding: 0.55rem 0.75rem; border-radius: 14px; line-height: 1.45; }
        .bubble .sender-label,
        .bubble .time { font-size: 0.64rem; }
        .bubble img { max-width: 100%; max-height: 200px; }
        .chat-messages { max-height: 62vh; padding: 0.7rem; gap: 0.75rem; }
        .chat-messages .msg-avatar { display: none; }
        .composer-row { flex-wrap: wrap; }
        .composer-input { flex: 1 1 100% !important; }
        .composer-actions { flex: 1 1 100%; justify-content: flex-end; }
        .composer-actions .ae-btn { flex: 1; max-width: 104px; font-size: 0.78rem; }
        .composer-actions .ae-btn i { font-size: 0.9rem; }
        .ae-btn-ghost { padding: 0.55rem 0.7rem !important; }
        .emoji-picker button { font-size: 1.15rem !important; }
    }
</style>

<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-md-11">

            {{-- Header --}}
            <div class="ae-page-header mb-4 inbox-header">
                <div class="inbox-header-row">
                    <a href="{{ route('admin.inbox.index') }}" class="ae-btn ae-btn-ghost" style="padding:0.5rem 0.75rem;">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <div class="header-ico" style="width:52px;height:52px;border-radius:14px;background:rgba(0,217,255,0.12);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="bi bi-envelope" style="font-size:1.5rem;color:#00d9ff;"></i>
                    </div>
                    <div class="inbox-header-info">
                        <div class="ae-title">{{ $conversation->subject }}</div>
                        <p class="ae-sub mb-0">{{ $conversation->user->name }} ({{ $conversation->user->email }})</p>
                    </div>
                    @if($conversation->status == 'open')
                        <span class="ae-status-badge" style="background:rgba(34,197,94,0.1);border-color:rgba(34,197,94,0.25);color:#22c55e;"><span class="ae-dot"></span> Open</span>
                    @else
                        <span class="ae-status-badge inactive"><span class="ae-dot"></span> Closed</span>
                    @endif
                </div>
            </div>

            @if($conversation->package_name)
                <div class="ae-card mb-3 package-card">
                    <div class="ae-card-body package-card-inner" style="display:flex; align-items:center; gap:1rem; flex-wrap:wrap;">
                        <div class="package-details">
                            <small class="ae-form-label package-label" style="text-transform:uppercase; letter-spacing:0.5px;">Package</small>
                            <span class="fw-bold package-value" style="color:#00d9ff;">{{ $conversation->package_name }}</span>
                            <span class="fw-semibold package-price" style="color:var(--admin-text);">{{ $conversation->package_price }} USD</span>
                        </div>
                        @if($conversation->gig)
                            <a href="{{ route('gig.detail', $conversation->gig->id) }}" target="_blank" rel="noopener" class="ae-btn ae-btn-ghost ms-auto">
                                <i class="bi bi-box-arrow-up-right"></i> View Gig
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Messages --}}
            <div class="ae-card mb-3" >
                <div class="ae-card-body p-0">
                    <div class="chat-messages" id="messagesBox">
                        @forelse($conversation->messages as $msg)
                            @php $isAdmin = $msg->sender_id == auth()->id(); @endphp
                            <div class="msg {{ $isAdmin ? 'outgoing' : 'incoming' }}">
                                <div class="msg-avatar" style="background:linear-gradient(135deg,#00d9ff,#00ff88);">
                                    {{ substr($msg->sender->name, 0, 1) }}
                                </div>
                                <div class="bubble">
                                    @if(!$isAdmin)
                                        <div class="sender-label">{{ $msg->sender->name }}</div>
                                    @endif
                                    @if($msg->message)
                                        <span style="color:var(--admin-text);">{!! nl2br(e($msg->message)) !!}</span>
                                    @endif
                                    @if($msg->image)
                                        <img src="{{ config('app.storage_url') }}{{ $msg->image }}" alt="Shared image">
                                    @endif
                                    <span class="time">{{ $msg->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @empty
                            <div style="text-align:center;padding:2rem;color:var(--admin-text-muted);">
                                <i class="bi bi-chat-dots" style="font-size:2rem;display:block;margin-bottom:0.5rem;"></i>
                                No messages yet.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Composer --}}
            @if($conversation->status == 'open')
                <div class="ae-card mb-3">
                    <div class="ae-card-body">
                        <form method="POST" action="{{ route('admin.inbox.send', $conversation->id) }}" enctype="multipart/form-data">
                            @csrf

                            <div id="imagePreview" style="display:none;margin-bottom:0.5rem;">
                                <img id="previewImg" src="" style="max-width:120px;max-height:120px;border-radius:8px;border:1px solid rgba(0,217,255,0.3);">
                                <span onclick="clearImage()" style="color:#f87171;cursor:pointer;margin-left:0.5rem;font-size:0.85rem;">✕ Remove</span>
                            </div>

                            <div class="emoji-picker" id="emojiPicker" style="display:none;padding:0.5rem;gap:0.3rem;flex-wrap:wrap;border-bottom:1px solid var(--admin-border);margin-bottom:0.5rem;">
                                <button type="button" onclick="insertEmoji('😊')" style="background:none;border:none;font-size:1.4rem;cursor:pointer;padding:2px 4px;border-radius:4px;line-height:1;">😊</button>
                                <button type="button" onclick="insertEmoji('👍')" style="background:none;border:none;font-size:1.4rem;cursor:pointer;padding:2px 4px;border-radius:4px;line-height:1;">👍</button>
                                <button type="button" onclick="insertEmoji('😍')" style="background:none;border:none;font-size:1.4rem;cursor:pointer;padding:2px 4px;border-radius:4px;line-height:1;">😍</button>
                                <button type="button" onclick="insertEmoji('🎉')" style="background:none;border:none;font-size:1.4rem;cursor:pointer;padding:2px 4px;border-radius:4px;line-height:1;">🎉</button>
                                <button type="button" onclick="insertEmoji('🔥')" style="background:none;border:none;font-size:1.4rem;cursor:pointer;padding:2px 4px;border-radius:4px;line-height:1;">🔥</button>
                                <button type="button" onclick="insertEmoji('💯')" style="background:none;border:none;font-size:1.4rem;cursor:pointer;padding:2px 4px;border-radius:4px;line-height:1;">💯</button>
                                <button type="button" onclick="insertEmoji('✅')" style="background:none;border:none;font-size:1.4rem;cursor:pointer;padding:2px 4px;border-radius:4px;line-height:1;">✅</button>
                                <button type="button" onclick="insertEmoji('❓')" style="background:none;border:none;font-size:1.4rem;cursor:pointer;padding:2px 4px;border-radius:4px;line-height:1;">❓</button>
                                <button type="button" onclick="insertEmoji('👋')" style="background:none;border:none;font-size:1.4rem;cursor:pointer;padding:2px 4px;border-radius:4px;line-height:1;">👋</button>
                                <button type="button" onclick="insertEmoji('📸')" style="background:none;border:none;font-size:1.4rem;cursor:pointer;padding:2px 4px;border-radius:4px;line-height:1;">📸</button>
                                <button type="button" onclick="insertEmoji('🚀')" style="background:none;border:none;font-size:1.4rem;cursor:pointer;padding:2px 4px;border-radius:4px;line-height:1;">🚀</button>
                                <button type="button" onclick="insertEmoji('💪')" style="background:none;border:none;font-size:1.4rem;cursor:pointer;padding:2px 4px;border-radius:4px;line-height:1;">💪</button>
                                <button type="button" onclick="insertEmoji('🙏')" style="background:none;border:none;font-size:1.4rem;cursor:pointer;padding:2px 4px;border-radius:4px;line-height:1;">🙏</button>
                                <button type="button" onclick="insertEmoji('😎')" style="background:none;border:none;font-size:1.4rem;cursor:pointer;padding:2px 4px;border-radius:4px;line-height:1;">😎</button>
                                <button type="button" onclick="insertEmoji('💰')" style="background:none;border:none;font-size:1.4rem;cursor:pointer;padding:2px 4px;border-radius:4px;line-height:1;">💰</button>
                            </div>

                            <div class="d-flex gap-2 align-items-start composer-row">
                                <div style="flex:1;" class="composer-input">
                                    <textarea name="message" id="msgInput" class="form-control ae-input-modern" rows="2" placeholder="Type your reply..." style="border-radius:12px;resize:none;"></textarea>
                                </div>
                                <div class="d-flex gap-1 composer-actions">
                                    <button type="button" class="ae-btn ae-btn-ghost" style="padding:0.4rem 0.7rem;" onclick="toggleEmojiPicker()" title="Emoji">
                                        <i class="bi bi-emoji-smile"></i>
                                    </button>
                                    <label class="ae-btn ae-btn-ghost" style="cursor:pointer;padding:0.4rem 0.7rem;" title="Send Image">
                                        <i class="bi bi-image"></i>
                                        <input type="file" name="image" accept="image/*" onchange="previewImage(event)" style="display:none;">
                                    </label>
                                    <button type="submit" class="ae-btn ae-btn-primary" style="padding:0.4rem 1rem;">
                                        <i class="bi bi-send-fill me-1"></i> Send
                                    </button>
                                </div>
                            </div>
                            @error('message')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            @error('image')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                        </form>
                    </div>
                </div>
            @else
                <div class="ae-card mb-3">
                    <div class="ae-card-body">
                        <div class="text-center" style="color:var(--admin-text-muted);">
                            <i class="bi bi-lock-fill me-1"></i> This conversation is closed.
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const box = document.getElementById('messagesBox');
        if (box) box.scrollTop = box.scrollHeight;
        const textarea = document.getElementById('msgInput');
        if (textarea) {
            textarea.addEventListener('input', function() { autoResize(this); });
        }
    });
    function toggleEmojiPicker() {
        const picker = document.getElementById('emojiPicker');
        picker.style.display = picker.style.display === 'none' ? 'flex' : 'none';
    }
    function insertEmoji(emoji) {
        const input = document.getElementById('msgInput');
        const start = input.selectionStart;
        const end = input.selectionEnd;
        input.value = input.value.substring(0, start) + emoji + input.value.substring(end);
        input.focus();
        input.selectionStart = input.selectionEnd = start + emoji.length;
        autoResize(input);
    }
    function autoResize(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = Math.min(textarea.scrollHeight, 120) + 'px';
    }
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    }
    function clearImage() {
        document.querySelector('input[name="image"]').value = '';
        document.getElementById('imagePreview').style.display = 'none';
    }
</script>
@endsection