<section id="features" class="bg-background py-20 md:py-28">
    @php
        $whyImage = data_get($data, 'why_us_image_converted.medium');
        $whyImageUrl = $whyImage
            ? (\Illuminate\Support\Str::startsWith($whyImage, ['http://', 'https://', '//']) ? $whyImage : asset($whyImage))
            : null;
    @endphp

    <x-container class="grid gap-12 px-4 md:grid-cols-2">
        <div>
            <div class="mb-6">
                <p class="text-sm font-semibold tracking-wider text-primary uppercase">Why Choose Us</p>
                <h2 class="mt-2 text-3xl font-bold">{{ $data?->why_us_heading }}</h2>
            </div>
            <div class="prose max-w-none text-muted-foreground">
                {!! $data?->why_us_description !!}
            </div>
        </div>

        <div class="relative">
            <img
                src="{{ $whyImageUrl }}"
                alt="Why choose us"
                class="w-full rounded-div"
            />
        </div>
    </x-container>
</section>