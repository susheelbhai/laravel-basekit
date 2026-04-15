<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-appearance="{{ $appearance ?? config('app.appearance_default', 'light') }}" @class(['dark' => ($appearance ?? config('app.appearance_default', 'light')) == 'dark'])>
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone=no">
	
	<title>{{ config('app.name') }}</title>

    <link rel="icon" href="{{ config('app.favicon', 'Favicon') }}" sizes="any">
    <link rel="icon" href="{{ config('app.favicon', 'Favicon') }}" type="image/svg+xml">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    {{-- Icon font (existing sidebar uses Font Awesome classes like "fas fa-tv") --}}
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />

    {{-- Inline style to set the HTML background color based on our theme in app.css --}}
    <style>
        html { background-color: oklch(1 0 0); }
        html.dark { background-color: oklch(0.145 0 0); }
    </style>

	{{ $head ?? '' }}

    {{-- Tailwind/Vite --}}
    @vite(['resources/css/app.css'])
</head>
<body class="min-h-screen bg-background text-foreground overflow-x-hidden">
    <div class="min-h-screen overflow-hidden">
        {{-- TSX layout renders the logo inside the sidebar header, not above the shell. --}}

        @php
            $sidebarOpen = request()->cookie('sidebar_state', 'true') === 'true';
            $sidebarState = $sidebarOpen ? 'expanded' : 'collapsed';
            $sidebarCollapsible = $sidebarOpen ? '' : 'icon';
        @endphp

        {{-- Mirrors `SidebarProvider` wrapper output (data-slot + CSS vars + wrapper class) --}}
        <div
            data-slot="sidebar-wrapper"
            id="sidebar-wrapper"
            style="--sidebar-width:16rem; --sidebar-width-icon:3rem;"
            class="group/sidebar-wrapper has-data-[variant=inset]:bg-sidebar flex min-h-svh w-full overflow-hidden"
        >
            {{-- Mirrors `Sidebar` desktop container (peer + group + data-state/data-collapsible/data-variant/data-side) --}}
            <div
                class="group peer group/sidebar text-sidebar-foreground hidden md:block"
                data-state="{{ $sidebarState }}"
                data-collapsible="{{ $sidebarCollapsible }}"
                data-variant="inset"
                data-side="left"
                data-slot="sidebar"
            >
                <div
                    class="relative h-svh w-(--sidebar-width) bg-transparent transition-[width] duration-200 ease-linear group-data-[collapsible=offcanvas]:w-0 group-data-[side=right]:rotate-180 group-data-[collapsible=icon]:w-[calc(var(--sidebar-width-icon)+(--spacing(4))+2px)]"
                ></div>

                <div
                    class="fixed inset-y-0 z-10 hidden h-svh w-(--sidebar-width) transition-[left,right,width] duration-200 ease-linear md:flex left-0 p-2 group-data-[collapsible=icon]:w-[calc(var(--sidebar-width-icon)+(--spacing(4))+2px)]"
                >
                    <div
                        data-sidebar="sidebar"
                        class="bg-sidebar group-data-[variant=floating]:border-sidebar-border flex h-full w-full flex-col rounded-div border border-sidebar-border/50 shadow-sm"
                        id="app-sidebar"
                    >
                        @relativeInclude('sidebar')
                    </div>
                </div>

                {{-- Mirrors `SidebarRail` (edge click area to toggle) --}}
                <button
                    data-sidebar="rail"
                    data-slot="sidebar-rail"
                    aria-label="Toggle Sidebar"
                    tabIndex="-1"
                    title="Toggle Sidebar"
                    class="hover:after:bg-sidebar-border absolute inset-y-0 z-20 hidden w-4 -translate-x-1/2 transition-all ease-linear group-data-[side=left]:-right-4 group-data-[side=right]:left-0 after:absolute after:inset-y-0 after:left-1/2 after:w-[2px] sm:flex [[data-side=left][data-state=collapsed]_&]:cursor-e-resize [[data-side=right][data-state=collapsed]_&]:cursor-w-resize hover:group-data-[collapsible=offcanvas]:bg-sidebar group-data-[collapsible=offcanvas]:translate-x-0 group-data-[collapsible=offcanvas]:after:left-full [[data-side=left][data-collapsible=offcanvas]_&]:-right-2 [[data-side=right][data-collapsible=offcanvas]_&]:-left-2"
                    onclick="window.__starterKitToggleSidebar && window.__starterKitToggleSidebar()"
                ></button>
            </div>

            {{-- Mirrors `SidebarInset` (AppContent variant="sidebar") --}}
            <div class="bg-background relative flex max-w-full min-h-svh flex-1 flex-col overflow-hidden peer-data-[variant=inset]:min-h-[calc(100svh-(--spacing(4)))] md:peer-data-[variant=inset]:m-2 md:peer-data-[variant=inset]:ml-0 md:peer-data-[variant=inset]:rounded-div md:peer-data-[variant=inset]:shadow-sm">
                {{-- Mirrors `AppSidebarHeader` header wrapper class --}}
                <header class="flex h-16 shrink-0 items-center gap-2 border-b border-sidebar-border/50 px-6 transition-[width,height] ease-linear group-has-data-[collapsible=icon]/sidebar-wrapper:h-12 md:px-4">
                    @relativeInclude('header')
                </header>

                <main class="flex-1 overflow-auto">
                    <div class="mx-auto w-full max-w-7xl px-4 py-6 md:px-6">
                        @relativeInclude('header.alert')
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </div>

    @livewireScripts

    <script>
        // Blade version of `SidebarTrigger` / sidebar provider state.
        (function () {
            var trigger = document.getElementById('starter-kit-sidebar-trigger');
            var sidebarRoot = document.querySelector('[data-slot="sidebar"]');
            if (!sidebarRoot) return;

            function setCookie(open) {
                document.cookie = 'sidebar_state=' + (open ? 'true' : 'false') + '; path=/; max-age=' + (60 * 60 * 24 * 7);
            }

            function toggleSidebar() {
                var isExpanded = sidebarRoot.getAttribute('data-state') === 'expanded';
                var nextOpen = !isExpanded;

                sidebarRoot.setAttribute('data-state', nextOpen ? 'expanded' : 'collapsed');
                sidebarRoot.setAttribute('data-collapsible', nextOpen ? '' : 'icon');
                setCookie(nextOpen);
            }

            window.__starterKitToggleSidebar = toggleSidebar;

            if (trigger) {
                trigger.addEventListener('click', function () {
                    toggleSidebar();
                });
            }

            // Keyboard shortcut: Ctrl/Cmd + B (matches TSX SidebarProvider).
            window.addEventListener('keydown', function (event) {
                if (event.key === 'b' && (event.metaKey || event.ctrlKey)) {
                    event.preventDefault();
                    toggleSidebar();
                }
            });
        })();
    </script>

    @if (config('app.watermark') == 1)
    <script>
        var textWatermark = 'Testing';
        var body = document.getElementsByTagName('body')[0];
        var header = document.getElementsByClassName('header')[0];
        var dlabnav = document.getElementsByClassName('dlabnav')[0];
        var navHeader = document.getElementsByClassName('nav-header')[0];
        var background = "url(\"data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' version='1.1' height='48px' width='80px' >" +
            "<text transform='translate(20, 48) rotate(-30)' fill='rgba(255,128,128, 0.2)' font-size='20' >" + textWatermark + "</text></svg>\")";
        body.style.backgroundImage = background
        header.style.backgroundImage = background
        dlabnav.style.backgroundImage = background
        navHeader.style.backgroundImage = background
    </script>
    @endif

    <x-ui.scroll-to-top-button variant="ring" />
	

</body>
</html>