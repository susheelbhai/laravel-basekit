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

    {{-- Inline style to set the HTML background color based on our theme in app.css --}}
    <style>
        html { background-color: oklch(1 0 0); }
        html.dark { background-color: oklch(0.145 0 0); }
    </style>

    {{ $head ?? '' }}

    {{-- Tailwind/Vite --}}
    @vite(['resources/css/app.css'])
</head>

<body class="font-sans antialiased bg-background text-foreground">
    @php
        /** @var \App\Models\PageAuth|null $pageAuth */
        $pageAuth = \App\Models\PageAuth::query()->where('id', 1)->first();
        $sideImage = $pageAuth?->side_image ?: null;
    @endphp

    <div class="m-auto bg-background2 p-0">
        <x-container class="flex min-h-screen items-center justify-center p-5">
            <div class="flex w-full overflow-hidden rounded-div border border-white">
                <div class="hidden w-1/2 overflow-hidden bg-muted md:flex md:items-center md:justify-center">
                    @if($sideImage)
                        <img
                            src="{{ $sideImage }}"
                            alt="Auth illustration"
                            class="h-full w-full object-cover"
                        >
                    @else
                        <div class="flex h-full w-full items-center justify-center text-muted-foreground">
                            <span>Welcome back</span>
                        </div>
                    @endif
                </div>

                <div class="flex w-full items-center justify-center bg-background p-6 md:w-1/2 md:p-10">
                    <div class="w-full max-w-sm">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </x-container>
    </div>

</body>
</html>