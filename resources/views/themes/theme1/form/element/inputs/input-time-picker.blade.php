{{-- input-time-picker.tsx: Label may include HelpTooltip as sibling inside Label; native time fallback --}}
<div class="mb-4 space-y-1">
    @if ($label)
        <label for="{{ $name }}" class="{{ $labelClass }} inline-flex flex-wrap items-center gap-2">
            <span>{{ $label }}</span>
            @include($__formTheme . '.form.element.inputs.partials.help-tooltip')
        </label>
    @else
        @include($__formTheme . '.form.element.inputs.partials.help-tooltip')
    @endif
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="time"
        value="{{ old($name, $value) }}"
        class="{{ $inputBase }}"
        {{ $required }}
        {{ $attributes }}
    >
    @include($__formTheme . '.form.element.inputs.partials.field-error')
</div>
