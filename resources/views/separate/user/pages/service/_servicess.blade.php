<div class="min-h-screen bg-background text-foreground">
    <section class="relative h-64 w-full overflow-hidden md:h-80">
        <div
            class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('{{ asset('images/services-banner.jpg') }}')"
        ></div>
        <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/40 to-black/60"></div>
        <div class="relative z-10 flex h-full items-center justify-center px-4">
            <div class="text-center">
                <span class="inline-flex items-center rounded-full bg-card/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.16em] text-primary-foreground">
                    What We Offer
                </span>
                <h1 class="mt-4 text-3xl font-bold tracking-tight text-primary-foreground sm:text-4xl md:text-5xl">
                    Our Services
                </h1>
                <p class="mx-auto mt-3 max-w-2xl text-sm text-muted-foreground md:text-base">
                    Providing exceptional value through tailored solutions designed to help you grow.
                </p>
            </div>
        </div>
    </section>

    <x-container class="px-4 py-14 md:py-16">
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($data as $service)
                <a href="{{ route('serviceDetail', $service->slug) }}" class="group block">
                    <div class="h-full rounded-div bg-card p-6 shadow-sm ring-1 ring-border transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                        @if ($service->display_img)
                            <div class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-div bg-primary/10 p-2 shadow-sm">
                                <img src="{{ $service->display_img }}" alt="{{ $service->title }}" class="h-10 w-10 object-contain" />
                            </div>
                        @endif
                        <h3 class="mb-2 text-xl font-semibold transition-colors group-hover:text-primary">
                            {{ $service->title }}
                        </h3>
                        <p class="text-sm leading-relaxed text-muted-foreground">
                            {{ $service->short_description }}
                        </p>
                        <div class="mt-4 inline-flex items-center gap-1 text-sm font-medium text-primary opacity-0 transition-all group-hover:opacity-100">
                            Read More →
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </x-container>
</div>
