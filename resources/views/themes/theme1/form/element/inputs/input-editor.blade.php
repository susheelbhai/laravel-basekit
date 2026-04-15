{{-- Matches input-editor.tsx: editorType "tinymce" | "ckeditor". Default tinymce; use editor-type="ckeditor" for CKEditor (admin layout). --}}
@php
    $__edId = 'ed_' . preg_replace('/[^a-zA-Z0-9_-]/', '_', $name);
    $resolved = strtolower(trim((string) ($editorType ?? 'tinymce')));
    if (! in_array($resolved, ['ckeditor', 'tinymce'], true)) {
        $resolved = 'tinymce';
    }
    $editorHeight = (int) ($editorHeight ?? 480);
    $tinymceBase = rtrim(asset('themes/tinymce'), '/');
@endphp
<div class="mb-4 space-y-1">
    <label for="{{ $__edId }}" class="{{ $labelClass }}">
        {{ $label }}{!! $requiredMark !!}
    </label>
    @include($__formTheme . '.form.element.inputs.partials.help-tooltip')
    @if ($resolved === 'ckeditor')
        <style>
            .cke_contents {
                height: 320px !important;
            }
        </style>
        <textarea class="ck_editor" name="{{ $name }}" id="{{ $__edId }}" {{ $attributes }}>{{ old($name, $value) }}</textarea>
        <script>
            $(function () {
                'use strict';
                if (typeof CKEDITOR !== 'undefined') {
                    CKEDITOR.replace('{{ $__edId }}');
                }
            });
        </script>
    @elseif ($resolved === 'tinymce')
        <textarea
            name="{{ $name }}"
            id="{{ $__edId }}"
            rows="12"
            class="{{ $textareaBase }}"
            {{ $attributes }}
        >{{ old($name, $value) }}</textarea>
        <script>
            (function () {
                var edId = @json($__edId);
                var height = {{ $editorHeight }};
                var baseUrl = @json($tinymceBase);

                function loadTinyMce(cb) {
                    if (window.tinymce) {
                        cb();
                        return;
                    }
                    if (!window.__tinymceLoadQueue) {
                        window.__tinymceLoadQueue = [];
                        var s = document.createElement('script');
                        s.src = baseUrl + '/tinymce.min.js';
                        s.onload = function () {
                            var q = window.__tinymceLoadQueue || [];
                            delete window.__tinymceLoadQueue;
                            q.forEach(function (fn) {
                                fn();
                            });
                        };
                        document.body.appendChild(s);
                    }
                    window.__tinymceLoadQueue.push(cb);
                }

                function init() {
                    var el = document.getElementById(edId);
                    if (!el || !window.tinymce) return;
                    window.tinymce.init({
                        target: el,
                        height: height,
                        width: '100%',
                        menubar: true,
                        base_url: baseUrl,
                        suffix: '.min',
                        plugins: [
                            'advlist autolink lists link image charmap print preview anchor',
                            'searchreplace visualblocks code fullscreen',
                            'insertdatetime media table paste code help wordcount',
                        ].join(' '),
                        toolbar:
                            'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
                        setup: function (editor) {
                            editor.on('change keyup', function () {
                                editor.save();
                            });
                        },
                    });
                }

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', function () {
                        loadTinyMce(init);
                    });
                } else {
                    loadTinyMce(init);
                }

                var form = document.getElementById(edId);
                if (form) {
                    form = form.closest('form');
                    if (form) {
                        form.addEventListener('submit', function () {
                            if (window.tinymce) {
                                window.tinymce.triggerSave();
                            }
                        });
                    }
                }
            })();
        </script>
    @else
        <textarea name="{{ $name }}" id="{{ $__edId }}" rows="12" class="{{ $textareaBase }}" {{ $attributes }}>{{ old($name, $value) }}</textarea>
    @endif
    @include($__formTheme . '.form.element.inputs.partials.field-error')
</div>
