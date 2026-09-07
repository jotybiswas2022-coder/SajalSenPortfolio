$ErrorActionPreference = 'Stop'

$commits = @(
    # ============================================================
    # lang/en/messages.php (4 commits)
    # ============================================================
    @{
        File = 'lang/en/messages.php'
        Old = "'stat_years'     => 'Years Exp',"
        New = "'stat_years'     => 'Years of Experience',"
        Subject = "fix: expand 'Years Exp' to 'Years of Experience'"
        Body = "Improve clarity by spelling out 'Experience' instead of abbreviating"
    }
    @{
        File = 'lang/en/messages.php'
        Old = "'copyright'        => 'Made with',"
        New = "'copyright'        => 'Made with love',"
        Subject = "fix: improve footer copyright text"
        Body = "Add 'love' to the copyright message for a warmer tone"
    }
    @{
        File = 'lang/en/messages.php'
        Old = "'and_lots_of'      => 'and lots of',"
        New = "'and_lots_of'      => 'and lots of coffee',"
        Subject = "fix: complete the 'and lots of' message"
        Body = "Finish the sentence with 'coffee' for a personal touch"
    }
    @{
        File = 'lang/en/messages.php'
        Old = "'no_conversations_desc' => 'Order a gig to start a conversation with the admin.',"
        New = "'no_conversations_desc' => 'Order a gig to start a conversation with an admin.',"
        Subject = "fix: change 'the admin' to 'an admin'"
        Body = "Use indefinite article for the generic role"
    }

    # ============================================================
    # app/Http/Controllers/SiteController.php (4 commits)
    # ============================================================
    @{
        File = 'app/Http/Controllers/SiteController.php'
        Old = "    public function index(): \Illuminate\View\View{"
        New = "    public function index(): \Illuminate\View\View {"
        Subject = "style: add space before brace in index method"
        Body = "Fix missing whitespace before opening brace for PSR-12 compliance"
    }
    @{
        File = 'app/Http/Controllers/SiteController.php'
        Old = "    public function gigDetail(`$id): \Illuminate\View\View{"
        New = "    public function gigDetail(`$id): \Illuminate\View\View {"
        Subject = "style: add space before brace in gigDetail method"
        Body = "Fix missing whitespace before opening brace for PSR-12 compliance"
    }
    @{
        File = 'app/Http/Controllers/SiteController.php'
        Old = "    public function caseStudyDetail(`$id): \Illuminate\View\View{"
        New = "    public function caseStudyDetail(`$id): \Illuminate\View\View {"
        Subject = "style: add space before brace in caseStudyDetail method"
        Body = "Fix missing whitespace before opening brace for PSR-12 compliance"
    }
    @{
        File = 'app/Http/Controllers/SiteController.php'
        Old = "    public function projectDetail(`$id): \Illuminate\View\View{"
        New = "    public function projectDetail(`$id): \Illuminate\View\View {"
        Subject = "style: add space before brace in projectDetail method"
        Body = "Fix missing whitespace before opening brace for PSR-12 compliance"
    }

    # ============================================================
    # resources/views/frontend/index.blade.php (9 commits)
    # ============================================================
    @{
        File = 'resources/views/frontend/index.blade.php'
        Old = '    /* ===== HERO DECORATIVE EFFECTS ===== */'
        New = '    /* ===== Hero Decorative Effects ===== */'
        Subject = "style: normalize CSS comment - hero decorative effects"
        Body = "Use title case for section comment consistency"
    }
    @{
        File = 'resources/views/frontend/index.blade.php'
        Old = '    /* SVG Stripes Container */'
        New = '    /* SVG stripes container */'
        Subject = "style: normalize CSS comment - SVG stripes"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/index.blade.php'
        Old = '    /* Glow Disc */'
        New = '    /* Glow disc */'
        Subject = "style: normalize CSS comment - glow disc"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/index.blade.php'
        Old = '    /* ===== SERVICES — PURE WATER WAVE EFFECT (no boxes, no grid) ===== */'
        New = '    /* ===== Services - Pure Water Wave Effect ===== */'
        Subject = "style: simplify services section CSS comment"
        Body = "Shorten and normalize the section comment for services"
    }
    @{
        File = 'resources/views/frontend/index.blade.php'
        Old = '    /* ── Case Studies ── */'
        New = '    /* Case studies section */'
        Subject = "style: normalize case studies CSS comment"
        Body = "Use consistent comment format for case studies section"
    }
    @{
        File = 'resources/views/frontend/index.blade.php'
        Old = '    /* ===== GLASS CARD SHINE EFFECT (all glass cards) ===== */'
        New = '    /* ===== Glass Card Shine Effect ===== */'
        Subject = "style: normalize glass card shine CSS comment"
        Body = "Use title case for section comment consistency"
    }
    @{
        File = 'resources/views/frontend/index.blade.php'
        Old = '    /* Timeline */'
        New = '    /* Timeline section */'
        Subject = "style: clarify timeline CSS comment"
        Body = "Add 'section' for clarity in CSS comment"
    }
    @{
        File = 'resources/views/frontend/index.blade.php'
        Old = '    /* Skills */'
        New = '    /* Skills section */'
        Subject = "style: clarify skills CSS comment"
        Body = "Add 'section' for clarity in CSS comment"
    }
    @{
        File = 'resources/views/frontend/index.blade.php'
        Old = '    /* ===== THUNDER / LIGHTNING EFFECTS ===== */'
        New = '    /* ===== Thunder and Lightning Effects ===== */'
        Subject = "style: normalize thunder effects CSS comment"
        Body = "Use title case and 'and' instead of slash"
    }

    # ============================================================
    # resources/views/frontend/app.blade.php (6 commits)
    # ============================================================
    @{
        File = 'resources/views/frontend/app.blade.php'
        Old = '        <!-- Page Loading Animation -->'
        New = '        <!-- Page loading animation -->'
        Subject = "style: normalize HTML comment in app layout"
        Body = "Use sentence case for HTML comment consistency"
    }
    @{
        File = 'resources/views/frontend/app.blade.php'
        Old = '        /* Light Theme - works on ALL pages */'
        New = '        /* Light theme - works on all pages */'
        Subject = "style: normalize light theme CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/app.blade.php'
        Old = '        /* ===== LOADING OVERLAY ===== */'
        New = '        /* ===== Loading overlay ===== */'
        Subject = "style: normalize loading overlay CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/app.blade.php'
        Old = '        /* ===== PAGE EXIT TRANSITION OVERLAY ===== */'
        New = '        /* ===== Page exit transition overlay ===== */'
        Subject = "style: normalize page exit overlay CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/app.blade.php'
        Old = '        /* Prevent overflow from large decorative elements */'
        New = '        /* Prevent overflow from decorative elements */'
        Subject = "style: simplify overflow prevention CSS comment"
        Body = "Remove redundant word 'large' from CSS comment"
    }
    @{
        File = 'resources/views/frontend/app.blade.php'
        Old = '        // ===== THEME TOGGLE (global - works on ALL pages) ====='
        New = '        // ===== Theme toggle (global - works on all pages) ====='
        Subject = "style: normalize theme toggle JS comment"
        Body = "Use sentence case for JS comment consistency"
    }

    # ============================================================
    # resources/views/frontend/project-detail.blade.php (7 commits)
    # ============================================================
    @{
        File = 'resources/views/frontend/project-detail.blade.php'
        Old = '    /* ===== BACK BAR ===== */'
        New = '    /* ===== Back bar ===== */'
        Subject = "style: normalize back bar CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/project-detail.blade.php'
        Old = '    /* ===== HERO IMAGE ===== */'
        New = '    /* ===== Hero image ===== */'
        Subject = "style: normalize hero image CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/project-detail.blade.php'
        Old = '    /* ===== HERO CONTENT ===== */'
        New = '    /* ===== Hero content ===== */'
        Subject = "style: normalize hero content CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/project-detail.blade.php'
        Old = '    /* ===== CONTENT GRID ===== */'
        New = '    /* ===== Content grid ===== */'
        Subject = "style: normalize content grid CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/project-detail.blade.php'
        Old = '    /* ===== SHINE EFFECT ON ALL CARDS ===== */'
        New = '    /* ===== Shine effect on all cards ===== */'
        Subject = "style: normalize shine effect CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/project-detail.blade.php'
        Old = '    /* ===== DESCRIPTION BLOCK ===== */'
        New = '    /* ===== Description block ===== */'
        Subject = "style: normalize description block CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/project-detail.blade.php'
        Old = '    /* ===== SIDEBAR ===== */'
        New = '    /* ===== Sidebar ===== */'
        Subject = "style: normalize sidebar CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }

    # ============================================================
    # resources/views/frontend/case-study-detail.blade.php (5 commits)
    # ============================================================
    @{
        File = 'resources/views/frontend/case-study-detail.blade.php'
        Old = '    /* ===== TOP BAR ===== */'
        New = '    /* ===== Top bar ===== */'
        Subject = "style: normalize top bar CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/case-study-detail.blade.php'
        Old = '    /* ===== HERO CONTENT (separate from image) ===== */'
        New = '    /* ===== Hero content (separate from image) ===== */'
        Subject = "style: normalize hero content CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/case-study-detail.blade.php'
        Old = '    /* ===== CONTENT GRID ===== */'
        New = '    /* ===== Content grid ===== */'
        Subject = "style: normalize content grid CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/case-study-detail.blade.php'
        Old = '    /* ===== SIDEBAR ===== */'
        New = '    /* ===== Sidebar ===== */'
        Subject = "style: normalize sidebar CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/case-study-detail.blade.php'
        Old = '    /* ===== RESPONSIVE ===== */'
        New = '    /* ===== Responsive ===== */'
        Subject = "style: normalize responsive CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }

    # ============================================================
    # resources/views/frontend/gig-detail.blade.php (6 commits)
    # ============================================================
    @{
        File = 'resources/views/frontend/gig-detail.blade.php'
        Old = '    /* ===== BACK BAR ===== */'
        New = '    /* ===== Back bar ===== */'
        Subject = "style: normalize back bar CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/gig-detail.blade.php'
        Old = '    /* ===== HERO IMAGE ===== */'
        New = '    /* ===== Hero image ===== */'
        Subject = "style: normalize hero image CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/gig-detail.blade.php'
        Old = '    /* ===== HERO CONTENT ===== */'
        New = '    /* ===== Hero content ===== */'
        Subject = "style: normalize hero content CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/gig-detail.blade.php'
        Old = '    /* ===== DESCRIPTION ===== */'
        New = '    /* ===== Description ===== */'
        Subject = "style: normalize description CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/gig-detail.blade.php'
        Old = '    /* ===== PRICING ===== */'
        New = '    /* ===== Pricing ===== */'
        Subject = "style: normalize pricing CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/gig-detail.blade.php'
        Old = '    /* ===== SUGGESTED GIGS ===== */'
        New = '    /* ===== Suggested gigs ===== */'
        Subject = "style: normalize suggested gigs CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }

    # ============================================================
    # resources/views/frontend/partials/menu.blade.php (7 commits)
    # ============================================================
    @{
        File = 'resources/views/frontend/partials/menu.blade.php'
        Old = '    /* ===== NAVBAR (SHARED ACROSS ALL PAGES) ===== */'
        New = '    /* ===== Navbar (shared across all pages) ===== */'
        Subject = "style: normalize navbar CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/partials/menu.blade.php'
        Old = '    /* ===== DESKTOP NAV LINKS ===== */'
        New = '    /* ===== Desktop nav links ===== */'
        Subject = "style: normalize desktop nav links CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/partials/menu.blade.php'
        Old = '    /* ===== HAMBURGER ===== */'
        New = '    /* ===== Hamburger ===== */'
        Subject = "style: normalize hamburger CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/partials/menu.blade.php'
        Old = '    /* ===== LANGUAGE SWITCHER ===== */'
        New = '    /* ===== Language switcher ===== */'
        Subject = "style: normalize language switcher CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/partials/menu.blade.php'
        Old = '    /* ===== MOBILE: DRAWER + BACKDROP ===== */'
        New = '    /* ===== Mobile drawer and backdrop ===== */'
        Subject = "style: normalize mobile drawer CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/partials/menu.blade.php'
        Old = '    /* ===== MOBILE RESPONSIVE ===== */'
        New = '    /* ===== Mobile responsive ===== */'
        Subject = "style: normalize mobile responsive CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/partials/menu.blade.php'
        Old = '        // ===== MOBILE MENU TOGGLE ====='
        New = '        // ===== Mobile menu toggle ====='
        Subject = "style: normalize mobile menu toggle JS comment"
        Body = "Use sentence case for JS comment consistency"
    }

    # ============================================================
    # frontend/auth/login.blade.php (3 commits)
    # ============================================================
    @{
        File = 'resources/views/frontend/auth/login.blade.php'
        Old = "                                <h1>{{ __('Welcome Back') }}</h1>"
        New = "                                <h1>{{ __('Welcome back') }}</h1>"
        Subject = "fix: use sentence case in welcome heading"
        Body = "Lowercase 'back' for sentence case consistency in heading"
    }
    @{
        File = 'resources/views/frontend/auth/login.blade.php'
        Old = "                                <p>{{ __('Sign in to your account') }}</p>"
        New = "                                <p>{{ __('Sign in to your account.') }}</p>"
        Subject = "fix: add period to sign in prompt"
        Body = "Add missing period at end of sentence for consistency"
    }
    @{
        File = 'resources/views/frontend/auth/login.blade.php'
        Old = "                                {{ __(`"Don't have an account?`") }}"
        New = "                                {{ __(`"Don't have an account yet?`") }}"
        Subject = "fix: improve registration prompt with 'yet'"
        Body = "Add 'yet' to make the question more natural and inviting"
    }

    # ============================================================
    # frontend/auth/register.blade.php (2 commits)
    # ============================================================
    @{
        File = 'resources/views/frontend/auth/register.blade.php'
        Old = "                                {{ __('Creating account...') }}"
        New = "                                {{ __('Creating your account...') }}"
        Subject = "fix: improve creating account loading text"
        Body = "Add 'your' for clarity in the loading message"
    }
    @{
        File = 'resources/views/frontend/auth/register.blade.php'
        Old = "                                {{ __('Already have an account?') }}"
        New = "                                {{ __('Already have an account') }}?"
        Subject = "fix: separate punctuation from translated string"
        Body = "Move question mark outside translatable string for better i18n"
    }

    # ============================================================
    # frontend/inbox/index.blade.php (7 commits)
    # ============================================================
    @{
        File = 'resources/views/frontend/inbox/index.blade.php'
        Old = '    /* ===== CSS VARIABLES (self-contained for dark/light theme) ===== */'
        New = '    /* ===== CSS variables ===== */'
        Subject = "style: simplify inbox CSS variables comment"
        Body = "Use sentence case and shorten CSS comment"
    }
    @{
        File = 'resources/views/frontend/inbox/index.blade.php'
        Old = '    /* ===== INBOX PAGE — MODERN GLASS DESIGN ===== */'
        New = '    /* ===== Inbox page - modern glass design ===== */'
        Subject = "style: normalize inbox page CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/inbox/index.blade.php'
        Old = '    /* ===== HEADER SECTION ===== */'
        New = '    /* ===== Header section ===== */'
        Subject = "style: normalize header section CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/inbox/index.blade.php'
        Old = '    /* ===== SEARCH BAR ===== */'
        New = '    /* ===== Search bar ===== */'
        Subject = "style: normalize search bar CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/inbox/index.blade.php'
        Old = '    /* ===== EMPTY STATE ===== */'
        New = '    /* ===== Empty state ===== */'
        Subject = "style: normalize empty state CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/inbox/index.blade.php'
        Old = '    /* ===== CONVERSATION LIST ===== */'
        New = '    /* ===== Conversation list ===== */'
        Subject = "style: normalize conversation list CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/inbox/index.blade.php'
        Old = '    /* ===== META (time + status) ===== */'
        New = '    /* ===== Meta (time and status) ===== */'
        Subject = "style: normalize meta section CSS comment"
        Body = "Use sentence case and 'and' instead of plus sign"
    }

    # ============================================================
    # frontend/inbox/show.blade.php (7 commits)
    # ============================================================
    @{
        File = 'resources/views/frontend/inbox/show.blade.php'
        Old = '    /* ===== CSS VARIABLES (self-contained for dark/light theme) ===== */'
        New = '    /* ===== CSS variables ===== */'
        Subject = "style: simplify chat CSS variables comment"
        Body = "Use sentence case and shorten CSS comment"
    }
    @{
        File = 'resources/views/frontend/inbox/show.blade.php'
        Old = '    /* ===== CHAT PAGE — MODERN GLASS DESIGN ===== */'
        New = '    /* ===== Chat page - modern glass design ===== */'
        Subject = "style: normalize chat page CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/inbox/show.blade.php'
        Old = '    /* ===== PACKAGE SUMMARY ===== */'
        New = '    /* ===== Package summary ===== */'
        Subject = "style: normalize package summary CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/inbox/show.blade.php'
        Old = '    /* ===== MESSAGES BOX ===== */'
        New = '    /* ===== Messages box ===== */'
        Subject = "style: normalize messages box CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/inbox/show.blade.php'
        Old = '    /* ===== SINGLE MESSAGE ===== */'
        New = '    /* ===== Single message ===== */'
        Subject = "style: normalize single message CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/inbox/show.blade.php'
        Old = '    /* ===== CHAT FORM ===== */'
        New = '    /* ===== Chat form ===== */'
        Subject = "style: normalize chat form CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }
    @{
        File = 'resources/views/frontend/inbox/show.blade.php'
        Old = '    /* ===== RESPONSIVE ===== */'
        New = '    /* ===== Responsive ===== */'
        Subject = "style: normalize responsive CSS comment"
        Body = "Use sentence case for CSS comment consistency"
    }

    # ============================================================
    # backend/index.blade.php (7 commits)
    # ============================================================
    @{
        File = 'resources/views/backend/index.blade.php'
        Old = '    /* ─── Header Hero ─── */'
        New = '    /* Header hero */'
        Subject = "style: normalize backend header hero CSS comment"
        Body = "Use consistent comment format in backend dashboard"
    }
    @{
        File = 'resources/views/backend/index.blade.php'
        Old = '    /* ─── Stat Cards ─── */'
        New = '    /* Stat cards */'
        Subject = "style: normalize stat cards CSS comment"
        Body = "Use consistent comment format in backend dashboard"
    }
    @{
        File = 'resources/views/backend/index.blade.php'
        Old = '    /* ─── Content Cards ─── */'
        New = '    /* Content cards */'
        Subject = "style: normalize content cards CSS comment"
        Body = "Use consistent comment format in backend dashboard"
    }
    @{
        File = 'resources/views/backend/index.blade.php'
        Old = '    /* ─── Recent Items List ─── */'
        New = '    /* Recent items */'
        Subject = "style: normalize recent items CSS comment"
        Body = "Use consistent comment format in backend dashboard"
    }
    @{
        File = 'resources/views/backend/index.blade.php'
        Old = '    /* ─── Quick Actions ─── */'
        New = '    /* Quick actions */'
        Subject = "style: normalize quick actions CSS comment"
        Body = "Use consistent comment format in backend dashboard"
    }
    @{
        File = 'resources/views/backend/index.blade.php'
        Old = '    /* ─── Animations ─── */'
        New = '    /* Animations */'
        Subject = "style: normalize animations CSS comment"
        Body = "Use consistent comment format in backend dashboard"
    }
    @{
        File = 'resources/views/backend/index.blade.php'
        Old = '    /* ─── Responsive ─── */'
        New = '    /* Responsive */'
        Subject = "style: normalize responsive CSS comment"
        Body = "Use consistent comment format in backend dashboard"
    }

    # ============================================================
    # backend/app.blade.php (3 commits)
    # ============================================================
    @{
        File = 'resources/views/backend/app.blade.php'
        Old = "            title: 'Are you sure?',"
        New = "            title: 'Confirm Deletion',"
        Subject = "fix: improve SweetAlert confirmation title"
        Body = "Use more descriptive title for delete confirmation dialog"
    }
    @{
        File = 'resources/views/backend/app.blade.php'
        Old = "            text: 'Delete `"' + title + '`"? This action cannot be undone.',"
        New = "            text: 'Are you sure you want to delete `"' + title + '`"? This action cannot be undone.',"
        Subject = "fix: improve delete confirmation text"
        Body = "Make confirmation question more explicit and clear"
    }
    @{
        File = 'resources/views/backend/app.blade.php'
        Old = "            confirmButtonText: '<i class=\`"bi bi-trash3 me-1\`"></i> Yes, delete it!',"
        New = "            confirmButtonText: '<i class=\`"bi bi-trash3 me-1\`"></i> Yes, delete it.',"
        Subject = "fix: replace exclamation with period in delete button"
        Body = "Use period instead of exclamation for consistent button text style"
    }

    # ============================================================
    # backend/project/create.blade.php (5 commits)
    # ============================================================
    @{
        File = 'resources/views/backend/project/create.blade.php'
        Old = '                    <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2" style="color:#6366f1;"></i>Add New Project</h4>'
        New = '                    <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2" style="color:#6366f1;"></i>Add a New Project</h4>'
        Subject = "fix: improve project creation heading"
        Body = "Add article 'a' for grammatically correct heading"
    }
    @{
        File = 'resources/views/backend/project/create.blade.php'
        Old = '                    <p class="text-muted small mb-0">Create a new project to showcase in your portfolio</p>'
        New = '                    <p class="text-muted small mb-0">Create a new project to showcase in your portfolio.</p>'
        Subject = "fix: add period to project description"
        Body = "Add missing period at end of description sentence"
    }
    @{
        File = 'resources/views/backend/project/create.blade.php'
        Old = "                                       value=\`"{{ old('title') }}\`" placeholder=\`"e.g. E-Commerce Platform\`" required>"
        New = "                                       value=\`"{{ old('title') }}\`" placeholder=\`"e.g., E-Commerce Platform\`" required>"
        Subject = "fix: add comma after 'e.g.' in placeholder"
        Body = "Use proper punctuation for Latin abbreviation 'e.g.'"
    }
    @{
        File = 'resources/views/backend/project/create.blade.php'
        Old = "                                       value=\`"{{ old('category') }}\`" placeholder=\`"e.g. Web App\`">"
        New = "                                       value=\`"{{ old('category') }}\`" placeholder=\`"e.g., Web App\`">"
        Subject = "fix: add comma after 'e.g.' in category placeholder"
        Body = "Use proper punctuation for Latin abbreviation 'e.g.'"
    }
    @{
        File = 'resources/views/backend/project/create.blade.php'
        Old = '                                <label for="tech_stack" class="form-label fw-medium">Tech Stack</label>'
        New = '                                <label for="tech_stack" class="form-label fw-medium">Tech stack</label>'
        Subject = "fix: use sentence case for tech stack label"
        Body = "Lowercase 'stack' for sentence case consistency in form labels"
    }

    # ============================================================
    # backend/service/create.blade.php (4 commits)
    # ============================================================
    @{
        File = 'resources/views/backend/service/create.blade.php'
        Old = '                    <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2" style="color:#6366f1;"></i>Add New Service</h4>'
        New = '                    <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2" style="color:#6366f1;"></i>Add a New Service</h4>'
        Subject = "fix: improve service creation heading"
        Body = "Add article 'a' for grammatically correct heading"
    }
    @{
        File = 'resources/views/backend/service/create.blade.php'
        Old = '                    <p class="text-muted small mb-0">Create a new service to showcase what you offer</p>'
        New = '                    <p class="text-muted small mb-0">Create a new service to showcase what you offer.</p>'
        Subject = "fix: add period to service description"
        Body = "Add missing period at end of description sentence"
    }
    @{
        File = 'resources/views/backend/service/create.blade.php'
        Old = '                        <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2" style="color:#6366f1;"></i>Service Information</h6>'
        New = '                        <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2" style="color:#6366f1;"></i>Service information</h6>'
        Subject = "fix: use sentence case for service info heading"
        Body = "Lowercase 'information' for sentence case consistency"
    }
    @{
        File = 'resources/views/backend/service/create.blade.php'
        Old = '                                <label class="form-label fw-medium">Service Title <span class="text-danger">*</span></label>'
        New = '                                <label class="form-label fw-medium">Service title <span class="text-danger">*</span></label>'
        Subject = "fix: use sentence case for service title label"
        Body = "Lowercase 'title' for sentence case consistency in forms"
    }

    # ============================================================
    # backend/gig/create.blade.php (4 commits)
    # ============================================================
    @{
        File = 'resources/views/backend/gig/create.blade.php'
        Old = '                    <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2" style="color:#6366f1;"></i>Add New Gig</h4>'
        New = '                    <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2" style="color:#6366f1;"></i>Add a New Gig</h4>'
        Subject = "fix: improve gig creation heading"
        Body = "Add article 'a' for grammatically correct heading"
    }
    @{
        File = 'resources/views/backend/gig/create.blade.php'
        Old = '                    <p class="text-muted small mb-0">Create a new service package with 3 pricing tiers</p>'
        New = '                    <p class="text-muted small mb-0">Create a new service package with three pricing tiers.</p>'
        Subject = "fix: spell out number and add period in gig description"
        Body = "Spell '3' as 'three' for consistency and add missing period"
    }
    @{
        File = 'resources/views/backend/gig/create.blade.php'
        Old = '                        <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2" style="color:#6366f1;"></i>Basic Information</h6>'
        New = '                        <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2" style="color:#6366f1;"></i>Basic information</h6>'
        Subject = "fix: use sentence case for basic info heading"
        Body = "Lowercase 'information' for sentence case consistency"
    }
    @{
        File = 'resources/views/backend/gig/create.blade.php'
        Old = '                                <label class="form-label fw-medium">Gig Title <span class="text-danger">*</span></label>'
        New = '                                <label class="form-label fw-medium">Gig title <span class="text-danger">*</span></label>'
        Subject = "fix: use sentence case for gig title label"
        Body = "Lowercase 'title' for sentence case consistency in forms"
    }

    # ============================================================
    # backend/faq/create.blade.php (4 commits)
    # ============================================================
    @{
        File = 'resources/views/backend/faq/create.blade.php'
        Old = '        <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2" style="color:#6366f1;"></i>Add New FAQ</h4>'
        New = '        <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2" style="color:#6366f1;"></i>Add a New FAQ</h4>'
        Subject = "fix: improve FAQ creation heading"
        Body = "Add article 'a' for grammatically correct heading"
    }
    @{
        File = 'resources/views/backend/faq/create.blade.php'
        Old = '        <p class="text-muted small mb-0">Create a new frequently asked question</p>'
        New = '        <p class="text-muted small mb-0">Create a new frequently asked question.</p>'
        Subject = "fix: add period to FAQ description"
        Body = "Add missing period at end of description sentence"
    }
    @{
        File = 'resources/views/backend/faq/create.blade.php'
        Old = '                    <p class="text-muted small mb-3">The question visitors will see</p>'
        New = '                    <p class="text-muted small mb-3">The question that visitors will see</p>'
        Subject = "fix: improve question helper text"
        Body = "Add 'that' for grammatical completeness"
    }

    # ============================================================
    # backend/skill/create.blade.php (4 commits)
    # ============================================================
    @{
        File = 'resources/views/backend/skill/create.blade.php'
        Old = '                    <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2" style="color:#6366f1;"></i>Add New Skill</h4>'
        New = '                    <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2" style="color:#6366f1;"></i>Add a New Skill</h4>'
        Subject = "fix: improve skill creation heading"
        Body = "Add article 'a' for grammatically correct heading"
    }
    @{
        File = 'resources/views/backend/skill/create.blade.php'
        Old = '                    <p class="text-muted small mb-0">Add a new technical skill to your portfolio</p>'
        New = '                    <p class="text-muted small mb-0">Add a new technical skill to your portfolio.</p>'
        Subject = "fix: add period to skill description"
        Body = "Add missing period at end of description sentence"
    }
    @{
        File = 'resources/views/backend/skill/create.blade.php'
        Old = '                        <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2" style="color:#6366f1;"></i>Skill Information</h6>'
        New = '                        <h6 class="fw-bold mb-0"><i class="bi bi-info-circle me-2" style="color:#6366f1;"></i>Skill information</h6>'
        Subject = "fix: use sentence case for skill info heading"
        Body = "Lowercase 'information' for sentence case consistency"
    }
    @{
        File = 'resources/views/backend/skill/create.blade.php'
        Old = '                                <label class="form-label fw-medium">Skill Name <span class="text-danger">*</span></label>'
        New = '                                <label class="form-label fw-medium">Skill name <span class="text-danger">*</span></label>'
        Subject = "fix: use sentence case for skill name label"
        Body = "Lowercase 'name' for sentence case consistency in forms"
    }

    # ============================================================
    # backend/create files for experience, testimonial, casestudy (3 commits)
    # ============================================================
    @{
        File = 'resources/views/backend/experience/create.blade.php'
        Old = '                    <p class="text-muted small mb-0">Add a new entry to your career timeline</p>'
        New = '                    <p class="text-muted small mb-0">Add a new entry to your career timeline.</p>'
        Subject = "fix: add period to experience description"
        Body = "Add missing period at end of description sentence"
    }
    @{
        File = 'resources/views/backend/testimonial/create.blade.php'
        Old = '                    <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2" style="color:#6366f1;"></i>Add New Testimonial</h4>'
        New = '                    <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2" style="color:#6366f1;"></i>Add a New Testimonial</h4>'
        Subject = "fix: improve testimonial creation heading"
        Body = "Add article 'a' for grammatically correct heading"
    }
    @{
        File = 'resources/views/backend/casestudy/create.blade.php'
        Old = '                    <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2" style="color:#6366f1;"></i>Add New Case Study</h4>'
        New = '                    <h4 class="fw-bold mb-1"><i class="bi bi-plus-circle me-2" style="color:#6366f1;"></i>Add a New Case Study</h4>'
        Subject = "fix: improve case study creation heading"
        Body = "Add article 'a' for grammatically correct heading"
    }

    # ============================================================
    # InboxController.php (3 commits)
    # ============================================================
    @{
        File = 'app/Http/Controllers/InboxController.php'
        Old = "            return back()->withErrors(['message' => 'Please enter a message or select an image.']);"
        New = "            return back()->withErrors(['message' => 'Please enter a message or select an image to send.']);"
        Subject = "fix: improve validation error message"
        Body = "Clarify the image selection purpose with 'to send'"
    }
    @{
        File = 'app/Http/Controllers/InboxController.php'
        Old = "        `$subject = 'Order: ' . `$gig->title . ' - ' . `$packageNames[`$package];"
        New = "        `$subject = 'New Order: ' . `$gig->title . ' - ' . `$packageNames[`$package];"
        Subject = "fix: improve order email subject line"
        Body = "Add 'New' prefix to clarify the subject is for a new order"
    }
    @{
        File = 'app/Http/Controllers/InboxController.php'
        Old = "        `$initialMessage = `"I would like to order the {`$packageNames[`$package]} package ({`$packagePrices[`$package]} USD) for \`"{`$gig->title}\`". Please provide more details.`";"
        New = "        `$initialMessage = `"I'd like to order the {`$packageNames[`$package]} package ({`$packagePrices[`$package]} USD) for \`"{`$gig->title}\`". Please provide more details.`";"
        Subject = "fix: use contraction in order message"
        Body = "Replace 'I would like' with natural contraction 'I'd like'"
    }

    # ============================================================
    # backend/partials/sidebar.blade.php (2 commits)
    # ============================================================
    @{
        File = 'resources/views/backend/partials/sidebar.blade.php'
        Old = '                <span>Case Studies</span>'
        New = '                <span>Case studies</span>'
        Subject = "fix: use sentence case in sidebar menu"
        Body = "Lowercase 'studies' for sentence case consistency in navigation"
    }
    @{
        File = 'resources/views/backend/partials/sidebar.blade.php'
        Old = '                <span>Experiences</span>'
        New = '                <span>Experience</span>'
        Subject = "fix: use singular 'Experience' in sidebar"
        Body = "Use singular noun for section name consistency"
    }

    # ============================================================
    # backend/partials/topbar.blade.php (2 commits)
    # ============================================================
    @{
        File = 'resources/views/backend/partials/topbar.blade.php'
        Old = '        <button class="sidebar-toggle-btn" type="button" aria-label="Toggle sidebar">'
        New = '        <button class="sidebar-toggle-btn" type="button" aria-label="Toggle navigation sidebar">'
        Subject = "fix: improve aria-label for sidebar toggle"
        Body = "Add 'navigation' to make the aria-label more descriptive"
    }
    @{
        File = 'resources/views/backend/partials/topbar.blade.php'
        Old = "            <span class=\`"d-none d-sm-inline\`">{{ config('app.name', 'Admin') }}</span>"
        New = "            <span class=\`"d-none d-sm-inline\`">{{ config('app.name', 'Admin Panel') }}</span>"
        Subject = "fix: improve default admin panel name"
        Body = "Use 'Admin Panel' instead of just 'Admin' as default app name"
    }
)

# ============================================================
# Execute commits
# ============================================================
$totalCommits = [System.Math]::Min($commits.Count, 95)
Write-Host "Starting $totalCommits commits (target: 95)..." -ForegroundColor Cyan
$count = 0
$successCount = 0

foreach ($c in $commits) {
    if ($successCount -ge 95) { break }
    $count++
    $filePath = Join-Path -Path (Get-Location) -ChildPath $c.File
    if (-not (Test-Path $filePath)) {
        Write-Warning "[$count/$totalCommits] File not found: $filePath"
        continue
    }
    
    try {
        $content = [System.IO.File]::ReadAllText($filePath, [System.Text.Encoding]::UTF8)
        if ($content.Contains($c.Old)) {
            $content = $content.Replace($c.Old, $c.New)
            [System.IO.File]::WriteAllText($filePath, $content, [System.Text.Encoding]::UTF8)
            & git add $c.File
            & git commit -m $c.Subject -m $c.Body
            Write-Host "[$count/$totalCommits] OK: $($c.Subject)" -ForegroundColor Green
            $successCount++
        } else {
            Write-Warning "[$count/$totalCommits] Pattern NOT FOUND in $($c.File): $($c.Old)"
        }
    } catch {
        Write-Warning "[$count/$totalCommits] Error: $_"
    }
}

Write-Host "`n=== Done: $successCount successful commits out of $totalCommits attempted ===" -ForegroundColor Cyan
Write-Host "Run 'git log --oneline' to verify."
