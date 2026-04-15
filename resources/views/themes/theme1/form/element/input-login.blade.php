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
    $requiredMark = $required == 'required'
        ? "<span class='text-destructive'>*</span>"
        : '';

    $inputBase = 'mt-1 block w-full rounded-input border border-input bg-input-bg px-3 py-2 text-sm text-input-text placeholder:text-input-placeholder focus:outline-none focus:ring-2 focus:ring-ring';
@endphp

<div class="{{ $col_class }}">
    @if ($type == 'text' || $type == 'number' || $type == 'file' || $type == 'email')
        <label for="{{ $name }}" class="text-sm font-medium text-foreground">
            {{ $label }} {!! $requiredMark !!}
        </label>
        <input class="{{ $inputBase }}" type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}" {{ $required }} {{ $attributes }}>
    @endif

    @if ($type == 'password')
        @php
            $passwordToggleFn = 'togglePassword_' . preg_replace('/[^a-zA-Z0-9_]/', '_', (string) $name);
        @endphp
        <label for="{{ $name }}" class="text-sm font-medium text-foreground">
            {{ $label }} {!! $requiredMark !!}
        </label>
        <div class="relative">
            <input class="{{ $inputBase }} pr-10" type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
                placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}" {{ $required }}
                {{ $attributes }}>
            <button
                type="button"
                class="absolute right-0 top-0 flex h-full cursor-pointer items-center px-3 py-2 text-muted-foreground hover:bg-transparent focus:outline-none"
                aria-label="Toggle password visibility"
                tabindex="-1"
                onclick="{{ $passwordToggleFn }}()"
            >
                <svg id="{{ $name }}_pw_eye" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 shrink-0" aria-hidden="true"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                <svg id="{{ $name }}_pw_eye_off" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden h-4 w-4 shrink-0" aria-hidden="true"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
            </button>
        </div>

        <script>
            function {{ $passwordToggleFn }}() {
                var x = document.getElementById("{{ $name }}");
                var eye = document.getElementById("{{ $name }}_pw_eye");
                var eyeOff = document.getElementById("{{ $name }}_pw_eye_off");
                if (!x) return;
                if (x.type === "password") {
                    x.type = "text";
                    if (eye) eye.classList.add("hidden");
                    if (eyeOff) eyeOff.classList.remove("hidden");
                } else {
                    x.type = "password";
                    if (eye) eye.classList.remove("hidden");
                    if (eyeOff) eyeOff.classList.add("hidden");
                }
            }
        </script>
    @endif


    @if ($type == 'switch')
        <label for="{{ $name }}" class="text-sm font-medium text-foreground">
            {{ $label }} {!! $requiredMark !!}
        </label>
        <div class="mt-2 flex items-center gap-2">
            <input name="{{ $name }}" id="{{ $name }}" type="checkbox"
                class="h-4 w-4 rounded border-input text-primary focus:ring-ring"
                {{ $value == 1 ? 'checked' : '' }} {{ $attributes }}>
        </div>
    @endif

    @if ($type == 'select')
        <label for="{{ $name }}" class="text-sm font-medium text-foreground">
            {{ $label }} {!! $requiredMark !!}
        </label>
        <select name="{{ $name }}" id="{{ $name }}" class="{{ $inputBase }}" {{ $attributes }}>
            <option value="">Choose...</option>
            @foreach ($options as $i)
                <option value="{{ $i->id }}" {{ $i->id == $value ? 'selected' : '' }}>{{ $i->name }}
                </option>
            @endforeach
        </select>
    @endif

    @if ($type == 'hidden')
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
            value="{{ old($name, $value) }}" {{ $attributes }}>
    @endif

    @if ($type == 'remember')
        <div class="mt-4 flex items-center gap-2">
            <input type="checkbox" class="h-4 w-4 rounded border-input text-primary focus:ring-ring" id="{{ $name }}" {{ $attributes }}>
            <label class="text-sm text-foreground" for="{{ $name }}">
                {{ $label }}
            </label>
        </div>
    @endif

    @error($name)
        <x-form.validation-error :value="$message" />
    @enderror
</div>
