{{-- input-tags.tsx: chips + remove; Enter adds; hidden field submits comma-separated for classic forms --}}
@php
    $__tid = 'tags_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', $name);
    $initial = old($name, $value);
    if (is_array($initial)) {
        $initialTags = array_values(array_filter(array_map('strval', $initial)));
    } else {
        $initialTags = array_values(array_filter(array_map('trim', explode(',', (string) $initial))));
    }
@endphp
<div class="mb-4 space-y-1">
    @if ($label)
        <label for="{{ $__tid }}_entry" class="{{ $labelClass }}">{{ $label }}</label>
    @endif
    <div class="space-y-2">
        <div id="{{ $__tid }}_chips" class="flex flex-wrap gap-2"></div>
        <input
            type="text"
            id="{{ $__tid }}_entry"
            class="{{ $tagsInputBase }}"
            placeholder="{{ $placeholder ?: 'Type and press Enter' }}"
            autocomplete="off"
        >
        <input type="hidden" name="{{ $name }}" id="{{ $__tid }}_value" value="{{ implode(',', $initialTags) }}">
    </div>
    @include($__formTheme . '.form.element.inputs.partials.field-error')
</div>
<script>
    (function () {
        var hid = document.getElementById('{{ $__tid }}_value');
        var entry = document.getElementById('{{ $__tid }}_entry');
        var chips = document.getElementById('{{ $__tid }}_chips');
        if (!hid || !entry || !chips) {
            return;
        }
        var tags = @json($initialTags).map(function (t) {
            return String(t);
        });

        function syncHidden() {
            hid.value = tags.join(',');
        }

        function addTagFromInput() {
            var v = entry.value.trim();
            if (!v || tags.indexOf(v) !== -1) {
                return;
            }
            tags.push(v);
            entry.value = '';
            syncHidden();
            render();
        }

        function render() {
            chips.innerHTML = '';
            tags.forEach(function (tag, index) {
                var span = document.createElement('span');
                span.className =
                    'inline-flex items-center gap-1 rounded-div bg-primary/10 px-3 py-1 text-sm text-primary';
                span.appendChild(document.createTextNode(tag));
                var rm = document.createElement('button');
                rm.type = 'button';
                rm.className = 'rounded-full hover:bg-primary/20';
                rm.setAttribute('aria-label', 'Remove');
                rm.innerHTML =
                    '<svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>';
                (function (idx) {
                    rm.addEventListener('click', function () {
                        tags.splice(idx, 1);
                        syncHidden();
                        render();
                    });
                })(index);
                span.appendChild(rm);
                chips.appendChild(span);
            });
        }

        function onEnter(e) {
            if (e.key !== 'Enter') {
                return;
            }
            e.preventDefault();
            e.stopPropagation();
            if (e.stopImmediatePropagation) {
                e.stopImmediatePropagation();
            }
            addTagFromInput();
        }

        entry.addEventListener('keydown', onEnter, true);

        var form = entry.closest('form');
        if (form) {
            form.addEventListener(
                'submit',
                function (e) {
                    if (document.activeElement === entry && entry.value.trim()) {
                        e.preventDefault();
                        addTagFromInput();
                    }
                },
                true
            );
        }

        render();
    })();
</script>
