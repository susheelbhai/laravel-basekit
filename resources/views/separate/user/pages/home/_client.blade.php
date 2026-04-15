<section class="bg-background2 py-10 md:py-16">
    <x-container class="px-4 text-center">
        <h2 class="mb-8 text-2xl font-bold">Our Partners</h2>

        <div class="flex flex-wrap items-center justify-center gap-10">
            @foreach(($clients ?? []) as $client)
                @php
                    $clientLogo = data_get($client, 'logo');
                    $clientLogoUrl = $clientLogo
                        ? (\Illuminate\Support\Str::startsWith($clientLogo, ['http://', 'https://', '//']) ? $clientLogo : asset($clientLogo))
                        : null;
                @endphp
                <a
                    href="{{ $client->url }}"
                    target="_blank"
                    class="flex h-12 w-32 items-center justify-center transition md:h-16"
                    rel="noopener noreferrer"
                >
                    <img
                        src="{{ $clientLogoUrl }}"
                        alt="{{ $client->name }}"
                        class="object-contain transition hover:scale-110"
                    />
                </a>
            @endforeach
        </div>
    </x-container>
</section>