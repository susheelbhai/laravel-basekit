<div class="min-h-screen bg-background text-foreground">
    {{-- Banner --}}
    <section class="relative h-64 w-full overflow-hidden md:h-80">
        <div
            class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('{{ $data->banner }}')"
        ></div>
        <div class="absolute inset-0 bg-linear-to-b from-black/70 via-black/60 to-black/80"></div>
        <div class="relative z-10 flex h-full items-center justify-center px-4">
            <div class="text-center">
                <span class="inline-flex items-center rounded-full bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-[0.16em] text-white/80">
                    Know our story
                </span>
                <h1 class="mt-4 text-3xl font-bold tracking-tight text-white sm:text-4xl md:text-5xl">
                    About Us
                </h1>
                <p class="mx-auto mt-3 max-w-2xl text-sm text-white/80 md:text-base">
                    Learn more about who we are, what drives us, and the vision that shapes everything we do.
                </p>
            </div>
        </div>
    </section>

    <x-container class="px-4 py-10 md:py-14">
        <div class="rounded-div bg-card/90 p-6 shadow-[0_24px_60px_rgba(0,0,0,0.08)] ring-1 ring-border md:p-8 lg:p-10">
            <div class="space-y-6 text-sm leading-relaxed text-muted-foreground md:text-base">
                <div>{!! $data->para1 !!}</div>
                <div>{!! $data->para2 !!}</div>
            </div>

            <div class="mt-10 border-t border-border pt-8">
                <h2 class="mb-6 text-lg font-semibold md:text-xl">What we stand for</h2>
                <div class="grid gap-6 md:grid-cols-3">
                    <div class="group rounded-div bg-muted p-5 shadow-sm ring-1 ring-border transition hover:-translate-y-1 hover:shadow-md">
                        <div class="mb-3 inline-flex h-10 w-10 items-center justify-center rounded-div bg-card shadow-sm text-primary font-bold">◎</div>
                        <h3 class="mb-2 text-base font-semibold">Our Objective</h3>
                        <div class="prose prose-sm max-w-none text-muted-foreground prose-p:mb-2 prose-ul:mb-2">
                            {!! $data->objective !!}
                        </div>
                    </div>
                    <div class="group rounded-div bg-muted p-5 shadow-sm ring-1 ring-border transition hover:-translate-y-1 hover:shadow-md">
                        <div class="mb-3 inline-flex h-10 w-10 items-center justify-center rounded-div bg-card shadow-sm text-primary font-bold">▣</div>
                        <h3 class="mb-2 text-base font-semibold">Our Mission</h3>
                        <div class="prose prose-sm max-w-none text-muted-foreground prose-p:mb-2 prose-ul:mb-2">
                            {!! $data->mission !!}
                        </div>
                    </div>
                    <div class="group rounded-div bg-muted p-5 shadow-sm ring-1 ring-border transition hover:-translate-y-1 hover:shadow-md">
                        <div class="mb-3 inline-flex h-10 w-10 items-center justify-center rounded-div bg-card shadow-sm text-primary font-bold">◉</div>
                        <h3 class="mb-2 text-base font-semibold">Our Vision</h3>
                        <div class="prose prose-sm max-w-none text-muted-foreground prose-p:mb-2 prose-ul:mb-2">
                            {!! $data->vision !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 rounded-div bg-muted p-6 ring-1 ring-border md:flex md:items-center md:gap-8 md:p-7 lg:p-8">
                <div class="mx-auto mb-6 flex flex-col items-center md:mb-0 md:items-start">
                    <div class="relative">
                        <div class="absolute -inset-1 rounded-full bg-linear-to-tr from-primary/40 via-accent/40 to-primary/40 blur"></div>
                        <div class="relative rounded-full bg-card p-1">
                            <img
                                src="{{ $data->founder_image }}"
                                alt="Founder"
                                class="h-40 w-40 rounded-full object-cover shadow-md md:h-44 md:w-44"
                            />
                        </div>
                    </div>
                </div>
                <div class="relative flex-1">
                    <div class="mb-3 inline-flex items-center gap-2 rounded-full bg-primary/5 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-muted-foreground">
                        A message from our Founder
                    </div>
                    <h3 class="mb-3 text-xl font-bold md:text-2xl">A Message from Our Founder</h3>
                    <div class="prose prose-sm max-w-none text-muted-foreground md:prose-base">
                        {!! $data->founder_message !!}
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</div>
