@extends('backend.app')

@section('content')
<style>
@media (max-width: 767.98px) {
    .inbox-show-page h4 { font-size: 0.9rem; }
    .inbox-show-page h5 { font-size: 0.85rem; }
    .inbox-show-page p.text-muted { font-size: 0.75rem; }
    .inbox-show-page .btn { font-size: 0.72rem; padding: 0.25rem 0.6rem; }
    .inbox-show-page .card-header { padding: 0.6rem 0.8rem !important; }
    .inbox-show-page .card-body { padding: 0.6rem !important; }
    .inbox-show-page .chat-messages { padding: 0.5rem; gap: 0.5rem; max-height: 350px; }
    .inbox-show-page .msg { max-width: 98%; }
    .inbox-show-page .msg .bubble { font-size: 0.78rem; padding: 0.4rem 0.7rem; }
    .inbox-show-page .bubble img { max-width: 100% !important; max-height: 200px !important; }
    .inbox-show-page .bubble .time { font-size: 0.6rem; }
    .inbox-show-page .bubble .sender-label { font-size: 0.6rem; }
    .inbox-show-page .msg-avatar { width: 26px !important; height: 26px !important; font-size: 0.65rem !important; }
    .inbox-show-page .form-control { font-size: 0.78rem; padding: 0.35rem 0.6rem; }
    .inbox-show-page .form-text { font-size: 0.7rem; }
    .inbox-show-page .badge { font-size: 0.65rem; padding: 0.2rem 0.5rem !important; }
    .inbox-show-page .fw-semibold[style*="font-size"] { font-size: 0.82rem !important; }
    .inbox-show-page .text-muted[style*="font-size"] { font-size: 0.68rem !important; }
    .inbox-show-page .emoji-picker button { font-size: 1rem !important; }
    .inbox-show-page .d-flex.gap-2.align-items-start { flex-wrap: wrap; }
    .inbox-show-page .d-flex.gap-2.align-items-start > div:first-child { flex: 1 1 100%; margin-bottom: 0.4rem; }
    .inbox-show-page .d-flex.gap-2.align-items-start .d-flex.gap-1 { flex: 1 1 100%; justify-content: flex-end; }
    .inbox-show-page .d-flex.gap-2.align-items-start .d-flex.gap-1 .btn { padding: 0.35rem 0.6rem !important; }
    .inbox-show-page .d-flex.align-items-center.gap-2.mb-3 { flex-wrap: wrap; }
    .inbox-show-page .d-flex.align-items-center.gap-2.mb-3 .badge { margin-left: 0 !important; }
    .inbox-show-page .card-body.py-2.px-3 .d-flex { flex-wrap: wrap; gap: 0.3rem; }
    .inbox-show-page .card-body.py-2.px-3 .d-flex .fw-bold { font-size: 0.78rem; }
    .inbox-show-page .card-body.py-2.px-3 .d-flex .fw-semibold { font-size: 0.78rem; }
}
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
    }
    .msg.incoming .bubble {
        background: rgba(0,217,255,0.06);
        border: 1px solid rgba(0,217,255,0.1);
        border-bottom-left-radius: 4px;
    }
    .msg.outgoing .bubble {
        background: rgba(0,217,255,0.12);
        border: 1px solid rgba(0,217,255,0.18);
        border-bottom-right-radius: 4px;
    }
    .bubble .time {
        display: block; font-size: 0.7rem;
        color: #94a3b8; margin-top: 0.4rem;
    }
    .bubble img {
        max-width: 260px; max-height: 260px;
        width: auto; height: auto;
        border-radius: 12px; margin-top: 0.4rem; display: block;
        object-fit: cover;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        border: 1px solid #e2e8f0;
    }
    .bubble .sender-label {
        font-size: 0.7rem; color: #94a3b8; margin-bottom: 0.2rem;
    }
</style>

