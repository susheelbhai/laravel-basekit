<section id="newsletter" class="bg-background py-20 md:py-28">
    <x-container class="px-4 text-center">
        <div class="mb-10">
            <p class="text-sm font-semibold tracking-wider text-primary uppercase">Newsletter</p>
            <h2 class="mt-2 text-3xl font-bold">Stay Updated With Our Latest News</h2>
        </div>

        <form method="post" action="{{ route('newsletter') }}" class="mx-auto max-w-md">
            @csrf
            <div class="flex w-full items-stretch overflow-hidden rounded-full border border-primary bg-background">
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    class="min-w-0 flex-1 border-0 bg-transparent px-4 py-2.5 text-sm text-foreground placeholder:text-muted-foreground outline-none focus:outline-none focus:ring-0"
                    required
                />
                <button
                    type="submit"
                    class="m-0 inline-flex h-full min-h-0 shrink-0 cursor-pointer items-center justify-center gap-2 self-stretch whitespace-nowrap rounded-div rounded-r-full border-2 border-primary bg-primary px-6 py-2 text-sm font-semibold text-primary-foreground shadow-xs outline-none transition-[color,box-shadow] hover:border-primary/90 hover:bg-primary/90 focus:border-primary/90 focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 active:border-primary/90 disabled:pointer-events-none disabled:opacity-50"
                >
                    Subscribe
                </button>
            </div>
            @error('email')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </form>
    </x-container>
</section>
