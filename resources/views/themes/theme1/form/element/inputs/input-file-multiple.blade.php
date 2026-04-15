{{-- input-file-multiple.tsx: h-40 w-150; list file names when selected --}}
@php
    $__fid = 'mf_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', $name);
@endphp
<div class="mb-4 space-y-1">
    <label for="{{ $__fid }}_ctl" class="{{ $labelClass }}">
        {{ $label }}{!! $requiredMark !!}
    </label>
    <div class="space-y-2">
        <input
            id="{{ $__fid }}_ctl"
            name="{{ $name }}[]"
            type="file"
            multiple
            class="hidden"
            {{ $required }}
            {{ $attributes }}
            onchange="(function(el){var z=document.getElementById('{{ $__fid }}_zone'); if(!z)return; var t=z.querySelector('[data-multi-label]'); if(!el.files||!el.files.length){t.innerHTML='<p class=\'text-sm font-medium\'>Drag & drop or click to upload (multiple files allowed)</p>'; return;} var c=el.files.length; var html='<p class=\'font-semibold text-sm mb-1\'>'+c+' file'+(c>1?'s':'')+' selected:</p><ol class=\'list-decimal list-inside text-xs text-left space-y-1\'>'; for(var i=0;i<c;i++){html+='<li>'+el.files[i].name+'</li>';} html+='</ol>'; t.innerHTML=html;})(this)"
        >
        <div
            id="{{ $__fid }}_zone"
            role="button"
            tabindex="0"
            onclick="document.getElementById('{{ $__fid }}_ctl').click()"
            onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault();document.getElementById('{{ $__fid }}_ctl').click();}"
            ondragover="event.preventDefault(); this.classList.add('border-blue-500','bg-blue-100');"
            ondragleave="event.preventDefault(); this.classList.remove('border-blue-500','bg-blue-100');"
            ondrop="event.preventDefault(); this.classList.remove('border-blue-500','bg-blue-100'); var inp=document.getElementById('{{ $__fid }}_ctl'); var src=event.dataTransfer.files; if(src&&src.length){var d=new DataTransfer(); for(var i=0;i<src.length;i++){d.items.add(src[i]);} inp.files=d.files; inp.dispatchEvent(new Event('change'));}"
            class="relative flex h-40 w-full max-w-2xl cursor-pointer items-center justify-center overflow-auto rounded-div border-2 border-dashed border-input-border bg-input-bg transition-colors hover:bg-input-focused-bg"
        >
            <div class="text-foreground px-2 py-2 text-center" data-multi-label>
                <p class="text-sm font-medium">Drag & drop or click to upload (multiple files allowed)</p>
            </div>
        </div>
    </div>
    @include($__formTheme . '.form.element.inputs.partials.field-error')
</div>
