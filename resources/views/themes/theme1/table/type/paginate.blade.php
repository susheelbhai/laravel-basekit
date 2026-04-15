<div {{ $attributes->merge(['class' => 'flex flex-col gap-4']) }}>
    @if ($addUrl != '#')
        <div>
            <a
                href="{{ $addUrl }}"
                class="inline-flex items-center gap-2 rounded-div bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow-sm transition-colors hover:bg-primary/90 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"
            >
                <i class="fa fa-plus text-xs" aria-hidden="true"></i>
                <span>Add New</span>
            </a>
        </div>
    @endif

    <div class="border-sidebar-border/70 dark:border-sidebar-border relative min-h-0 flex-1 overflow-hidden rounded-div border md:min-h-min">
        <div class="flex flex-wrap items-center justify-between gap-2 border-b border-border bg-muted/30 px-4 py-3">
            <h2 class="text-base font-semibold text-foreground">{{ $title }}</h2>
            <div class="flex items-center gap-2">
                {{ $status ?? '' }}
                @if (($inputName ?? '') != '')
                    <input
                        type="text"
                        wire:model.live="{{ $inputName }}"
                        placeholder="Search"
                        class="h-9 w-64 max-w-full rounded-div border border-border bg-background px-3 text-sm text-foreground shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring"
                    >
                @endif
            </div>
        </div>

        <div class="overflow-x-auto bg-background">
            <table class="min-w-full border-collapse border-0 bg-background text-sm">
                {{ $slot }}
            </table>
        </div>

        <div class="border-t border-border bg-background px-4 py-3">
            {{ $data2->links() }}
        </div>
    </div>
</div>
