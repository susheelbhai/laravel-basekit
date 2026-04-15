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

@php
    $inputBase = 'mt-1 block w-full rounded-input border border-input bg-input-bg px-3 py-2 text-sm text-input-text placeholder:text-input-placeholder focus:outline-none focus:ring-2 focus:ring-ring';
@endphp


    @if ($type == 'text' || $type == 'number' || $type == 'file' || $type == 'email' || $type == 'date' || $type == 'time' || $type == 'url')
        <input class="{{ $inputBase }}" type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}" {{ $required }} {{ $attributes }}>
    @endif

    @if ($type == 'password')
        <div class="relative">
        <input class="{{ $inputBase }} pr-10" type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}" {{ $required }}
            {{ $attributes }}>
        <button
            type="button"
            class="absolute inset-y-0 right-0 flex items-center px-3 text-muted-foreground"
            tabindex="-1"
            onclick="tooglePassword_{{ $name }}()"
        >
            <span id="{{ $name }}_toggle_icon">Show</span>
        </button>
        </div>

        <script>
            function tooglePassword_{{ $name }}() {
                var x = document.getElementById("{{ $name }}");
                var y = document.getElementById("{{ $name }}_toggle_icon");
                if (x.type === "password") {
                    x.type = "text";
                    if (y) y.textContent = "Hide";
                } else {
                    x.type = "password";
                    if (y) y.textContent = "Show";
                }
            }
        </script>
    @endif

    @if ($type == 'textarea')
        <textarea class="mt-1 block w-full rounded-textarea border border-input bg-input-bg px-3 py-2 text-sm text-input-text placeholder:text-input-placeholder focus:outline-none focus:ring-2 focus:ring-ring" name="{{ $name }}" id="{{ $name }}" cols="30" rows="10"
            {{ $required }} {{ $attributes }}>{{ old($name, $value) }}</textarea>
    @endif

    @if ($type == 'switch')
        <label class="slide_check_box_toggle" for="{{ $name }}">
            <input name="{{ $name }}" id="{{ $name }}" type="checkbox"
                {{ $value == 1 ? 'checked' : '' }} {{ $attributes }}>
            <span class="slide_check_box"></span>
            <span class="slide_check_box_labels" data-on="Active" data-off="Not Active"></span>
        </label>
    @endif

    @if ($type == 'select')
        <select name="{{ $name }}" id="{{ $name }}" class="{{ $inputBase }}" {{ $attributes }}  {{ $required }} >
            <option value="">Choose...</option>
            @foreach ($options as $i)
                <option value="{{ $i->id }}" {{ $i->id == $value ? 'selected' : '' }}>{{ $i->name }}
                </option>
            @endforeach
        </select>
    @endif

    @if ($type == 'color')
        <div class="mt-2">
            <div class="example">
                <label for="{{ $name }}" class="text-sm font-medium text-foreground">{{ $label }}</label>
                <input name="{{ $name }}" id="{{ $name }}" type="text"
                    class="as_colorpicker {{ $inputBase }}" value="{{ old($name, $value) }}" {{ $required }}>
            </div>

        </div>
    @endif

    @if ($type == 'date_picker')
        <div class="mt-2">
            <div class="example">
                <label for="{{ $name }}" class="text-sm font-medium text-foreground">{{ $label }}</label>
                <input name="datepicker" class="datepicker-default {{ $inputBase }}" id="datepicker">
            </div>

        </div>
    @endif


    @if ($type == 'hidden')
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            value="{{ old($name, $value) }}" {{ $attributes }}>
    @endif


    @if ($type == 'editor')
        <style>
            .cke_contents {
                height: 320px !important;
            }
        </style>
        <label for="{{ $name }}" class="text-sm font-medium text-foreground">
            {{ $label }}
            {!! $required == 'required' ? "<span class='text-destructive'>*</span>" : '' !!}
        </label>
        <textarea class="ck_editor" name="{{ $name }}" id="{{ $name }}" {{ $attributes }}>{{ old($name, $value) }}</textarea>
        <script>
            $(function() {
                "use strict";
                CKEDITOR.replace('{{ $name }}')
            });
        </script>
    @endif


    @if ($type == 'tags')
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css"
            rel="stylesheet" />
        <div class="mt-2">
            <label for="{{ $name }}" class="text-sm font-medium text-foreground">{{ $label }}</label>
            <input type="text" class="{{ $inputBase }}" id="{{ $name }}" name="{{ $name }}"
                value="{{ old($name, $value) }}" data-role="tagsinput" />
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
        <script>
            $(function() {
                $('#{{ $name }}')
                    .on('change', function(event) {
                        var $element = $(event.target);
                        var $container = $element.closest('.example');

                        if (!$element.data('tagsinput')) return;

                        var val = $element.val();
                        if (val === null) val = 'null';
                        var items = $element.tagsinput('items');

                        $('code', $('pre.val', $container)).html(
                            $.isArray(val) ?
                            JSON.stringify(val) :
                            '"' + val.replace('"', '\\"') + '"'
                        );
                        $('code', $('pre.items', $container)).html(
                            JSON.stringify($element.tagsinput('items'))
                        );
                    })
                    .trigger('change');
                $(".bootstrap-tagsinput").addClass('mt-1 block w-full rounded-input border border-input bg-input-bg px-3 py-2 text-sm');
            });
        </script>
    @endif

    @error($name)
        <x-form.validation-error :value="$message" />
    @enderror