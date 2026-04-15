<x-layout.user.app>
    <x-slot name="head">
        <title>FAQ | {{ config('app.name') }}</title>
    </x-slot>

    <x-container>
        <h1 class="mb-8 text-3xl font-bold">Help &amp; Support Center</h1>

        @foreach ($data as $section)
            <div class="mb-8">
                <h2 class="mb-4 text-2xl font-semibold">{{ $section['category_title'] }}</h2>
                <div class="space-y-3">
                    @foreach ($section['faqs'] as $faq)
                        <details class="group rounded-div border border-border bg-card shadow-sm">
                            <summary class="cursor-pointer list-none px-4 py-3 font-medium text-foreground marker:content-none [&::-webkit-details-marker]:hidden">
                                <span class="flex items-center justify-between gap-2">
                                    {{ $faq['question'] }}
                                    <span class="text-muted-foreground transition group-open:rotate-180">▼</span>
                                </span>
                            </summary>
                            <div class="border-t border-border px-4 py-3 text-sm text-muted-foreground prose prose-neutral max-w-none dark:prose-invert">
                                {!! $faq['answer'] !!}
                            </div>
                        </details>
                    @endforeach
                </div>
            </div>
        @endforeach
    </x-container>
</x-layout.user.app>
