<li>
    <details class="group">
        <summary class="flex cursor-pointer list-none items-center justify-between rounded-input px-3 py-2 text-sm text-muted-foreground hover:bg-muted hover:text-foreground">
            <span class="flex items-center gap-2">
                <span class="text-muted-foreground">▦</span>
                <span class="truncate">{{ $name }}</span>
            </span>
            <span class="ms-auto flex shrink-0 text-muted-foreground" aria-hidden="true">
                <svg class="size-4 transition-transform duration-200 group-open:rotate-180" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </span>
        </summary>
        <ul class="mt-1 space-y-1 pl-3">
            {{ $slot }}
        </ul>
    </details>
</li>