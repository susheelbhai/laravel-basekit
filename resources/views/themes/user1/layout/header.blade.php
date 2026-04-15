<header class="w-full">
    @include('user.layouts.top_header')

    <div class="sticky top-0 z-30 bg-header/90 shadow-sm backdrop-blur-xl">
        <x-container class="flex items-center justify-between px-4 py-3.5 md:py-4">
            {{-- Logo --}}
            <div class="flex items-center gap-2">
                {{ $header_logo }}
            </div>

            {{-- Desktop Menu --}}
            <nav class="hidden items-center gap-1 text-sm font-medium text-header-foreground md:flex">
                {{ $header }}
            </nav>

            {{-- Mobile toggle --}}
            <button
                id="starter-kit-mobile-menu-btn"
                type="button"
                class="flex cursor-pointer items-center text-xl text-muted-foreground md:hidden"
                aria-label="Toggle menu"
            >
                <span class="select-none">☰</span>
            </button>
        </x-container>

        {{-- Mobile Menu --}}
        <div id="starter-kit-mobile-menu" class="hidden border-t border-border bg-header px-4 pb-4 shadow md:hidden">
            <nav class="flex flex-col space-y-1.5 pt-3 text-sm font-medium text-header-foreground">
                {{ $header }}
            </nav>
        </div>
    </div>
</header>