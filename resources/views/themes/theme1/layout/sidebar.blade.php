@php
    $dashboardUrl = $authUser['dashboard_url'] ?? url('/dashboard');
    $logoSquareDark = asset($setting->square_dark_logo ?? $setting->dark_logo ?? 'dummy.png');
    $logoSquareLight = asset($setting->square_light_logo ?? $setting->light_logo ?? 'dummy.png');
    $logoDark = asset($setting->dark_logo ?? 'dummy.png');
    $logoLight = asset($setting->light_logo ?? 'dummy.png');

    // Footer/profile nav and guard come only from <x-layout.app> (see components/layout/{seller,partner,admin}/app.blade.php).
    $allowedSidebarGuards = ['seller', 'partner', 'admin'];
    $sidebarPanel = isset($sidebarUserGuard) && is_string($sidebarUserGuard) && in_array($sidebarUserGuard, $allowedSidebarGuards, true)
        ? $sidebarUserGuard
        : null;
    $footerNavItems = is_array($sidebarFooterNavItems ?? null) ? $sidebarFooterNavItems : [];
    $profileNavItems = is_array($sidebarProfileNavItems ?? null) ? $sidebarProfileNavItems : [];
@endphp

{{-- SidebarHeader --}}
<div data-slot="sidebar-header" data-sidebar="header" class="flex flex-col gap-2 p-2 mb-5 p-0">
    <ul data-slot="sidebar-menu" data-sidebar="menu" class="flex w-full min-w-0 flex-col gap-1">
        <li data-slot="sidebar-menu-item" data-sidebar="menu-item" class="group/menu-item relative">
            <a
                href="{{ $dashboardUrl }}"
                data-slot="sidebar-menu-button"
                data-sidebar="menu-button"
                data-size="lg"
                class="peer/menu-button flex w-full items-center gap-2 overflow-hidden rounded-div p-2 text-left text-sm outline-hidden ring-sidebar-ring transition-[width,height,padding] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground group-data-[collapsible=icon]:size-8! group-data-[collapsible=icon]:p-2!"
            >
                <div class="flex w-full items-center justify-center">
                    <img
                        id="starter-kit-sidebar-logo"
                        alt="Logo"
                        class="h-10 w-auto object-contain"
                        data-logo-dark="{{ $logoDark }}"
                        data-logo-light="{{ $logoLight }}"
                        data-logo-square-dark="{{ $logoSquareDark }}"
                        data-logo-square-light="{{ $logoSquareLight }}"
                    />
                </div>
            </a>
        </li>
    </ul>
</div>

<script>
    (function () {
        var img = document.getElementById('starter-kit-sidebar-logo');
        var sidebarRoot = document.querySelector('[data-slot="sidebar"]');
        if (!img || !sidebarRoot) return;

        function compute() {
            var isDark = document.documentElement.classList.contains('dark');
            var isCollapsed = sidebarRoot.getAttribute('data-collapsible') === 'icon';

            var src = '';
            if (isCollapsed) {
                src = isDark ? img.dataset.logoSquareLight : img.dataset.logoSquareDark;
            } else {
                src = isDark ? img.dataset.logoLight : img.dataset.logoDark;
            }

            if (src && img.getAttribute('src') !== src) {
                img.setAttribute('src', src);
            }

            // Match TSX sizing: collapsed -> h-8 w-8; expanded -> h-10 w-auto
            img.classList.toggle('h-8', isCollapsed);
            img.classList.toggle('w-8', isCollapsed);
            img.classList.toggle('h-10', !isCollapsed);
            img.classList.toggle('w-auto', !isCollapsed);
        }

        // Update on sidebar state changes
        var observer = new MutationObserver(function () { compute(); });
        observer.observe(sidebarRoot, { attributes: true, attributeFilter: ['data-state', 'data-collapsible'] });

        // Update on appearance changes (our appearance toggle toggles `html.dark`)
        var htmlObserver = new MutationObserver(function () { compute(); });
        htmlObserver.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });

        compute();
    })();
</script>

{{-- SidebarContent --}}
<div data-slot="sidebar-content" data-sidebar="content" class="flex min-h-0 flex-1 flex-col gap-2 overflow-auto group-data-[collapsible=icon]:overflow-visible">
    <div data-slot="sidebar-group" data-sidebar="group" class="relative flex w-full min-w-0 flex-col p-2 px-2 py-0">
        <div data-slot="sidebar-group-content" data-sidebar="group-content" class="w-full text-sm">
            <ul data-slot="sidebar-menu" data-sidebar="menu" class="flex w-full min-w-0 flex-col gap-1">
                {{ $sidebar }}
            </ul>
        </div>
    </div>
</div>

