{{-- input-date.tsx: Label without required star; HelpTooltip; Input; InputError inside relative w-full --}}
<div class="mb-4 space-y-1">
    <div class="relative w-full">
        <label for="{{ $name }}" class="{{ $labelClass }}">{{ $label }}</label>
        @include($__formTheme . '.form.element.inputs.partials.help-tooltip')
        <input
            id="{{ $name }}"
            type="{{ $type }}"
            name="{{ $name }}"
            value="{{ old($name, $value) }}"
            class="{{ $inputBase }}"
            {{ $required }}
            {{ $attributes }}
        >
        @include($__formTheme . '.form.element.inputs.partials.field-error')
    </div>
</div>
