@php

    switch ($div) {
        case 1:
            $col_class = 'col-span-12';
            break;

        default:
            $col_class = 'col-span-6';
            break;
    }
@endphp
@if ($type == 'add')
    <div class="{{ $col_class }}">
        <button
            type="button"
            {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 rounded-button bg-primary px-4 py-2.5 text-sm font-medium text-primary-foreground hover:opacity-95']) }}
        >
            <span class="text-sm font-medium">+</span>
            <span> {{ $title }} </span>
        </button>
    </div>
@endif

@if ($type == 'submit')
    <div class="{{ $col_class }}">
        <button
            type="{{ $type }}"
            {{ $attributes->merge(['class' => 'inline-flex items-center justify-center rounded-button bg-primary px-4 py-2.5 text-sm font-medium text-primary-foreground hover:opacity-95']) }}
        >
            {{ $title }}
        </button>
    </div>
@endif
