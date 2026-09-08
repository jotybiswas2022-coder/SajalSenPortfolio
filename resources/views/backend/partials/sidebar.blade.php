<!-- Sidebar (desktop only) -->
<aside class="sidebar" id="sidebarCollapse"
     style="position:fixed; top:0; left:0; bottom:0; width:260px; min-width:260px; background:linear-gradient(180deg,#111827,#1e293b); border-right:none; overflow-y:auto; display:flex; flex-direction:column; z-index:1040; padding-top:57px;">

    {{-- Mobile close button --}}
    <div class="sidebar-close" style="display:none;">
        <button type="button" aria-label="Close sidebar">&times;</button>
    </div>

    <div class="sidebar-header" style="padding:0.9rem 1.2rem; border-bottom:1px solid rgba(255,255,255,0.06); margin-bottom:0.25rem; flex-shrink:0;">
        <a href="/admin" class="brand"
           style="font-size:1rem; font-weight:800; color:#fff; text-decoration:none; display:flex; align-items:center; gap:0.55rem; letter-spacing:-0.2px;">
            <i class="bi bi-grid-1x2-fill" style="font-size:1.2rem; color:#00d9ff;"></i>
            <span style="background:linear-gradient(135deg,#fff 60%,#94a3b8); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;">{{ __('messages.admin') }} Panel</span>
        </a>
    </div>

    <ul class="sidebar-menu" style="list-style:none; padding:0; margin:0; flex:1;">
        <li style="margin-bottom:1px;">
            <a href="{{ route('admin.dashboard.index') }}"
               class="{{ request()->is('admin') ? 'active' : '' }}"
               style="display:flex; align-items:center; gap:10px; padding:7px 14px; margin:0 8px; color:rgba(255,255,255,0.6); text-decoration:none; font-weight:500; font-size:0.875rem; border-radius:8px; border-left:none; transition:all 0.2s cubic-bezier(0.16,1,0.3,1); position:relative;">
                <i class="bi bi-speedometer2" style="font-size:15px; width:20px; text-align:center; color:rgba(255,255,255,0.35); transition:all 0.2s; flex-shrink:0;"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li style="margin-bottom:1px;">
            <a href="{{ route('admin.account.index') }}"
               class="{{ request()->is('admin/account') ? 'active' : '' }}"
               style="display:flex; align-items:center; gap:10px; padding:7px 14px; margin:0 8px; color:rgba(255,255,255,0.6); text-decoration:none; font-weight:500; font-size:0.875rem; border-radius:8px; border-left:none; transition:all 0.2s cubic-bezier(0.16,1,0.3,1); position:relative;">
                <i class="bi bi-person-circle" style="font-size:15px; width:20px; text-align:center; color:rgba(255,255,255,0.35); transition:all 0.2s; flex-shrink:0;"></i>
                <span>Account</span>
            </a>
        </li>
        <li style="margin-bottom:1px;">
            <a href="{{ route('admin.services.index') }}"
               class="{{ request()->is('admin/services*') ? 'active' : '' }}"
               style="display:flex; align-items:center; gap:10px; padding:7px 14px; margin:0 8px; color:rgba(255,255,255,0.6); text-decoration:none; font-weight:500; font-size:0.875rem; border-radius:8px; border-left:none; transition:all 0.2s cubic-bezier(0.16,1,0.3,1); position:relative;">
                <i class="bi bi-gear" style="font-size:15px; width:20px; text-align:center; color:rgba(255,255,255,0.35); transition:all 0.2s; flex-shrink:0;"></i>
                <span>Services</span>
            </a>
        </li>
        <li style="margin-bottom:1px;">
            <a href="{{ route('admin.casestudies.index') }}"
               class="{{ request()->is('admin/case-studies*') ? 'active' : '' }}"
               style="display:flex; align-items:center; gap:10px; padding:7px 14px; margin:0 8px; color:rgba(255,255,255,0.6); text-decoration:none; font-weight:500; font-size:0.875rem; border-radius:8px; border-left:none; transition:all 0.2s cubic-bezier(0.16,1,0.3,1); position:relative;">
                <i class="bi bi-journal-code" style="font-size:15px; width:20px; text-align:center; color:rgba(255,255,255,0.35); transition:all 0.2s; flex-shrink:0;"></i>
                <span>Case studies</span>
            </a>
        </li>
        <li style="margin-bottom:1px;">
            <a href="{{ route('admin.experiences.index') }}"
               class="{{ request()->is('admin/experiences*') ? 'active' : '' }}"
               style="display:flex; align-items:center; gap:10px; padding:7px 14px; margin:0 8px; color:rgba(255,255,255,0.6); text-decoration:none; font-weight:500; font-size:0.875rem; border-radius:8px; border-left:none; transition:all 0.2s cubic-bezier(0.16,1,0.3,1); position:relative;">
                <i class="bi bi-briefcase" style="font-size:15px; width:20px; text-align:center; color:rgba(255,255,255,0.35); transition:all 0.2s; flex-shrink:0;"></i>
                <span>Experience</span>
            </a>
        </li>
        <li style="margin-bottom:1px;">
            <a href="{{ route('admin.education.index') }}"
               class="{{ request()->is('admin/education*') ? 'active' : '' }}"
               style="display:flex; align-items:center; gap:10px; padding:7px 14px; margin:0 8px; color:rgba(255,255,255,0.6); text-decoration:none; font-weight:500; font-size:0.875rem; border-radius:8px; border-left:none; transition:all 0.2s cubic-bezier(0.16,1,0.3,1); position:relative;">
                <i class="bi bi-mortarboard" style="font-size:15px; width:20px; text-align:center; color:rgba(255,255,255,0.35); transition:all 0.2s; flex-shrink:0;"></i>
                <span>Education</span>
            </a>
        </li>
        <li style="margin-bottom:1px;">
            <a href="{{ route('admin.skills.index') }}"
               class="{{ request()->is('admin/skills*') ? 'active' : '' }}"
               style="display:flex; align-items:center; gap:10px; padding:7px 14px; margin:0 8px; color:rgba(255,255,255,0.6); text-decoration:none; font-weight:500; font-size:0.875rem; border-radius:8px; border-left:none; transition:all 0.2s cubic-bezier(0.16,1,0.3,1); position:relative;">
                <i class="bi bi-lightning-charge" style="font-size:15px; width:20px; text-align:center; color:rgba(255,255,255,0.35); transition:all 0.2s; flex-shrink:0;"></i>
                <span>Skills</span>
            </a>
        </li>
        <li style="margin-bottom:1px;">
            <a href="{{ route('admin.gigs.index') }}"
               class="{{ request()->is('admin/gigs*') ? 'active' : '' }}"
               style="display:flex; align-items:center; gap:10px; padding:7px 14px; margin:0 8px; color:rgba(255,255,255,0.6); text-decoration:none; font-weight:500; font-size:0.875rem; border-radius:8px; border-left:none; transition:all 0.2s cubic-bezier(0.16,1,0.3,1); position:relative;">
                <i class="bi bi-music-note-list" style="font-size:15px; width:20px; text-align:center; color:rgba(255,255,255,0.35); transition:all 0.2s; flex-shrink:0;"></i>
                <span>Gigs</span>
            </a>
        </li>
        <li style="margin-bottom:1px;">
            <a href="{{ route('admin.testimonials.index') }}"
               class="{{ request()->is('admin/testimonials*') ? 'active' : '' }}"
               style="display:flex; align-items:center; gap:10px; padding:7px 14px; margin:0 8px; color:rgba(255,255,255,0.6); text-decoration:none; font-weight:500; font-size:0.875rem; border-radius:8px; border-left:none; transition:all 0.2s cubic-bezier(0.16,1,0.3,1); position:relative;">
                <i class="bi bi-chat-quote" style="font-size:15px; width:20px; text-align:center; color:rgba(255,255,255,0.35); transition:all 0.2s; flex-shrink:0;"></i>
                <span>Testimonials</span>
            </a>
        </li>
        <li style="margin-bottom:1px;">
            <a href="{{ route('admin.faqs.index') }}"
               class="{{ request()->is('admin/faqs*') ? 'active' : '' }}"
               style="display:flex; align-items:center; gap:10px; padding:7px 14px; margin:0 8px; color:rgba(255,255,255,0.6); text-decoration:none; font-weight:500; font-size:0.875rem; border-radius:8px; border-left:none; transition:all 0.2s cubic-bezier(0.16,1,0.3,1); position:relative;">
                <i class="bi bi-question-circle" style="font-size:15px; width:20px; text-align:center; color:rgba(255,255,255,0.35); transition:all 0.2s; flex-shrink:0;"></i>
                <span>FAQs</span>
            </a>
        </li>
        <li style="margin-bottom:1px;">
            <a href="{{ route('admin.inbox.index') }}"
               class="{{ request()->is('admin/inbox*') ? 'active' : '' }}"
               style="display:flex; align-items:center; gap:10px; padding:7px 14px; margin:0 8px; color:rgba(255,255,255,0.6); text-decoration:none; font-weight:500; font-size:0.875rem; border-radius:8px; border-left:none; transition:all 0.2s cubic-bezier(0.16,1,0.3,1); position:relative;">
                <i class="bi bi-chat-dots" style="font-size:15px; width:20px; text-align:center; color:rgba(255,255,255,0.35); transition:all 0.2s; flex-shrink:0;"></i>
                <span>Inbox</span>
            </a>
        </li>
        <li style="margin-bottom:1px;">
            <a href="{{ route('admin.contact.index') }}"
               class="{{ request()->is('admin/contact') ? 'active' : '' }}"
               style="display:flex; align-items:center; gap:10px; padding:7px 14px; margin:0 8px; color:rgba(255,255,255,0.6); text-decoration:none; font-weight:500; font-size:0.875rem; border-radius:8px; border-left:none; transition:all 0.2s cubic-bezier(0.16,1,0.3,1); position:relative;">
                <i class="bi bi-envelope-paper" style="font-size:15px; width:20px; text-align:center; color:rgba(255,255,255,0.35); transition:all 0.2s; flex-shrink:0;"></i>
                <span>Messages</span>
            </a>
        </li>
    </ul>

    {{-- Bottom section: Home + Logout (visible on mobile, always in sidebar) --}}
    <div class="sidebar-bottom" style="border-top:1px solid rgba(255,255,255,0.06); padding:0.5rem 0; flex-shrink:0;">
        <ul class="sidebar-menu" style="list-style:none; padding:0; margin:0;">
            <li style="margin-bottom:1px;">
                <a href="/"
                   style="display:flex; align-items:center; gap:10px; padding:7px 14px; margin:0 8px; color:rgba(255,255,255,0.6); text-decoration:none; font-weight:500; font-size:0.875rem; border-radius:8px; transition:all 0.2s cubic-bezier(0.16,1,0.3,1); position:relative;">
                    <i class="bi bi-house-door" style="font-size:15px; width:20px; text-align:center; color:rgba(255,255,255,0.35); transition:all 0.2s; flex-shrink:0;"></i>
                    <span>Home</span>
                </a>
            </li>
            <li style="margin-bottom:1px;">
                <form action="{{ route('logout') }}" method="POST" style="margin:0 0;">
                    @csrf
                    <button type="submit"
                       style="display:flex; align-items:center; gap:10px; padding:7px 14px; margin:0 8px; color:rgba(248,113,113,0.8); text-decoration:none; font-weight:500; font-size:0.875rem; border-radius:8px; border:none; background:none; width:calc(100% - 16px); cursor:pointer; font-family:inherit; transition:all 0.2s cubic-bezier(0.16,1,0.3,1); position:relative;">
                        <i class="bi bi-box-arrow-right" style="font-size:15px; width:20px; text-align:center; color:rgba(248,113,113,0.5); transition:all 0.2s; flex-shrink:0;"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>

