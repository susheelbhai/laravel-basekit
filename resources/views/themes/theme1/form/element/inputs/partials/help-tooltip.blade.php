{{-- input-help-tool.tsx --}}
@if (! empty($help))
    <div class="group relative inline-block">
        <span class="cursor-help text-sm italic text-muted-foreground">What is this?</span>
        <div
            class="invisible absolute bottom-full left-1/2 z-10 mb-2 w-max max-w-xs -translate-x-1/2 rounded bg-gray-800 px-4 py-4 text-white shadow-lg group-hover:visible"
        >
            <div>{!! $help !!}</div>
        </div>
    </div>
@endif
