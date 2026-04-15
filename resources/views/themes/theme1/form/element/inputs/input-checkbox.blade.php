{{-- input-checkbox.tsx --}}
<div class="mb-4 space-y-1">
    <div class="flex items-center gap-2">
        <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="checkbox"
            value="1"
            class="h-5 w-5 appearance-auto cursor-pointer rounded-div border-2 border-input-border bg-input-bg accent-secondary transition checked:border-input-border checked:bg-secondary focus:ring-2 focus:ring-secondary focus:ring-offset-0 focus:ring-offset-input-bg"
            {{ old($name, $value) == 1 || old($name, $value) === true || old($name, $value) === '1' ? 'checked' : '' }}
            {{ $required }}
            {{ $attributes }}
        >
        <label for="{{ $name }}" class="{{ $labelClass }} cursor-pointer text-foreground">
            {{ $label }}{!! $requiredMark !!}
        </label>
    </div>
    @include($__formTheme . '.form.element.inputs.partials.field-error')
</div>
