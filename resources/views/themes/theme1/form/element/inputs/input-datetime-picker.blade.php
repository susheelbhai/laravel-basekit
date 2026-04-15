{{-- input-datetime-picker.tsx composes InputDatePicker + InputTimePicker; Blade: single datetime-local for one name --}}
<div class="mb-4 space-y-1">
    @if ($label)
        <div class="mb-1 flex flex-wrap items-center gap-2">
            <span class="{{ $labelClass }}">{{ $label }}</span>
            @if (! empty($help))
                <span class="text-xs text-muted-foreground">{!! $help !!}</span>
            @endif
        </div>
    @endif
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="datetime-local"
        value="{{ old($name, $value) }}"
        class="{{ $inputBase }}"
        {{ $required }}
        {{ $attributes }}
    >
    @include($__formTheme . '.form.element.inputs.partials.field-error')
</div>
