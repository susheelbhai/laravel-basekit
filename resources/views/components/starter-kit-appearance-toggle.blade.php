<div class="relative z-[60]" id="starter-kit-appearance">
    <button
        type="button"
        class="inline-flex h-9 w-9 shrink-0 cursor-pointer items-center justify-center rounded-div text-foreground hover:bg-muted/80"
        aria-label="Toggle theme"
        onclick="(function(){
            var menu = document.getElementById('starter-kit-appearance-menu');
            if (!menu) return;
            menu.classList.toggle('hidden');
        })()"
    >
        <svg id="starter-kit-appearance-icon-sun" viewBox="0 0 24 24" class="h-5 w-5 hidden" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364-6.364-1.414 1.414M8.05 18.95l-1.414 1.414M17.364 17.364l1.414 1.414M6.636 6.636 5.222 5.222" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8a4 4 0 100 8 4 4 0 000-8z" />
        </svg>
        <svg id="starter-kit-appearance-icon-moon" viewBox="0 0 24 24" class="h-5 w-5 hidden" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z" />
        </svg>
        <svg id="starter-kit-appearance-icon-monitor" viewBox="0 0 24 24" class="h-5 w-5 hidden" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17h6m-6 4h6M4 4h16v10H4z" />
        </svg>
    </button>

    <div
        id="starter-kit-appearance-menu"
        class="absolute right-0 z-[100] mt-2 hidden w-44 overflow-hidden rounded-div border border-border bg-card text-card-foreground shadow-lg"
    >
        <button type="button" class="flex w-full cursor-pointer items-center gap-2 px-3 py-2 text-left text-sm hover:bg-muted" onclick="window.__starterKitSetAppearance && window.__starterKitSetAppearance('light')">
            <span class="inline-flex h-5 w-5 items-center justify-center">
                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364-6.364-1.414 1.414M8.05 18.95l-1.414 1.414M17.364 17.364l1.414 1.414M6.636 6.636 5.222 5.222" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8a4 4 0 100 8 4 4 0 000-8z" />
                </svg>
            </span>
            Light
        </button>
        <button type="button" class="flex w-full cursor-pointer items-center gap-2 px-3 py-2 text-left text-sm hover:bg-muted" onclick="window.__starterKitSetAppearance && window.__starterKitSetAppearance('dark')">
            <span class="inline-flex h-5 w-5 items-center justify-center">
                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3a7 7 0 009.79 9.79z" />
                </svg>
            </span>
            Dark
        </button>
        <button type="button" class="flex w-full cursor-pointer items-center gap-2 px-3 py-2 text-left text-sm hover:bg-muted" onclick="window.__starterKitSetAppearance && window.__starterKitSetAppearance('system')">
            <span class="inline-flex h-5 w-5 items-center justify-center">
                <svg viewBox="0 0 24 24" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16v10H4z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17h6" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 21h4" />
                </svg>
            </span>
            System
        </button>
    </div>
</div>

<script>
    (function () {
        if (window.__starterKitAppearanceInit) {
            return;
        }
        window.__starterKitAppearanceInit = true;

        function applyAppearance(mode) {
            var root = document.documentElement;
            root.setAttribute('data-appearance', mode);

            if (mode === 'dark') {
                root.classList.add('dark');
            } else if (mode === 'light') {
                root.classList.remove('dark');
            } else {
                var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                root.classList.toggle('dark', !!prefersDark);
            }

            var sun = document.getElementById('starter-kit-appearance-icon-sun');
            var moon = document.getElementById('starter-kit-appearance-icon-moon');
            var monitor = document.getElementById('starter-kit-appearance-icon-monitor');
            if (sun) sun.classList.toggle('hidden', mode !== 'light');
            if (moon) moon.classList.toggle('hidden', mode !== 'dark');
            if (monitor) monitor.classList.toggle('hidden', mode !== 'system');
        }

        window.__starterKitSetAppearance = function (mode) {
            try { localStorage.setItem('appearance', mode); } catch (e) {}
            applyAppearance(mode);
            var menu = document.getElementById('starter-kit-appearance-menu');
            if (menu) menu.classList.add('hidden');
        };

        var initial = null;
        try { initial = localStorage.getItem('appearance'); } catch (e) {}
        if (!initial) initial = document.documentElement.getAttribute('data-appearance') || 'light';
        applyAppearance(initial);

        document.addEventListener('click', function (e) {
            var wrap = document.getElementById('starter-kit-appearance');
            var menu = document.getElementById('starter-kit-appearance-menu');
            if (!wrap || !menu) return;
            if (!wrap.contains(e.target)) menu.classList.add('hidden');
        });
    })();
</script>
