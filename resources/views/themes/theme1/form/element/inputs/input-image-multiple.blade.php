{{-- input-image-multiple.tsx: hidden multi file, dashed box, preview grid --}}
@php
    $__imid = 'imgs_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', $name);
@endphp
<div class="mb-4 space-y-1">
    <label for="{{ $__imid }}_ctl" class="{{ $labelClass }}">
        {{ $label }}{!! $requiredMark !!}
    </label>
    <input
        id="{{ $__imid }}_ctl"
        name="{{ $name }}[]"
        type="file"
        accept="image/*"
        multiple
        class="hidden"
        {{ $required }}
        {{ $attributes }}
    >
    <div
        id="{{ $__imid }}_box"
        role="button"
        tabindex="0"
        onclick="document.getElementById('{{ $__imid }}_ctl').click()"
        onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault();document.getElementById('{{ $__imid }}_ctl').click();}"
        ondragover="event.preventDefault(); this.classList.add('border-secondary','bg-input-focused-bg');"
        ondragleave="event.preventDefault(); this.classList.remove('border-secondary','bg-input-focused-bg');"
        ondrop="event.preventDefault(); this.classList.remove('border-secondary','bg-input-focused-bg'); var inp=document.getElementById('{{ $__imid }}_ctl'); var src=event.dataTransfer.files; if(src&&src.length){var d=new DataTransfer(); for(var i=0;i<src.length;i++){d.items.add(src[i]);} inp.files=d.files; inp.dispatchEvent(new Event('change'));}"
        class="relative flex cursor-pointer items-center justify-center overflow-hidden rounded-div border-2 border-dashed border-input-border bg-input-bg transition-colors hover:bg-input-hover-bg"
        style="height: 7.5rem; width: 30rem; max-width: 100%;"
    >
        <div class="text-center text-input-placeholder">
            <p class="text-sm font-medium">Click or drag to upload multiple images</p>
        </div>
    </div>
    <div id="{{ $__imid }}_grid" class="mt-2 grid max-h-60 gap-2 overflow-y-auto" style="grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));"></div>
    @error($name)
        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
    @foreach ($errors->keys() as $__errKey)
        @if (str_starts_with($__errKey, $name.'.'))
            @foreach ($errors->get($__errKey) as $__msg)
                <p class="text-sm text-red-600 dark:text-red-400">{{ $__msg }}</p>
            @endforeach
        @endif
    @endforeach
</div>
<script>
    (function() {
        var ctl = document.getElementById('{{ $__imid }}_ctl');
        var grid = document.getElementById('{{ $__imid }}_grid');
        if (!ctl || !grid) return;
        ctl.addEventListener('change', function() {
            grid.innerHTML = '';
            if (!ctl.files || !ctl.files.length) return;
            for (var i = 0; i < ctl.files.length; i++) {
                (function(file) {
                    var r = new FileReader();
                    r.onload = function(e) {
                        var wrap = document.createElement('div');
                        wrap.className = 'relative group rounded-div overflow-hidden border border-input-border';
                        wrap.style.width = '100%';
                        wrap.style.height = '100px';
                        var img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'h-full w-full object-cover';
                        img.alt = '';
                        wrap.appendChild(img);
                        grid.appendChild(wrap);
                    };
                    r.readAsDataURL(file);
                })(ctl.files[i]);
            }
        });
    })();
</script>
