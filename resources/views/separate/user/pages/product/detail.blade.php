<x-layout.user.app>
    <x-slot name="head">
        <title>{{ $data->title }} | {{ config('app.name') }}</title>
    </x-slot>

    @php
        $images = collect($data->images ?? []);
        $displayImages = $images->count() > 0 ? $images : collect($data->display_img ? [['url' => $data->display_img, 'thumbnail' => $data->display_img]] : []);
        $hasPrice = $data->price && (float) $data->price > 0;
        $features = $data->features ?? [];
    @endphp

    <div class="bg-background text-foreground">
        <x-container class="px-4 py-12 lg:py-16">
            <div class="mb-12 grid grid-cols-1 gap-8 lg:grid-cols-2 lg:gap-12">
                <div>
                    <x-product.image-slider :images="$displayImages" :title="$data->title" />
                </div>

                <aside class="flex flex-col space-y-6">
                    <div>
                        <h1 class="text-3xl font-bold text-foreground lg:text-4xl">{{ $data->title }}</h1>
                        @if ($data->category)
                            <p class="mt-2 text-sm text-muted-foreground">
                                Category: {{ $data->category->title }}
                            </p>
                        @endif
                    </div>

                    @if ($hasPrice)
                        <div class="rounded-div border border-border bg-card p-4 shadow-sm">
                            @if ($data->mrp && (float) $data->mrp > (float) $data->price)
                                <p class="text-sm text-muted-foreground line-through">MRP ₹{{ number_format($data->mrp, 2) }}</p>
                            @endif
                            <p class="text-2xl font-bold text-foreground">₹{{ number_format($data->price, 2) }}</p>
                        </div>
                    @else
                        <x-product.enquiry-modal :product-id="$data->id" :product-title="$data->title" />
                    @endif

                    @if (is_array($features) && count($features) > 0)
                        <div class="rounded-div border border-border bg-muted/40 p-4">
                            <h3 class="mb-2 font-semibold">Features</h3>
                            <ul class="list-inside list-disc space-y-1 text-sm text-muted-foreground">
                                @foreach ($features as $f)
                                    <li>{{ $f }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mt-auto">
                        <x-product.enquiry-modal :product-id="$data->id" :product-title="$data->title" />
                    </div>
                </aside>
            </div>

            <div class="space-y-8">
                @if ($data->short_description)
                    <div class="prose prose-neutral max-w-none dark:prose-invert">
                        <p class="text-lg text-muted-foreground">{{ $data->short_description }}</p>
                    </div>
                @endif

                @if ($data->description)
                    <section class="prose prose-neutral max-w-none dark:prose-invert">
                        {!! $data->description !!}
                    </section>
                @endif
                @if ($data->long_description2)
                    <section class="prose prose-neutral max-w-none dark:prose-invert">
                        {!! $data->long_description2 !!}
                    </section>
                @endif
                @if ($data->long_description3)
                    <section class="prose prose-neutral max-w-none dark:prose-invert">
                        {!! $data->long_description3 !!}
                    </section>
                @endif
            </div>
        </x-container>
    </div>
</x-layout.user.app>
