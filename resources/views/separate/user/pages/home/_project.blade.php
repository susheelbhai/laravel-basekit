<section id="projects" class="bg-background2 py-20 md:py-28">
    <x-container class="px-4 text-center">
        <div class="mb-10">
            <p class="text-sm font-semibold tracking-wider text-primary uppercase">Our Projects</p>
            <h2 class="mt-2 text-3xl font-bold">Latest Case Studies</h2>
        </div>

        <div class="grid gap-8 md:grid-cols-3">
            @foreach(($projects ?? []) as $project)
                <div class="overflow-hidden rounded-div bg-card shadow transition hover:shadow-lg">
                    <img
                        src="{{ data_get($project, 'image') }}"
                        alt="{{ data_get($project, 'title') }}"
                        class="w-full"
                    />
                    <div class="p-6 text-left">
                        <span class="text-xs font-semibold tracking-wider text-primary uppercase">
                            {{ data_get($project, 'category') }}
                        </span>
                        <h3 class="mt-1 text-xl font-semibold">{{ data_get($project, 'title') }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </x-container>
</section>