<div class="container-fluid py-3 inbox-show-page">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="d-flex align-items-center gap-2 mb-3">
                <a href="{{ route('admin.inbox.index') }}" class="btn btn-sm btn-outline-secondary rounded-3">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div>
                    <h5 class="fw-bold mb-0">{{ $conversation->subject }}</h5>
                    <small class="text-muted">{{ $conversation->user->name }} ({{ $conversation->user->email }})</small>
                </div>
                <span class="badge rounded-pill ms-auto" style="
                    {{ $conversation->status == 'open' ? 'background:rgba(34,197,94,0.12); color:#22c55e;' : 'background:rgba(248,113,113,0.12); color:#f87171;' }}">
                    {{ ucfirst($conversation->status) }}
                </span>
            </div>

            @if($conversation->package_name)
                <div class="card border-0 shadow-sm rounded-4 mb-3">
                    <div class="card-body py-2 px-3">
                        <small class="text-muted text-uppercase" style="font-size:0.7rem; letter-spacing:0.5px;">Package</small>
                        <div class="d-flex align-items-center gap-3">
                            <span class="fw-bold" style="color:#00d9ff;">{{ $conversation->package_name }}</span>
                            <span class="fw-semibold">{{ $conversation->package_price }} USD</span>
                            @if($conversation->gig)
                                <a href="{{ route('admin.gigs.edit', $conversation->gig->id) }}" class="text-decoration-none small" style="color:#00d9ff;">
                                    <i class="bi bi-box-arrow-up-right"></i> View Gig
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <div class="card border-0 shadow-sm rounded-4 mb-3">
                <div class="card-body p-0">
                    <div class="chat-messages" id="messagesBox">
                        @forelse($conversation->messages as $msg)
                            @php $isAdmin = $msg->sender_id == auth()->id(); @endphp
                            <div class="msg {{ $isAdmin ? 'outgoing' : 'incoming' }}">
                                <div class="msg-avatar" style="background:{{ $isAdmin ? 'linear-gradient(135deg,#00d9ff,#00ff88)' : 'linear-gradient(135deg,#00d9ff,#7ce6ff)' }};">
                                    {{ substr($msg->sender->name, 0, 1) }}
                                </div>
                                <div class="bubble">
                                    @if(!$isAdmin)
                                        <div class="sender-label">{{ $msg->sender->name }}</div>
                                    @endif
                                    @if($msg->message)
                                        <span>{!! nl2br(e($msg->message)) !!}</span>
                                    @endif
                                    @if($msg->image)
                                        <img src="{{ config('app.storage_url') }}{{ $msg->image }}" alt="Shared image">
                                    @endif
                                    <span class="time">{{ $msg->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        @empty
                            <div style="text-align:center; padding:2rem; color:#94a3b8;">
                                <i class="bi bi-chat-dots" style="font-size:2rem; display:block; margin-bottom:0.5rem;"></i>
                                No messages yet.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            @if($conversation->status == 'open')
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.inbox.send', $conversation->id) }}" enctype="multipart/form-data">
                            @csrf

                            <div id="imagePreview" style="display:none; margin-bottom:0.5rem;">
                                <img id="previewImg" src="" style="max-width:120px; max-height:120px; border-radius:8px; border:1px solid #e2e8f0;">
                                <span onclick="clearImage()" style="color:#f87171; cursor:pointer; margin-left:0.5rem; font-size:0.85rem;">✕ Remove</span>
                            </div>

                            <div class="emoji-picker" id="emojiPicker" style="display:none; padding:0.5rem; gap:0.3rem; flex-wrap:wrap; border-bottom:1px solid #e2e8f0; margin-bottom:0.5rem;">
                                <button type="button" onclick="insertEmoji('😊')" style="background:none; border:none; font-size:1.4rem; cursor:pointer; padding:2px 4px; border-radius:4px; line-height:1;">😊</button>
                                <button type="button" onclick="insertEmoji('👍')" style="background:none; border:none; font-size:1.4rem; cursor:pointer; padding:2px 4px; border-radius:4px; line-height:1;">👍</button>
                                <button type="button" onclick="insertEmoji('😍')" style="background:none; border:none; font-size:1.4rem; cursor:pointer; padding:2px 4px; border-radius:4px; line-height:1;">😍</button>
                                <button type="button" onclick="insertEmoji('🎉')" style="background:none; border:none; font-size:1.4rem; cursor:pointer; padding:2px 4px; border-radius:4px; line-height:1;">🎉</button>
                                <button type="button" onclick="insertEmoji('🔥')" style="background:none; border:none; font-size:1.4rem; cursor:pointer; padding:2px 4px; border-radius:4px; line-height:1;">🔥</button>
                                <button type="button" onclick="insertEmoji('💯')" style="background:none; border:none; font-size:1.4rem; cursor:pointer; padding:2px 4px; border-radius:4px; line-height:1;">💯</button>
                                <button type="button" onclick="insertEmoji('✅')" style="background:none; border:none; font-size:1.4rem; cursor:pointer; padding:2px 4px; border-radius:4px; line-height:1;">✅</button>
                                <button type="button" onclick="insertEmoji('❓')" style="background:none; border:none; font-size:1.4rem; cursor:pointer; padding:2px 4px; border-radius:4px; line-height:1;">❓</button>
                                <button type="button" onclick="insertEmoji('👋')" style="background:none; border:none; font-size:1.4rem; cursor:pointer; padding:2px 4px; border-radius:4px; line-height:1;">👋</button>
                                <button type="button" onclick="insertEmoji('📸')" style="background:none; border:none; font-size:1.4rem; cursor:pointer; padding:2px 4px; border-radius:4px; line-height:1;">📸</button>
                                <button type="button" onclick="insertEmoji('🚀')" style="background:none; border:none; font-size:1.4rem; cursor:pointer; padding:2px 4px; border-radius:4px; line-height:1;">🚀</button>
                                <button type="button" onclick="insertEmoji('💪')" style="background:none; border:none; font-size:1.4rem; cursor:pointer; padding:2px 4px; border-radius:4px; line-height:1;">💪</button>
                                <button type="button" onclick="insertEmoji('🙏')" style="background:none; border:none; font-size:1.4rem; cursor:pointer; padding:2px 4px; border-radius:4px; line-height:1;">🙏</button>
                                <button type="button" onclick="insertEmoji('😎')" style="background:none; border:none; font-size:1.4rem; cursor:pointer; padding:2px 4px; border-radius:4px; line-height:1;">😎</button>
                                <button type="button" onclick="insertEmoji('💰')" style="background:none; border:none; font-size:1.4rem; cursor:pointer; padding:2px 4px; border-radius:4px; line-height:1;">💰</button>
                            </div>
                            <div class="d-flex gap-2 align-items-start">
                                <div style="flex:1;">
                                    <textarea name="message" id="msgInput" class="form-control" rows="2" placeholder="Type your reply..." style="border-radius:12px; resize:none;"></textarea>
                                </div>
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn btn-outline-secondary rounded-3" onclick="toggleEmojiPicker()" title="Emoji" style="padding:0.4rem 0.7rem;">
                                        <i class="bi bi-emoji-smile"></i>
                                    </button>
                                    <label class="btn btn-outline-secondary rounded-3" style="cursor:pointer; padding:0.4rem 0.7rem;" title="Send Image">
                                        <i class="bi bi-image"></i>
                                        <input type="file" name="image" accept="image/*" onchange="previewImage(event)" style="display:none;">
                                    </label>
                                    <button type="submit" class="btn" style="background:#00d9ff; color:#fff; border-radius:12px; padding:0.4rem 1rem;">
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
                <div class="alert alert-secondary rounded-4 text-center">
                    <i class="bi bi-lock-fill me-1"></i> This conversation is closed.
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
