@extends('frontend.app')

@section('content')
<style>
    /* ===== CSS variables ===== */
    body { font-family: 'Poppins', 'Hind Siliguri', sans-serif; background: #080b12; margin:0; padding:0; }

    :root {
        --bg-primary: #080b12;
        --bg-secondary: #111827;
        --bg-card: rgba(17, 24, 39, 0.8);
        --accent: #00d9ff;
        --accent-light: #7ce6ff;
        --text-primary: #f1f5f9;
        --text-secondary: #94a3b8;
        --text-muted: #94a3b8;
        --border-color: #1e293b;
        --border-hover: rgba(0, 217, 255, 0.3);
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 20px;
        --radius-xl: 24px;
        --transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* ===== CHAT PAGE — MODERN GLASS DESIGN ===== */
    .chat-page {
        padding-top: 100px;
        padding-bottom: 4rem;
        min-height: 100vh;
        background: linear-gradient(180deg, var(--bg-primary) 0%, #080b12 100%);
    }
    html.light-theme {
        --text-primary: #111827;
        --text-secondary: #475569;
        --text-muted: #94a3b8;
        --border-color: #e2e8f0;
        --bg-card: rgba(255, 255, 255, 0.9);
    }
    html.light-theme .chat-page {
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
    }
    html.light-theme body { background: #f8fafc; }

    .chat-container {
        max-width: 820px;
        margin: 0 auto;
    }

    /* ===== HEADER ===== */
    .chat-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding: 1rem 1.4rem;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        transition: all 0.3s ease;
    }
    .chat-header:hover {
        border-color: var(--border-hover);
        box-shadow: 0 4px 20px rgba(0, 217, 255, 0.05);
    }
    .chat-header .back-btn {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-secondary);
        text-decoration: none;
        font-size: 1.1rem;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        flex-shrink: 0;
        background: rgba(0, 217, 255, 0.06);
        border: 1px solid var(--border-color);
    }
    .chat-header .back-btn:hover {
        background: rgba(0, 217, 255, 0.12);
        color: var(--accent-light);
        transform: translateX(-3px);
    }
    .chat-header .header-info {
        flex: 1;
        min-width: 0;
    }
    .chat-header .header-info h2 {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        letter-spacing: -0.2px;
    }
    .chat-header .header-info .header-sub {
        font-size: 0.78rem;
        color: var(--text-muted);
        margin-top: 0.1rem;
    }
    .chat-header .header-status {
        flex-shrink: 0;
    }
    .header-status .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.35rem 0.9rem;
        border-radius: 20px;
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    .header-status .status-badge.open {
        background: rgba(34, 197, 94, 0.1);
        color: #22c55e;
        border: 1px solid rgba(34, 197, 94, 0.15);
        box-shadow: 0 0 12px rgba(34, 197, 94, 0.08);
    }
    .header-status .status-badge.closed {
        background: rgba(248, 113, 113, 0.08);
        color: #f87171;
        border: 1px solid rgba(248, 113, 113, 0.12);
    }

    /* ===== Package summary ===== */
    .package-summary {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 1.2rem 1.5rem;
        margin-bottom: 1.5rem;
        position: relative;
        overflow: hidden;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        transition: all 0.3s ease;
    }
    .package-summary::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 3px;
        height: 100%;
        background: linear-gradient(180deg, #00d9ff, #00ff88);
        border-radius: 0 3px 3px 0;
    }
    .package-summary:hover {
        border-color: var(--border-hover);
        box-shadow: 0 4px 20px rgba(0, 217, 255, 0.05);
    }
    .package-summary .pkg-header {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.4rem;
    }
    .package-summary .pkg-header h5 {
        font-size: 0.72rem;
        color: var(--text-muted);
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        font-weight: 600;
    }
    .package-summary .pkg-header .pkg-icon {
        font-size: 0.8rem;
        color: var(--accent-light);
    }
    .package-summary .pkg-body {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.75rem 1.5rem;
    }
    .package-summary .pkg-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--accent-light);
    }
    .package-summary .pkg-price {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-primary);
    }
    .package-summary .pkg-price span {
        font-size: 0.75rem;
        font-weight: 500;
        color: var(--text-muted);
    }
    .package-summary .pkg-details {
        width: 100%;
        margin-top: 0.5rem;
        padding-top: 0.6rem;
        border-top: 1px solid var(--border-color);
        font-size: 0.85rem;
        color: var(--text-secondary);
        white-space: pre-line;
        line-height: 1.6;
    }

    /* ===== Messages box ===== */
    .messages-box {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        margin-bottom: 1rem;
        max-height: 520px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 1.2rem;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        position: relative;
    }
    .messages-box::-webkit-scrollbar { width: 4px; }
    .messages-box::-webkit-scrollbar-track { background: transparent; }
    .messages-box::-webkit-scrollbar-thumb { background: rgba(0,217,255,0.25); border-radius: 2px; }
    .messages-box::-webkit-scrollbar-thumb:hover { background: rgba(0,217,255,0.4); }

    /* Date divider */
    .msg-date-divider {
        text-align: center;
        margin: 0.5rem 0;
        position: relative;
    }
    .msg-date-divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: var(--border-color);
    }
    .msg-date-divider span {
        display: inline-block;
        padding: 0.2rem 1rem;
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        font-size: 0.7rem;
        color: var(--text-muted);
        font-weight: 500;
        position: relative;
        z-index: 1;
    }

    /* ===== Single message ===== */
    .message {
        display: flex;
        gap: 0.75rem;
        max-width: 85%;
        animation: msgFadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
        transform: translateY(12px);
    }
    @keyframes msgFadeIn {
        to { opacity: 1; transform: translateY(0); }
    }
    .message.incoming { align-self: flex-start; }
    .message.outgoing { align-self: flex-end; flex-direction: row-reverse; }

    .msg-avatar {
        width: 34px;
        height: 34px;
        min-width: 34px;
        border-radius: 12px;
        background: linear-gradient(135deg, #00d9ff, #00ff88);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
        box-shadow: 0 2px 10px rgba(0, 217, 255, 0.15);
    }
    .message.outgoing .msg-avatar {
        background: linear-gradient(135deg, #00d9ff, #00ff88);
        box-shadow: 0 2px 10px rgba(0, 217, 255, 0.2);
    }

    .msg-bubble {
        padding: 0.75rem 1.1rem;
        border-radius: 18px;
        font-size: 0.92rem;
        line-height: 1.55;
        word-break: break-word;
        position: relative;
    }
    .message.incoming .msg-bubble {
        background: rgba(0, 217, 255, 0.06);
        border: 1px solid rgba(0, 217, 255, 0.1);
        color: var(--text-primary);
        border-bottom-left-radius: 4px;
    }
    .message.outgoing .msg-bubble {
        background: linear-gradient(135deg, rgba(0, 217, 255, 0.12), rgba(0, 217, 255, 0.1));
        border: 1px solid rgba(0, 217, 255, 0.18);
        color: var(--text-primary);
        border-bottom-right-radius: 4px;
    }
    html.light-theme .message.outgoing .msg-bubble {
        background: linear-gradient(135deg, rgba(0, 217, 255, 0.08), rgba(0, 217, 255, 0.06));
    }
    .msg-bubble .sender-label {
        font-size: 0.68rem;
        font-weight: 600;
        color: var(--accent-light);
        margin-bottom: 0.25rem;
        display: block;
    }
    .msg-bubble .msg-text {
        display: block;
    }
    .msg-bubble img.msg-text,
    .msg-bubble .msg-text img {
        max-width: 260px;
        max-height: 260px;
        width: auto;
        height: auto;
        border-radius: 12px;
        margin-top: 0.4rem;
        display: block;
        border: 1px solid var(--border-color);
        object-fit: cover;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    }
    .message.outgoing img.msg-text {
        border-color: rgba(0, 217, 255, 0.25);
    }
    .msg-bubble .msg-time {
        display: block;
        font-size: 0.65rem;
        color: var(--text-muted);
        margin-top: 0.5rem;
        opacity: 0.7;
    }

    /* ===== EMPTY MESSAGES ===== */
    .messages-empty {
        text-align: center;
        padding: 3rem 2rem;
        color: var(--text-muted);
    }
    .messages-empty i {
        font-size: 2.5rem;
        display: block;
        margin-bottom: 0.75rem;
        opacity: 0.5;
    }
    .messages-empty p {
        font-size: 0.9rem;
    }

    /* ===== Chat form ===== */
    .chat-form {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 1.2rem;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        transition: all 0.3s ease;
    }
    .chat-form:focus-within {
        border-color: rgba(0, 217, 255, 0.3);
        box-shadow: 0 4px 20px rgba(0, 217, 255, 0.05);
    }

    /* Emoji picker */
    .emoji-picker {
        display: none;
        padding: 0.6rem 0.5rem 0.5rem;
        gap: 0.25rem;
        flex-wrap: wrap;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 0.75rem;
    }
    .emoji-picker.open { display: flex; }
    .emoji-picker button {
        background: none;
        border: none;
        font-size: 1.3rem;
        cursor: pointer;
        padding: 3px 5px;
        border-radius: 6px;
        transition: background 0.2s, transform 0.2s;
        line-height: 1;
    }
    .emoji-picker button:hover {
        background: rgba(0, 217, 255, 0.1);
        transform: scale(1.2);
    }

    /* Image preview */
    #imagePreview {
        display: none;
        padding: 0.6rem 0;
        border-top: 1px solid var(--border-color);
        margin-top: 0.5rem;
        align-items: center;
        gap: 0.75rem;
    }
    #imagePreview img {
        max-width: 100px;
        max-height: 100px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        object-fit: cover;
    }
    #imagePreview .remove-image {
        color: #f87171;
        cursor: pointer;
        font-size: 0.82rem;
        font-weight: 500;
        transition: color 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }
    #imagePreview .remove-image:hover { color: #ef4444; }

    /* ===== INPUT GROUP ===== */
    .input-group {
        display: flex;
        gap: 0.5rem;
        align-items: flex-end;
    }
    .input-group textarea {
        flex: 1;
        background: rgba(255,255,255,0.03);
        border: 1.5px solid var(--border-color);
        border-radius: 14px;
        color: var(--text-primary);
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
        font-family: 'Poppins', 'Hind Siliguri', sans-serif;
        resize: none;
        min-height: 46px;
        max-height: 130px;
        outline: none;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        line-height: 1.5;
    }
    html.light-theme .input-group textarea { background: #fff; color: #1e293b; border-color: #e2e8f0; }
    html.light-theme .input-group textarea:focus { border-color: #00d9ff; box-shadow: 0 0 0 3px rgba(0, 217, 255, 0.1); }
    .input-group textarea:focus {
        border-color: #00d9ff;
        box-shadow: 0 0 0 3px rgba(0, 217, 255, 0.06);
    }

    .input-group .action-btn {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        border: 1.5px solid var(--border-color);
        background: rgba(255,255,255,0.03);
        color: var(--text-secondary);
        font-size: 1.15rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        padding: 0;
        flex-shrink: 0;
        position: relative;
        overflow: hidden;
    }
    .input-group .action-btn:hover {
        border-color: var(--border-hover);
        color: var(--accent-light);
        background: rgba(0, 217, 255, 0.06);
        transform: translateY(-2px);
    }
    .input-group .action-btn.image-btn input[type="file"] {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    .input-group .send-btn {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        border: none;
        background: linear-gradient(135deg, #00d9ff, #00a2c9);
        color: #fff;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 4px 15px rgba(0,217,255,0.3);
        flex-shrink: 0;
        padding: 0;
    }
    .input-group .send-btn:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 25px rgba(0,217,255,0.4);
    }
    .input-group .send-btn:active {
        transform: translateY(-1px) scale(0.98);
    }

    /* Closed conversation */
    .conversation-closed {
        text-align: center;
        padding: 1.2rem;
        color: var(--text-muted);
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    /* ===== Responsive ===== */
    @media (max-width: 768px) {
        .chat-page { padding-top: 85px; }
        .messages-box { max-height: 420px; padding: 1.2rem; }
        .message { max-width: 92%; }
        .chat-header { padding: 0.85rem 1.1rem; }
        .chat-header .header-info h2 { font-size: 1rem; }
        .package-summary { padding: 1rem 1.2rem; }
        .chat-form { padding: 1rem; }
    }
    @media (max-width: 480px) {
        .chat-page { padding-top: 75px; }
        .messages-box { max-height: 360px; padding: 1rem; gap: 1rem; }
        .message { max-width: 95%; }
        .msg-avatar { width: 28px; height: 28px; min-width: 28px; font-size: 0.7rem; border-radius: 10px; }
        .msg-bubble { padding: 0.6rem 0.9rem; font-size: 0.85rem; border-radius: 14px; }
        .chat-header { padding: 0.75rem 0.9rem; gap: 0.65rem; }
        .chat-header .back-btn { width: 32px; height: 32px; font-size: 0.9rem; }
        .chat-header .header-info h2 { font-size: 0.9rem; }
        .header-status .status-badge { font-size: 0.65rem; padding: 0.25rem 0.65rem; }
        .package-summary { padding: 0.8rem 1rem; }
        .package-summary .pkg-name { font-size: 0.95rem; }
        .chat-form { padding: 0.8rem; }
        .input-group textarea { padding: 0.6rem 0.8rem; font-size: 0.85rem; min-height: 40px; }
        .input-group .action-btn, .input-group .send-btn { width: 40px; height: 40px; font-size: 1rem; }
    }
</style>

<div class="chat-page">
    <div class="container">
        <div class="chat-container">
            {{-- Header --}}
            <div class="chat-header">
                <a href="{{ route('inbox.index') }}" class="back-btn" title="{{ __('messages.back_to_inbox') }}">
                    <i class="bi bi-arrow-left"></i>
                </a>
                <div class="header-info">
                    <h2>{{ $conversation->subject }}</h2>
                    <div class="header-sub">{{ $conversation->messages->count() }} {{ $conversation->messages->count() === 1 ? __('messages.message') : __('messages.messages') }}</div>
                </div>
                <div class="header-status">
                    <span class="status-badge {{ $conversation->status }}">
                        <i class="bi bi-{{ $conversation->status == 'open' ? 'unlock' : 'lock' }}-fill"></i>
                        {{ ucfirst($conversation->status) }}
                    </span>
                </div>
            </div>

            {{-- Package Summary --}}
            @if($conversation->package_name)
            <div class="package-summary">
                <div class="pkg-header">
                    <i class="bi bi-box-seam pkg-icon"></i>
                    <h5>{{ __('messages.package_details') }}</h5>
                </div>
                <div class="pkg-body">
                    <span class="pkg-name">{{ $conversation->package_name }}</span>
                    <span class="pkg-price">{{ number_format($conversation->package_price, 2) }} <span>USD</span></span>
                    @if($conversation->package_details)
                        <div class="pkg-details">{{ $conversation->package_details }}</div>
                    @endif
                </div>
            </div>
            @endif

            {{-- Messages Box --}}
            <div class="messages-box" id="messagesBox">
                @forelse($conversation->messages as $msg)
                    @php $isMine = $msg->sender_id == auth()->id(); @endphp
                    <div class="message {{ $isMine ? 'outgoing' : 'incoming' }}">
                        <div class="msg-avatar">{{ substr($msg->sender->name, 0, 1) }}</div>
                        <div class="msg-bubble">
                            @if($msg->sender->is_admin)
                                <span class="sender-label"><i class="bi bi-shield-check me-1"></i>Support</span>
                            @endif
                            @if($msg->message)
                                <span class="msg-text">{!! nl2br(e($msg->message)) !!}</span>
                            @endif
                            @if($msg->image)
                                <img src="{{ config('app.storage_url') }}{{ $msg->image }}" alt="Shared image" class="msg-text">
                            @endif
                            <span class="msg-time">{{ $msg->created_at->format('g:i A') }} · {{ $msg->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @empty
                    <div class="messages-empty">
                        <i class="bi bi-chat-dots"></i>
                        <p>{{ __('messages.no_messages_yet') }}</p>
                    </div>
                @endforelse
            </div>

            {{-- Chat Form --}}
            @if($conversation->status == 'open')
            <form method="POST" action="{{ route('inbox.send', $conversation->id) }}" enctype="multipart/form-data" class="chat-form">
                @csrf

                {{-- Emoji Picker --}}
                <div class="emoji-picker" id="emojiPicker">
                    <button type="button" onclick="insertEmoji('😊')">😊</button>
                    <button type="button" onclick="insertEmoji('👍')">👍</button>
                    <button type="button" onclick="insertEmoji('😍')">😍</button>
                    <button type="button" onclick="insertEmoji('🎉')">🎉</button>
                    <button type="button" onclick="insertEmoji('🔥')">🔥</button>
                    <button type="button" onclick="insertEmoji('💯')">💯</button>
                    <button type="button" onclick="insertEmoji('✅')">✅</button>
                    <button type="button" onclick="insertEmoji('❓')">❓</button>
                    <button type="button" onclick="insertEmoji('👋')">👋</button>
                    <button type="button" onclick="insertEmoji('📸')">📸</button>
                    <button type="button" onclick="insertEmoji('🚀')">🚀</button>
                    <button type="button" onclick="insertEmoji('💪')">💪</button>
                    <button type="button" onclick="insertEmoji('🙏')">🙏</button>
                    <button type="button" onclick="insertEmoji('😎')">😎</button>
                    <button type="button" onclick="insertEmoji('💰')">💰</button>
                </div>

                {{-- Image Preview --}}
                <div id="imagePreview">
                    <img id="previewImg" src="" alt="Preview">
                    <span class="remove-image" onclick="clearImageInput()">
                        <i class="bi bi-x-circle"></i> {{ __('messages.remove') }}
                    </span>
                </div>

                {{-- Input Row --}}
                <div class="input-group">
                    <textarea name="message" id="messageInput" rows="1" placeholder="{{ __('messages.type_message') }}" autocomplete="off"></textarea>
                    <button type="button" class="action-btn" onclick="toggleEmojiPicker()" title="Emoji">
                        <i class="bi bi-emoji-smile"></i>
                    </button>
                    <label class="action-btn image-btn" title="{{ __('messages.send_image') }}">
                        <i class="bi bi-image"></i>
                        <input type="file" name="image" accept="image/*" onchange="previewSelectedImage(event)">
                    </label>
                    <button type="submit" class="send-btn" title="{{ __('messages.send') }}">
                        <i class="bi bi-send-fill"></i>
                    </button>
                </div>

                @error('message')<div style="color:#f87171; font-size:0.8rem; margin-top:0.4rem;">{{ $message }}</div>@enderror
                @error('image')<div style="color:#f87171; font-size:0.8rem; margin-top:0.4rem;">{{ $message }}</div>@enderror
            </form>
            @else
                <div class="conversation-closed">
                    <i class="bi bi-lock-fill"></i>
                    {{ __('messages.conversation_closed') }}
                </div>
            @endif

        </div>
    </div>
</div>

<script>
    function toggleEmojiPicker() {
        document.getElementById('emojiPicker').classList.toggle('open');
    }
    function insertEmoji(emoji) {
        const input = document.getElementById('messageInput');
        const start = input.selectionStart;
        const end = input.selectionEnd;
        input.value = input.value.substring(0, start) + emoji + input.value.substring(end);
        input.focus();
        input.selectionStart = input.selectionEnd = start + emoji.length;
        autoResize(input);
    }
    function previewSelectedImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'flex';
            };
            reader.readAsDataURL(file);
        }
    }
    function clearImageInput() {
        document.querySelector('input[name="image"]').value = '';
        document.getElementById('imagePreview').style.display = 'none';
        document.getElementById('previewImg').src = '';
    }
    function autoResize(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = Math.min(textarea.scrollHeight, 130) + 'px';
    }
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.getElementById('messageInput');
        if (textarea) {
            textarea.addEventListener('input', function() { autoResize(this); });
            textarea.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    this.closest('form').submit();
                }
            });
        }
        const box = document.getElementById('messagesBox');
        if (box) box.scrollTop = box.scrollHeight;
    });
</script>
@endsection
