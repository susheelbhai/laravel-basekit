<div class="bg-background text-foreground">
    <div
        class="h-64 w-full bg-cover bg-center"
        style="background-image: url('{{ $data['display_img'] ?? '' }}')"
    >
        <div class="flex h-full w-full items-center justify-center bg-black/40 dark:bg-black/70">
            <h1 class="text-4xl font-bold text-primary-foreground md:text-5xl dark:text-white dark:drop-shadow-lg">
                {{ $data['title'] }}
            </h1>
        </div>
    </div>

    <x-container class="grid grid-cols-1 gap-10 px-4 py-16 md:grid-cols-3">
        <div class="space-y-6 md:col-span-2">
            @if (!empty($data['display_img']))
                <img src="{{ $data['display_img'] }}" alt="{{ $data['title'] }}" class="mb-4 w-full rounded-div shadow" />
            @endif

            <p class="text-lg text-muted-foreground">{{ $data['short_description'] }}</p>

            <div class="flex flex-wrap gap-4 text-sm text-muted-foreground">
                <span class="inline-flex items-center gap-1"><span class="opacity-70">by</span> {{ $data['author'] }}</span>
                <span class="inline-flex items-center gap-1">{{ $data['created_at'] }}</span>
                <span class="inline-flex items-center gap-1">{{ $data['category'] }}</span>
            </div>

            <div class="space-y-4 prose prose-neutral max-w-none dark:prose-invert">
                <section>{!! $data['long_description1'] !!}</section>
                @if (!empty($data['highlighted_text1']))
                    <div class="rounded-div bg-muted/80 p-4 text-center text-lg font-medium ring-1 ring-border">
                        {{ $data['highlighted_text1'] }}
                    </div>
                @endif
                <section>{!! $data['long_description2'] !!}</section>
                @if (!empty($data['highlighted_text2']))
                    <div class="rounded-div bg-muted/80 p-4 text-center text-lg font-medium ring-1 ring-border">
                        {{ $data['highlighted_text2'] }}
                    </div>
                @endif
                <section>{!! $data['long_description3'] !!}</section>
            </div>

            @relativeInclude('_comment')
        </div>

        <aside class="space-y-6 md:col-span-1">
            @if (!empty($data['ad_url']) && !empty($data['ad_img']))
                <a href="{{ $data['ad_url'] }}" target="_blank" rel="noopener noreferrer" class="block overflow-hidden rounded-div bg-background2 shadow">
                    <img src="{{ $data['ad_img'] }}" alt="" class="w-full" />
                </a>
            @endif

            <div class="space-y-4 rounded-div border border-sidebar-border bg-sidebar p-6 shadow">
                <h3 class="mb-2 text-xl font-semibold text-sidebar-foreground">Related Blogs</h3>
                <ul class="space-y-3 text-sm text-sidebar-foreground">
                    @foreach ($data['related_blogs'] ?? [] as $related)
                        <li>
                            <a href="{{ route('blog.show', $related->slug) }}" class="flex gap-3 hover:underline">
                                @if ($related->display_img)
                                    <img src="{{ $related->display_img }}" alt="" class="h-14 w-14 shrink-0 rounded object-cover" />
                                @endif
                                <span class="leading-snug">{{ $related->title }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </x-container>
</div>