<style>
/* Sidebar hover & active states (inline CSS can't handle :hover, ::after) */
.sidebar-menu a::after {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%) scaleY(0);
    width: 3px;
    height: 18px;
    border-radius: 0 3px 3px 0;
    background: #00d9ff;
    transition: transform 0.2s cubic-bezier(0.16, 1, 0.3, 1);
}
.sidebar-menu a:hover {
    background: rgba(0,217,255,0.1);
    color: #fff;
    padding-left: 16px;
}
.sidebar-menu a:hover i {
    color: #b3f0ff;
}
.sidebar-menu a.active {
    background: rgba(0,217,255,0.15);
    color: #fff;
    font-weight: 600;
    padding-left: 16px;
}
.sidebar-menu a.active::after {
    transform: translateY(-50%) scaleY(1);
}
.sidebar-menu a.active i {
    color: #7ce6ff;
}

/* Sidebar bottom hover */
.sidebar-bottom .sidebar-menu a:hover {
    background: rgba(0,217,255,0.1);
    color: #fff;
    padding-left: 16px;
}
.sidebar-bottom .sidebar-menu a:hover i {
    color: #b3f0ff;
}
.sidebar-bottom .sidebar-menu form button:hover {
    background: rgba(248,113,113,0.1);
    color: #f87171;
    padding-left: 16px;
}
.sidebar-bottom .sidebar-menu form button:hover i {
    color: #f87171;
}

