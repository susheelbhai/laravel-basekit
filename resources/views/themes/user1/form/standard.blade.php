<div {{ $attributes }}>
    <div class="rounded-div border border-border bg-card text-card-foreground shadow-sm">
        <div class="border-b border-border px-6 py-4">
            <h2 class="text-base font-medium">{{ $title }}</h2>
        </div>

        <div class="px-6 py-6">
            <form method="{{ $method }}" action="{{ $action }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-12 gap-4">
                    {{ $slot }}
                </div>

                @if ($action != '#')
                    <div class="flex items-center justify-end">
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-button bg-primary px-4 py-2.5 text-sm font-medium text-primary-foreground hover:opacity-95"
                        >
                            {{ $submitName }}
                        </button>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>