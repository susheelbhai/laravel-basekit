<section id="about" class="bg-background py-20 md:py-28">
    @php
        $aboutImage = data_get($data, 'about_image_converted.medium');
        $aboutImageUrl = $aboutImage
            ? (\Illuminate\Support\Str::startsWith($aboutImage, ['http://', 'https://', '//']) ? $aboutImage : asset($aboutImage))
            : null;
    @endphp

    <x-container class="grid items-center gap-12 px-4 md:grid-cols-2">
        <div class="relative">
            <img
                src="{{ $aboutImageUrl }}"
                alt="About"
                class="w-full rounded-div"
            />
        </div>
        <div>
            <div class="mb-6">
                <p class="text-sm font-semibold tracking-wider text-primary uppercase">About Us</p>
                <h2 class="mt-2 text-3xl font-bold">{{ $data?->about_heading }}</h2>
            </div>
            <div class="prose max-w-none text-muted-foreground">
                {!! $data?->about_description !!}
            </div>
        </div>
    </x-container>
</section>