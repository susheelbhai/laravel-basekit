<div class="relative group">
    <button
        type="button"
        class="rounded-full px-3 py-2 text-sm font-medium transition-colors hover:bg-muted hover:text-primary"
    >
        {{ $name }}
    </button>

    <div class="absolute left-0 top-full z-50 hidden min-w-56 rounded-div border border-border bg-card p-2 shadow-lg group-hover:block">
        <div class="grid gap-1">
            {{ $slot }}
        </div>
    </div>
</div>
