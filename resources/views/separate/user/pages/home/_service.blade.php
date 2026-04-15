<section id="services" class="bg-background2 py-20 md:py-28">
    <x-container class="px-4 text-center">
        <div class="mb-10">
            <p class="text-sm font-semibold tracking-wider text-primary uppercase">What We Do</p>
            <h2 class="mt-2 text-3xl font-bold">Our Services</h2>
        </div>

        <div class="grid gap-8 md:grid-cols-3">
            @foreach(($services ?? []) as $service)
                @php
                    $serviceIcon = data_get($service, 'display_img_converted.thumb');
                    $serviceIconUrl = $serviceIcon
                        ? (\Illuminate\Support\Str::startsWith($serviceIcon, ['http://', 'https://', '//']) ? $serviceIcon : asset($serviceIcon))
                        : null;
                @endphp
                <div class="rounded-div bg-card p-8 shadow transition hover:shadow-lg">
                    <img
                        src="{{ $serviceIconUrl }}"
                        alt="{{ $service->title }}"
                        class="mx-auto mb-6 h-16 w-16"
                    />
                    <h3 class="mb-2 text-xl font-semibold">{{ $service->title }}</h3>
                    <p class="text-muted-foreground">{{ $service->desc }}</p>
                </div>
            @endforeach
        </div>
    </x-container>
</section>