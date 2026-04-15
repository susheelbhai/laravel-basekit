{{-- input-date-picker.tsx: Label (no *); HelpTooltip; relative + Input (pr-10) + ghost icon button right --}}
@php
    $__dpSafe = preg_replace('/[^a-zA-Z0-9_-]/', '_', $name);
@endphp
<div class="mb-4 space-y-1">
    <div class="relative w-full">
        <label for="{{ $__dpSafe }}_visible" class="{{ $labelClass }}">{{ $label }}</label>
        @include($__formTheme . '.form.element.inputs.partials.help-tooltip')
        <div class="relative">
            <input
                id="{{ $__dpSafe }}_visible"
                name="{{ $name }}"
                type="text"
                value="{{ old($name, $value) }}"
                placeholder="{{ $placeholder ?: 'YYYY-MM-DD' }}"
                maxlength="10"
                class="{{ $inputDatePickerClass }} datepicker-default"
                {{ $required }}
                {{ $attributes }}
            >
            <button
                type="button"
                tabindex="-1"
                class="absolute top-0 right-0 flex h-9 items-center px-3 hover:bg-transparent"
                aria-label="Calendar"
                onclick="document.getElementById('{{ $__dpSafe }}_visible').focus();"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </button>
        </div>
        @include($__formTheme . '.form.element.inputs.partials.field-error')
    </div>
</div>
