@if (Session::has('success'))
    <div class="mb-4 flex items-start gap-3 rounded-div border border-border bg-muted px-4 py-3 text-sm text-foreground">
        <svg viewBox="0 0 24 24" width="18" height="18" stroke="currentColor" stroke-width="2" fill="none"
            stroke-linecap="round" stroke-linejoin="round" class="mt-0.5 text-success">
            <polyline points="9 11 12 14 22 4"></polyline>
            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
        </svg>
        <div class="flex-1">
            <span class="font-medium">Success!</span> {{ Session::get('success') }}
        </div>
    </div>
@endif
