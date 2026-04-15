<x-layout.user.app>
    <x-slot name="head">
        <title>{{ $data->title }} | {{ config('app.name') }}</title>
    </x-slot>

    @php
        $products = $data->products ?? collect();
        $bannerUrl = $data->banner ?: asset('images/products-banner.jpg');
    @endphp

    <div class="min-h-screen bg-linear-to-br from-muted/30 via-background to-muted/20">
        <section class="relative mb-8 flex h-72 w-full items-center justify-center overflow-hidden md:h-80">
            <div class="absolute inset-0 scale-105 bg-cover bg-center" style="background-image: url('{{ $bannerUrl }}')"></div>
            <div class="absolute inset-0 bg-linear-to-br from-primary/90 via-primary/70 to-primary/80"></div>
            <div class="absolute inset-0 backdrop-blur-[2px]"></div>
            <div class="relative z-10 flex h-full w-full max-w-5xl items-center justify-center gap-8 px-4">
                @if ($data->icon)
                    <div class="hidden h-32 w-32 shrink-0 items-center justify-center overflow-hidden rounded-div bg-card/80 shadow-lg md:flex">
                        <img src="{{ $data->icon }}" alt="{{ $data->title }}" class="max-h-full max-w-full object-contain" />
                    </div>
                @endif
                <div class="flex-1 space-y-4 text-left">
                    <h1 class="text-3xl font-black tracking-tight text-white drop-shadow-2xl md:text-5xl">{{ $data->title }}</h1>
                    @if ($data->description)
                        <p class="max-w-2xl text-base font-medium leading-relaxed text-white/95 drop-shadow-lg md:text-lg">
                            {{ $data->description }}
                        </p>
                    @endif
                </div>
            </div>
        </section>

        @if ($data->long_description)
            <x-container class="px-4 pb-10">
                <div class="prose prose-neutral max-w-none rounded-div bg-card/80 p-6 text-muted-foreground shadow-sm ring-1 ring-border dark:prose-invert">
                    {!! $data->long_description !!}
                </div>
            </x-container>
        @endif

        <x-container class="px-4 py-8 md:py-12">
            <div class="mb-10 text-center">
                <h2 class="text-3xl font-bold text-foreground md:text-4xl">All Products</h2>
                <p class="mx-auto mt-2 max-w-2xl text-base text-muted-foreground">Products in this category</p>
                @if ($products->count() > 0)
                    <p class="mt-4 text-sm font-semibold text-muted-foreground">
                        {{ $products->count() }} {{ $products->count() > 1 ? 'Products' : 'Product' }} Available
                    </p>
                @endif
            </div>

            @if ($products->isEmpty())
                <div class="rounded-div border-2 border-dashed border-border bg-muted/20 px-8 py-16 text-center">
                    <p class="text-lg font-semibold">No products in this category yet</p>
                </div>
            @else
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($products as $item)
                        @php
                            $thumb = data_get($item, 'thumbnail') ?? data_get($item, 'display_img');
                            $title = data_get($item, 'title');
                            $slug = data_get($item, 'slug');
                        @endphp
                        <a href="{{ route('product.show', $slug) }}" class="group block">
                            <div class="relative flex h-full flex-col overflow-hidden rounded-div border border-border/50 bg-card shadow-lg transition-all duration-500 hover:-translate-y-3 hover:border-primary/50 hover:shadow-2xl">
                                @if ($thumb)
                                    <div class="relative h-56 w-full overflow-hidden bg-muted">
                                        <img src="{{ $thumb }}" alt="{{ $title }}" class="h-full w-full object-cover transition-all duration-700 group-hover:scale-110" loading="lazy" />
                                    </div>
                                @endif
                                <div class="flex flex-1 flex-col p-6">
                                    <h3 class="mb-3 line-clamp-2 text-xl font-bold transition-colors group-hover:text-primary">{{ $title }}</h3>
                                    @if (data_get($item, 'short_description'))
                                        <p class="mb-4 line-clamp-3 text-sm text-muted-foreground">{{ data_get($item, 'short_description') }}</p>
                                    @endif
                                    <div class="mt-auto flex items-center justify-between border-t border-border pt-4">
                                        @if (data_get($item, 'price'))
                                            <p class="text-xl font-bold">₹{{ number_format((float) data_get($item, 'price'), 0) }}</p>
                                        @endif
                                        <span class="rounded-full bg-primary/10 px-4 py-2 text-sm font-bold text-primary group-hover:bg-primary group-hover:text-primary-foreground">
                                            Details →
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </x-container>
    </div>
</x-layout.user.app>
