@php
    $appearance = $appearance ?? config('app.appearance_default', 'light');
    $logoPath = 'dummy.png';
    if (! empty($setting)) {
        $logoPath = $appearance === 'dark'
            ? ($setting->light_logo ?? $setting->dark_logo ?? 'dummy.png')
            : ($setting->dark_logo ?? $setting->light_logo ?? 'dummy.png');
    }
@endphp

<div class="flex flex-col items-center gap-4">
    <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium">
        <div class="mb-1 flex items-center justify-center rounded-div">
            <img src="{{ asset($logoPath) }}" alt="{{ config('app.name') }}" class="h-10 w-auto">
        </div>
        <span class="sr-only">{{ $title }}</span>
    </a>

    <div class="space-y-2 text-center">
        <h1 class="text-xl font-medium">{{ $title }}</h1>
        @if (filled($description ?? null))
            <p class="text-center text-sm text-muted-foreground">{{ $description }}</p>
        @endif
    </div>
</div>
