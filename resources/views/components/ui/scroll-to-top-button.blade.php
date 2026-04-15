@props([
    'variant' => 'ring', // ring | pie | arrow
    'showAfterPercent' => 5,
])

@php
    $variant = in_array($variant, ['ring','pie','arrow'], true) ? $variant : 'ring';
    $showAfterPercent = is_numeric($showAfterPercent) ? (float) $showAfterPercent : 5;
@endphp

<button
    type="button"
    data-scroll-to-top
    data-variant="{{ $variant }}"
    data-show-after-percent="{{ $showAfterPercent }}"
    aria-label="Back to top"
    class="fixed bottom-4 right-4 z-50 hidden h-12 w-12 cursor-pointer items-center justify-center rounded-full shadow-lg ring-1 ring-border transition hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-ring"
>
    {{-- Arrow-only variant --}}
    <span data-arrow class="hidden text-2xl font-semibold leading-none text-primary-foreground">↑</span>

    {{-- Progress variants --}}
    <span data-progress class="relative hidden h-full w-full inline-flex items-center justify-center rounded-full bg-background">
        <svg class="absolute inset-0 h-full w-full -rotate-90" viewBox="0 0 48 48" aria-hidden="true">
            {{-- Pie --}}
            <circle data-pie-track cx="24" cy="24" r="20" fill="var(--secondary)" fill-opacity="0.35" class="hidden" />
            <path data-pie-slice fill="var(--primary)" fill-opacity="1" class="hidden"></path>

            {{-- Ring --}}
            <circle data-ring-track cx="24" cy="24" r="20" fill="none" stroke="var(--secondary)" stroke-opacity="0.35" stroke-width="4" class="hidden" />
            <circle data-ring-progress cx="24" cy="24" r="20" fill="none" stroke="var(--primary)" stroke-width="4" stroke-linecap="round" class="hidden" />
        </svg>
        <span data-progress-arrow class="relative z-10 text-xl font-semibold leading-none">↑</span>
    </span>
</button>

{{-- Tailwind: classes toggled in script below --}}
<span class="pointer-events-none hidden text-primary text-white" aria-hidden="true"></span>

<script>
    (function () {
        if (window.__starterKitScrollToTopInit) return;
        window.__starterKitScrollToTopInit = true;

        var TWO_PI_R20 = 2 * Math.PI * 20;

        function clamp(n, min, max) {
            return Math.max(min, Math.min(max, n));
        }

        function update(btn) {
            var variant = btn.getAttribute('data-variant') || 'ring';
            var showAfter = parseFloat(btn.getAttribute('data-show-after-percent') || '5');
            if (isNaN(showAfter)) showAfter = 5;

            var scrollTop = window.scrollY || 0;
            var scrollable = document.documentElement.scrollHeight - window.innerHeight;
            var pct = scrollable <= 0 ? 0 : (scrollTop / scrollable) * 100;
            pct = clamp(pct, 0, 100);

            var shouldShow = pct > showAfter;
            btn.classList.toggle('hidden', !shouldShow);
            btn.classList.toggle('inline-flex', shouldShow);

            // Reset visibility
            var arrow = btn.querySelector('[data-arrow]');
            var progress = btn.querySelector('[data-progress]');
            if (arrow) arrow.classList.add('hidden');
            if (progress) progress.classList.add('hidden');

            if (!shouldShow) return;

            btn.setAttribute('aria-label', 'Back to top (' + Math.round(pct) + '% scrolled)');

            if (variant === 'arrow') {
                btn.classList.add('bg-primary', 'text-primary-foreground', 'ring-2', 'ring-secondary', 'ring-offset-2', 'ring-offset-background');
                btn.classList.remove('bg-background');
                if (arrow) arrow.classList.remove('hidden');
                return;
            }

            // Ensure arrow variant classes are removed
            btn.classList.remove('bg-primary', 'text-primary-foreground', 'ring-2', 'ring-secondary', 'ring-offset-2', 'ring-offset-background');

            if (progress) progress.classList.remove('hidden');

            var pieTrack = btn.querySelector('[data-pie-track]');
            var pieSlice = btn.querySelector('[data-pie-slice]');
            var ringTrack = btn.querySelector('[data-ring-track]');
            var ringProg = btn.querySelector('[data-ring-progress]');

            if (pieTrack) pieTrack.classList.add('hidden');
            if (pieSlice) pieSlice.classList.add('hidden');
            if (ringTrack) ringTrack.classList.add('hidden');
            if (ringProg) ringProg.classList.add('hidden');

            var progressArrow = btn.querySelector('[data-progress-arrow]');

            if (variant === 'pie') {
                if (progressArrow) {
                    progressArrow.classList.add('text-white');
                    progressArrow.classList.remove('text-primary');
                }
                if (pieTrack) pieTrack.classList.remove('hidden');
                if (pieSlice) {
                    var angle = clamp((pct / 100) * 360, 0, 359.999);
                    if (angle <= 0) return;

                    var theta = (angle * Math.PI) / 180;
                    var cx = 24, cy = 24, r = 20;
                    var x = cx + r * Math.sin(theta);
                    var y = cy - r * Math.cos(theta);
                    var largeArc = angle > 180 ? 1 : 0;
                    var d = 'M ' + cx + ' ' + cy + ' L ' + cx + ' ' + (cy - r) + ' A ' + r + ' ' + r + ' 0 ' + largeArc + ' 1 ' + x + ' ' + y + ' Z';

                    pieSlice.setAttribute('d', d);
                    pieSlice.classList.remove('hidden');
                }
                return;
            }

            // Default: ring
            if (progressArrow) {
                progressArrow.classList.add('text-primary');
                progressArrow.classList.remove('text-white');
            }
            if (ringTrack) ringTrack.classList.remove('hidden');
            if (ringProg) {
                ringProg.classList.remove('hidden');
                ringProg.setAttribute('stroke-dasharray', String(TWO_PI_R20));
                ringProg.setAttribute('stroke-dashoffset', String((1 - pct / 100) * TWO_PI_R20));
            }
        }

        function updateAll() {
            var buttons = document.querySelectorAll('[data-scroll-to-top]');
            for (var i = 0; i < buttons.length; i++) update(buttons[i]);
        }

        window.addEventListener('scroll', updateAll, { passive: true });
        window.addEventListener('resize', updateAll);
        window.addEventListener('DOMContentLoaded', function () {
            updateAll();
            document.addEventListener('click', function (e) {
                var btn = e.target && e.target.closest ? e.target.closest('[data-scroll-to-top]') : null;
                if (!btn) return;
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });
    })();
</script>
