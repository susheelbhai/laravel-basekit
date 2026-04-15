<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-appearance="{{ $appearance ?? config('app.appearance_default', 'light') }}" @class(['dark' => ($appearance ?? config('app.appearance_default', 'light')) == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script>
            (function () {
                var appearance = document.documentElement.dataset.appearance || 'light';
                if (appearance === 'system' && window.matchMedia) {
                    if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
                        document.documentElement.classList.add('dark');
                    }
                }
            })();
        </script>

        <link rel="icon" href="{{ asset(config('app.favicon', 'dummy.png')) }}" sizes="any">

        {{-- Icon font (Font Awesome for social icons) --}}
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />

        <style>
            html { background-color: oklch(1 0 0); }
            html.dark { background-color: oklch(0.145 0 0); }
        </style>

        {{ $head ?? '' }}

        {{-- Tailwind/Vite (matches the React theme styling tokens) --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="overflow-x-hidden bg-background text-foreground">
        @relativeInclude('header')

        @if (session('success'))
            <div class="container mx-auto max-w-[1320px] px-4 pt-4" role="status" aria-live="polite">
                <p class="rounded-div border border-primary/25 bg-primary/10 px-4 py-3 text-sm font-medium text-primary">
                    {{ session('success') }}
                </p>
            </div>
        @endif
        @if (session('error'))
            <div class="container mx-auto max-w-[1320px] px-4 pt-4" role="alert">
                <p class="rounded-div border border-destructive/30 bg-destructive/10 px-4 py-3 text-sm font-medium text-destructive">
                    {{ session('error') }}
                </p>
            </div>
        @endif

        {{ $slot }}

        @include('user.layouts.footer')

        <script>
            // Simple mobile menu toggle used by the Blade header.
            window.addEventListener('DOMContentLoaded', function () {
                var btn = document.getElementById('starter-kit-mobile-menu-btn');
                var menu = document.getElementById('starter-kit-mobile-menu');
                if (!btn || !menu) return;

                btn.addEventListener('click', function () {
                    menu.classList.toggle('hidden');
                });
            });
        </script>

        <x-ui.scroll-to-top-button variant="ring" />
    </body>
</html>

