@php
    switch ($div) {
        case 1:
            $col_class = 'col-span-12';
            break;

        default:
            $col_class = 'col-span-6';
    }

    $__formTheme = data_get(session('user'), 'theme', 'themes.theme1');

    // label.tsx
    $labelClass = 'text-sm leading-none font-medium select-none group-data-[disabled=true]:pointer-events-none group-data-[disabled=true]:opacity-50 peer-disabled:cursor-not-allowed peer-disabled:opacity-50';

    $requiredMark = $required == 'required'
        ? '<span class="text-xl font-bold text-red-500">*</span>'
        : '';

    // input.tsx cn(...) merged with InputText / InputDate / InputDefault overlay (bg-input-bg wins over bg-transparent)
    $inputBase = 'flex h-9 w-full min-w-0 rounded-input border border-input-border bg-input-bg px-3 py-1 text-base text-input-text shadow-xs outline-none transition-[color,box-shadow] selection:bg-primary selection:text-primary-foreground file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium file:text-foreground placeholder:text-input-placeholder hover:bg-input-hover-bg focus:bg-input-focused-bg focus:text-input-focused-text focus-visible:border-secondary focus-visible:ring-[3px] focus-visible:ring-secondary/50 disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm aria-invalid:border-destructive aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40';

    // input-textarea.tsx
    $textareaBase = 'flex w-full rounded-textarea border-2 border-input-border bg-input-bg px-3 py-2 text-sm text-input-text placeholder:text-input-placeholder hover:bg-input-hover-bg focus:outline-none focus:border-secondary/60 focus:bg-input-focused-bg focus:text-input-focused-text disabled:cursor-not-allowed disabled:opacity-50';

    // input-select.tsx select className
    $selectBase = 'flex h-10 w-full rounded-div border-2 border-input-border bg-input-bg px-3 py-2 text-sm text-input-text placeholder:text-input-placeholder hover:bg-input-hover-bg focus:border-secondary/60 focus:outline-none focus:bg-input-focused-bg focus:text-input-focused-text disabled:cursor-not-allowed disabled:opacity-50';

    // input-tags.tsx inner input
    $tagsInputBase = 'w-full rounded-div border-2 border-input-border bg-input-bg px-3 py-2 text-sm text-input-text placeholder:text-input-placeholder hover:bg-input-hover-bg focus:outline-none focus:border-secondary/60 focus:bg-input-focused-bg focus:text-input-focused-text';

    // input-date-picker.tsx Input + pr-10
    $inputDatePickerClass = $inputBase . ' pr-10';
@endphp

<div class="{{ $col_class }}">
    @switch($type)
        @case('text')
        @case('email')
        @case('password')
        @case('tel')
        @case('number')
        @case('url')
            @include($__formTheme . '.form.element.inputs.input-text')
            @break

        @case('hidden')
            @include($__formTheme . '.form.element.inputs.input-hidden')
            @break

        @case('editor')
            @include($__formTheme . '.form.element.inputs.input-editor')
            @break

        @case('textarea')
            @include($__formTheme . '.form.element.inputs.input-textarea')
            @break

        @case('date')
        @case('datetime-local')
            @include($__formTheme . '.form.element.inputs.input-date')
            @break

        @case('date-picker')
        @case('date_picker')
            @include($__formTheme . '.form.element.inputs.input-date-picker')
            @break

        @case('date-range-picker')
        @case('date-range-picker-expended')
            @include($__formTheme . '.form.element.inputs.input-date-range-picker')
            @break

        @case('time-picker')
        @case('clock-time-picker')
        @case('time')
            @include($__formTheme . '.form.element.inputs.input-time-picker')
            @break

        @case('date-time-picker')
            @include($__formTheme . '.form.element.inputs.input-datetime-picker')
            @break

        @case('radio')
            @include($__formTheme . '.form.element.inputs.input-radio')
            @break

        @case('select')
            @include($__formTheme . '.form.element.inputs.input-select')
            @break

        @case('multiselect')
            @include($__formTheme . '.form.element.inputs.input-multi-select')
            @break

        @case('checkbox')
            @include($__formTheme . '.form.element.inputs.input-checkbox')
            @break

        @case('multicheckbox')
            @include($__formTheme . '.form.element.inputs.input-multi-checkbox')
            @break

        @case('image')
            @include($__formTheme . '.form.element.inputs.input-image')
            @break

        @case('file')
            @include($__formTheme . '.form.element.inputs.input-file')
            @break

        @case('images')
            @include($__formTheme . '.form.element.inputs.input-image-multiple')
            @break

        @case('files')
            @include($__formTheme . '.form.element.inputs.input-file-multiple')
            @break

        @case('switch')
            @include($__formTheme . '.form.element.inputs.input-switch')
            @break

        @case('tags')
            @include($__formTheme . '.form.element.inputs.input-tags')
            @break

        @case('color')
            @include($__formTheme . '.form.element.inputs.input-color')
            @break

        @default
            @include($__formTheme . '.form.element.inputs.input-default')
    @endswitch
</div>
