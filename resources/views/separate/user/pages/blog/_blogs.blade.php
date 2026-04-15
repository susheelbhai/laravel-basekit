<div class="min-h-screen bg-linear-to-b from-background to-card text-foreground">
    <div
        class="relative h-64 w-full bg-cover bg-center"
        style="background-image: url('{{ asset('images/blogs-banner.jpg') }}')"
    >
        <div class="absolute inset-0 flex items-center justify-center bg-black/40">
            <h1 class="text-4xl font-extrabold tracking-tight text-primary-foreground drop-shadow-lg md:text-5xl">Blogs</h1>
        </div>
    </div>

    <x-container class="px-4 py-16">
        <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($data as $blog)
                <a href="{{ route('blog.show', $blog->slug) }}" class="group flex h-full flex-col">
                    <div class="flex h-full flex-col rounded-div border border-border bg-card p-6 shadow-sm transition-all duration-200 hover:-translate-y-1 hover:shadow-xl">
                        @if ($blog->display_img)
                            <div class="mb-4 flex justify-center">
                                <img
                                    src="{{ $blog->display_img }}"
                                    alt="{{ $blog->title }}"
                                    class="h-32 w-32 rounded-full border-4 border-primary object-cover shadow-md transition-transform duration-200 group-hover:scale-105"
                                />
                            </div>
                        @endif
                        <h3 class="mb-2 text-2xl font-bold text-foreground transition-colors duration-200 group-hover:text-primary">
                            {{ $blog->title }}
                        </h3>
                        <p class="mb-4 line-clamp-3 text-base text-muted-foreground">{{ $blog->short_description }}</p>
                        <div class="mt-auto flex justify-end">
                            <span class="inline-block rounded-full bg-primary px-4 py-1 text-xs font-semibold text-primary-foreground transition-colors duration-200 group-hover:bg-foreground group-hover:text-primary">
                                Read More
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </x-container>
</div>