/* Sidebar custom scrollbar */
#sidebarCollapse::-webkit-scrollbar { width: 4px; }
#sidebarCollapse::-webkit-scrollbar-track { background: transparent; }
#sidebarCollapse::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
#sidebarCollapse::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }

/* ===== Off-canvas mobile ===== */
@media (max-width: 767.98px) {
    #sidebarCollapse {
        transform: translateX(-100%);
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: none;
        height: 100vh;
        height: 100dvh;
        padding-top: 57px;
    }
    #sidebarCollapse.open {
        transform: translateX(0);
        box-shadow: 4px 0 30px rgba(0,0,0,0.3);
    }
    .sidebar-close {
        display: flex !important;
        justify-content: flex-end;
        padding: 0.3rem 0.6rem;
        border-bottom: 1px solid rgba(255,255,255,0.06);
        position: sticky;
        top: 0;
        z-index: 1;
    }
    .sidebar-close button {
        background: none;
        border: none;
        color: rgba(255,255,255,0.5);
        font-size: 1.2rem;
        cursor: pointer;
        padding: 0.2rem 0.4rem;
        border-radius: 6px;
        transition: all 0.2s;
    }
    .sidebar-close button:hover {
        color: #fff;
        background: rgba(255,255,255,0.08);
    }
    .sidebar-header {
        padding: 0.6rem 1rem !important;
    }
    .sidebar-menu a,
    .sidebar-bottom .sidebar-menu a,
    .sidebar-bottom .sidebar-menu form button {
        font-size: 0.8rem !important;
        padding: 5px 12px !important;
    }
    .sidebar-menu a i,
    .sidebar-bottom .sidebar-menu a i,
    .sidebar-bottom .sidebar-menu form button i {
        font-size: 13px !important;
        width: 18px !important;
    }
    .sidebar-header .brand {
        font-size: 0.82rem !important;
    }
    .sidebar-header .brand i {
        font-size: 1rem !important;
    }
}
</style>
