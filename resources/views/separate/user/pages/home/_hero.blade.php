<section
    id="home"
    class="relative overflow-hidden py-20 text-left md:py-32"
    @php
        $bannerImage = data_get($data, 'banner_image');
        $bannerImageUrl = $bannerImage
            ? (\Illuminate\Support\Str::startsWith($bannerImage, ['http://', 'https://', '//']) ? $bannerImage : asset($bannerImage))
            : null;
    @endphp
    style="
        @if(!empty($bannerImageUrl))
            background-image: url('{{ $bannerImageUrl }}');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        @endif
    "
>
    <x-container class="grid gap-8 px-4 md:grid-cols-2">
        <div>
            <p class="mb-4 font-semibold text-primary">
                Welcome to {{ config('app.name') }}
            </p>

            <h1 class="text-4xl font-bold leading-tight md:text-6xl">
                {!! $data?->banner_heading !!}
            </h1>

            <div class="mt-6 max-w-md text-muted-foreground">
                {!! $data?->banner_description !!}
            </div>

            <div class="mt-8 flex flex-wrap gap-4">
                <a href="{{ route('product.index') }}">
                    <button class="cursor-pointer rounded-button bg-primary px-6 py-3 font-semibold text-primary-foreground hover:bg-primary/80">
                        See Products
                    </button>
                </a>

                <a
                    href="https://wa.me/{{ preg_replace('/\D+/', '', (string) config('app.whatsapp')) }}"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <button class="cursor-pointer rounded-button border border-primary px-6 py-3 font-semibold text-primary hover:bg-primary hover:text-primary-foreground">
                        Contact Us
                    </button>
                </a>
            </div>
        </div>

        <div class="h-65 md:h-90"></div>
    </x-container>
</section>