<x-layout.user.app>
    <x-slot name="head">
        <title>Products | {{ config('app.name') }}</title>
    </x-slot>

    <div class="min-h-screen bg-gradient-to-br from-background via-card to-background">
        <section class="relative mb-8 flex h-48 w-full items-center justify-center border-b border-border bg-background2 md:h-56">
            <div class="flex w-full flex-col items-center justify-center px-4">
                <h1 class="mb-2 text-3xl font-black text-foreground md:text-5xl">Our Products</h1>
                <p class="max-w-2xl text-center text-base font-medium leading-relaxed text-muted-foreground md:text-lg">
                    Explore our diverse range of high-quality products designed to meet your applications.
                </p>
            </div>
        </section>

        <x-container class="space-y-16 px-4 py-14 md:py-16">
            {{-- Categories --}}
            <div>
                <div class="mb-6 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                    <div>
                        <h2 class="text-2xl font-semibold text-foreground md:text-3xl">Product Categories</h2>
                        <p class="mt-2 max-w-2xl text-sm text-muted-foreground md:text-base">
                            Browse by category to quickly find the type of solution you're looking for.
                        </p>
                    </div>
                    @if ($categories->count() > 0)
                        <p class="text-xs font-medium uppercase tracking-wide text-muted-foreground">
                            {{ $categories->count() }} {{ $categories->count() > 1 ? 'categories' : 'category' }}
                        </p>
                    @endif
                </div>

                @if ($categories->isEmpty())
                    <div class="rounded-div border-2 border-dashed border-border bg-muted/30 px-8 py-16 text-center shadow-sm">
                        <p class="text-lg font-semibold text-foreground">No categories available yet</p>
                        <p class="mx-auto mt-2 max-w-md text-sm text-muted-foreground">Check back soon for new categories.</p>
                    </div>
                @else
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($categories as $category)
                            <a href="{{ route('productCategory.show', $category->slug) }}" class="group block">
                                <div class="relative h-full overflow-hidden rounded-div border border-border/50 bg-card p-8 shadow-md transition-all duration-500 hover:-translate-y-3 hover:border-primary/30 hover:shadow-2xl hover:shadow-primary/20">
                                    @if ($category->icon)
                                        <img src="{{ $category->icon }}" alt="{{ $category->title }}" class="mx-auto mb-2 h-48 w-48 object-contain" />
                                    @endif
                                    <h3 class="mb-3 text-xl font-bold text-foreground transition-colors group-hover:text-primary">
                                        {{ $category->title }}
                                    </h3>
                                    @if ($category->description)
                                        <p class="mb-4 line-clamp-3 text-sm leading-relaxed text-muted-foreground">{{ $category->description }}</p>
                                    @endif
                                    <span class="inline-flex items-center gap-2 text-sm font-semibold text-primary transition-transform group-hover:translate-x-2">
                                        Explore →
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Products --}}
            <div>
                <div class="mb-10 pt-10 text-center">
                    <h2 class="mb-4 text-3xl font-bold text-foreground md:text-4xl">All Products</h2>
                    <p class="mx-auto max-w-2xl text-base text-muted-foreground">
                        Discover our complete collection of premium products and solutions
                    </p>
                    @if ($data->count() > 0)
                        <p class="mt-4 text-sm font-semibold text-muted-foreground">
                            {{ $data->count() }} {{ $data->count() > 1 ? 'Products' : 'Product' }} Available
                        </p>
                    @endif
                </div>

                @if ($data->isEmpty())
                    <div class="rounded-div border-2 border-dashed border-border bg-muted/20 px-8 py-16 text-center shadow-sm">
                        <p class="text-lg font-semibold text-foreground">No products available yet</p>
                        <p class="mx-auto mt-2 max-w-md text-sm text-muted-foreground">Explore categories above or check back soon.</p>
                    </div>
                @else
                    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($data as $item)
                            <a href="{{ route('product.show', $item['slug']) }}" class="group block">
                                <div class="relative flex h-full flex-col overflow-hidden rounded-div border border-border/50 bg-card shadow-lg transition-all duration-500 hover:-translate-y-3 hover:border-primary/50 hover:shadow-2xl hover:shadow-primary/10">
                                    @if (!empty($item['thumbnail']))
                                        <div class="relative h-56 w-full overflow-hidden bg-muted">
                                            <img src="{{ $item['thumbnail'] }}" alt="{{ $item['title'] }}" class="h-full w-full object-cover transition-all duration-700 group-hover:scale-110" loading="lazy" />
                                        </div>
                                    @endif
                                    <div class="flex flex-1 flex-col p-6">
                                        <h3 class="mb-3 line-clamp-2 text-xl font-bold text-foreground transition-colors group-hover:text-primary">
                                            {{ $item['title'] }}
                                        </h3>
                                        @if (!empty($item['short_description']))
                                            <p class="mb-4 line-clamp-3 text-sm leading-relaxed text-muted-foreground">
                                                {{ $item['short_description'] }}
                                            </p>
                                        @endif
                                        <div class="mt-auto flex items-center justify-between border-t border-border pt-4">
                                            @if (!empty($item['price']))
                                                <div>
                                                    <p class="text-xs text-muted-foreground">Starting at</p>
                                                    <p class="text-xl font-bold text-foreground">₹{{ number_format($item['price'], 0) }}</p>
                                                </div>
                                            @endif
                                            <span class="inline-flex items-center gap-2 rounded-full bg-primary/10 px-4 py-2 text-sm font-bold text-primary transition-all group-hover:bg-primary group-hover:text-primary-foreground">
                                                Details →
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </x-container>
    </div>
</x-layout.user.app>
