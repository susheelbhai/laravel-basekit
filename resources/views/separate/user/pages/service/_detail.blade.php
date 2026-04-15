@php
    $features = collect(data_get($data, 'features', []))
        ->filter()
        ->values()
        ->all();
@endphp

<div class="bg-background text-foreground">
    <div
        class="h-64 w-full bg-cover bg-center"
        style="background-image: url('{{ $data['display_img'] ?? '' }}')"
    >
        <div class="flex h-full w-full items-center justify-center bg-black/40">
            <h1 class="text-4xl font-bold text-primary-foreground md:text-5xl">{{ $data['title'] }}</h1>
        </div>
    </div>

    <x-container class="grid grid-cols-1 gap-10 px-4 py-16 md:grid-cols-3">
        <div class="space-y-6 md:col-span-2">
            @if (!empty($data['display_img']))
                <img src="{{ $data['display_img'] }}" alt="{{ $data['title'] }}" class="mb-4 w-full rounded-div shadow" />
            @endif

            <p class="text-lg text-muted-foreground">{{ $data['short_description'] }}</p>

            <div class="space-y-4">
                <section>
                    <h2 class="mb-2 text-xl font-semibold">Overview</h2>
                    <div class="prose prose-neutral max-w-none dark:prose-invert">{!! $data['long_description1'] !!}</div>
                </section>
                <section>
                    <h2 class="mb-2 text-xl font-semibold">How It Works</h2>
                    <div class="prose prose-neutral max-w-none dark:prose-invert">{!! $data['long_description2'] !!}</div>
                </section>
                <section>
                    <h2 class="mb-2 text-xl font-semibold">Why Choose Us</h2>
                    <div class="prose prose-neutral max-w-none dark:prose-invert">{!! $data['long_description3'] !!}</div>
                </section>
            </div>
        </div>

        <div class="space-y-4 rounded-div border border-sidebar-border bg-sidebar p-6 shadow md:col-span-1">
            <h3 class="mb-2 text-xl font-semibold text-sidebar-foreground">Why Choose This Service</h3>
            @if (count($features) > 0)
                <ul class="list-inside list-disc space-y-2 text-sm text-sidebar-foreground">
                    @foreach ($features as $feature)
                        <li>{{ $feature }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-sm text-muted-foreground">Explore our tailored approach and dedicated support for your needs.</p>
            @endif
            <a
                href="{{ route('contact') }}"
                class="mt-6 flex w-full items-center justify-center rounded-div bg-sidebar-primary py-2 text-sidebar-primary-foreground transition hover:bg-sidebar-primary/90"
            >
                Book Now
            </a>
        </div>
    </x-container>
</div>
