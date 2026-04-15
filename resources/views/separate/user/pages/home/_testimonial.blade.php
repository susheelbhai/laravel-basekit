@if(!empty($testimonials) && count($testimonials) > 0)
    <section id="testimonials" class="bg-background2 py-20 md:py-28">
        <x-container class="px-4 text-center">
            <div class="mb-10">
                <p class="text-sm font-semibold tracking-wider text-primary uppercase">Testimonials</p>
                <h2 class="mt-2 text-3xl font-bold">What Our Clients Say</h2>
            </div>

            <div class="grid gap-8 md:grid-cols-3">
                @foreach($testimonials as $t)
                    <div class="rounded-div bg-card p-8 shadow transition hover:shadow-lg">
                        <img
                            src="{{ $t->image }}"
                            alt="{{ $t->name }}"
                            class="mx-auto mb-6 h-20 w-20 rounded-full object-cover"
                        />
                        <h3 class="mb-1 text-xl font-semibold">{{ $t->name }}</h3>
                        <p class="mb-1 text-sm text-primary">{{ $t->organisation }}</p>
                        <p class="text-muted-foreground">{{ $t->designation }}</p>
                        <p class="mt-3 text-muted-foreground">{{ $t->message }}</p>
                    </div>
                @endforeach
            </div>
        </x-container>
    </section>
@endif