{{-- SidebarFooter --}}
<div data-slot="sidebar-footer" data-sidebar="footer" class="flex flex-col gap-2 p-2">
    @php
        $footerUser = match ($sidebarPanel ?? null) {
            'partner' => \Illuminate\Support\Facades\Auth::guard('partner')->user(),
            'seller' => \Illuminate\Support\Facades\Auth::guard('seller')->user(),
            'admin' => \Illuminate\Support\Facades\Auth::guard('admin')->user(),
            default => null,
        };
        $userName = $footerUser?->name ?? 'User';
        $userEmail = $footerUser?->email ?? '';
        $initials = collect(preg_split('/\s+/', trim($userName)))
            ->filter()
            ->take(2)
            ->map(fn ($p) => mb_strtoupper(mb_substr($p, 0, 1)))
            ->join('');
    @endphp

    <ul data-slot="sidebar-menu" data-sidebar="menu" class="flex w-full min-w-0 flex-col gap-1">
        @foreach ($footerNavItems as $item)
            <li data-slot="sidebar-menu-item" data-sidebar="menu-item" class="group/menu-item relative">
                <a
                    href="{{ route($item['routeName']) }}"
                    data-slot="sidebar-menu-button"
                    data-sidebar="menu-button"
                    data-size="default"
                    class="peer/menu-button flex w-full items-center gap-2 overflow-hidden rounded-div p-2 text-left text-sm outline-hidden ring-sidebar-ring transition-[width,height,padding] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground disabled:pointer-events-none disabled:opacity-50 aria-disabled:pointer-events-none aria-disabled:opacity-50 group-data-[collapsible=icon]:size-8! group-data-[collapsible=icon]:p-2! [&>span:last-child]:truncate [&>svg]:size-4 [&>svg]:shrink-0"
                >
                    @include('theme1.layout.sidebar-lucide-icon', ['name' => $item['icon'] ?? ''])
                    <span>{{ $item['title'] }}</span>
                </a>
            </li>
        @endforeach

        <li data-slot="sidebar-menu-item" data-sidebar="menu-item" class="group/menu-item relative" id="starter-kit-nav-user">
            <button
                type="button"
                data-slot="sidebar-menu-button"
                data-sidebar="menu-button"
                data-size="lg"
                class="peer/menu-button flex w-full items-center gap-2 overflow-hidden rounded-div p-2 text-left text-sm outline-hidden ring-sidebar-ring transition-[width,height,padding] hover:bg-sidebar-accent hover:text-sidebar-accent-foreground focus-visible:ring-2 active:bg-sidebar-accent active:text-sidebar-accent-foreground data-[state=open]:bg-sidebar-accent group-data-[collapsible=icon]:p-0! group-data-[collapsible=icon]:size-8!"
                aria-label="User menu"
                onclick="(function(){
                    var btn = document.getElementById('starter-kit-nav-user-btn');
                    var menu = document.getElementById('starter-kit-nav-user-menu');
                    if (!btn || !menu) return;
                    var open = btn.getAttribute('data-state') === 'open';
                    btn.setAttribute('data-state', open ? 'closed' : 'open');
                    menu.classList.toggle('hidden', open);
                })()"
                id="starter-kit-nav-user-btn"
                data-state="closed"
            >
                <span class="flex h-8 w-8 items-center justify-center overflow-hidden rounded-full bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                    {{ $initials }}
                </span>

                <span class="grid flex-1 text-left text-sm leading-tight group-data-[collapsible=icon]:hidden">
                    <span class="truncate font-medium">{{ $userName }}</span>
                    <span class="truncate text-xs text-muted-foreground">{{ $userEmail }}</span>
                </span>

                <span class="ml-auto text-muted-foreground group-data-[collapsible=icon]:hidden">
                    <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 10l5 5 5-5" />
                    </svg>
                </span>
            </button>

            {{-- DropdownMenuContent (Blade equivalent) --}}
            <div
                id="starter-kit-nav-user-menu"
                class="absolute bottom-full right-0 mb-2 hidden min-w-56 overflow-hidden rounded-div border border-border bg-popover text-popover-foreground shadow-sm"
            >
                <div class="p-2">
                    <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                        <span class="flex h-8 w-8 items-center justify-center overflow-hidden rounded-full bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                            {{ $initials }}
                        </span>
                        <div class="grid flex-1 text-left text-sm leading-tight">
                            <span class="truncate font-medium">{{ $userName }}</span>
                            <span class="truncate text-xs text-muted-foreground">{{ $userEmail }}</span>
                        </div>
                    </div>
                </div>
                <div class="h-px bg-border"></div>

                <div class="p-1">
                    @foreach ($profileNavItems as $idx => $item)
                        @if (($item['method'] ?? null) === 'post')
                            <button type="button" onclick="logoutSubmit()" class="flex w-full cursor-pointer items-center gap-2 rounded-div px-2 py-2 text-sm hover:bg-muted">
                                @include('theme1.layout.sidebar-lucide-icon', ['name' => $item['icon'] ?? ''])
                                <span>{{ $item['title'] }}</span>
                            </button>
                        @else
                            <a href="{{ route($item['routeName']) }}" class="flex w-full cursor-pointer items-center gap-2 rounded-div px-2 py-2 text-sm hover:bg-muted">
                                @include('theme1.layout.sidebar-lucide-icon', ['name' => $item['icon'] ?? ''])
                                <span>{{ $item['title'] }}</span>
                            </a>
                        @endif
                        @if ($idx < count($profileNavItems) - 1)
                            <div class="h-px bg-border"></div>
                        @endif
                    @endforeach
                </div>
            </div>

            <script>
                (function () {
                    var wrap = document.getElementById('starter-kit-nav-user');
                    var btn = document.getElementById('starter-kit-nav-user-btn');
                    var menu = document.getElementById('starter-kit-nav-user-menu');
                    if (!wrap || !btn || !menu) return;

                    document.addEventListener('mousedown', function (e) {
                        if (!wrap.contains(e.target)) {
                            btn.setAttribute('data-state', 'closed');
                            menu.classList.add('hidden');
                        }
                    });
                })();
            </script>
        </li>
    </ul>
</div>