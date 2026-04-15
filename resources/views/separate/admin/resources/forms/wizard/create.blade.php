<x-layout.admin.app>
    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Wizard | {{ config('app.name') }}</title>
    </x-slot>

    <x-admin.page>
        <div class="mx-auto max-w-5xl px-2 py-4">
            <h1 class="mb-6 text-center text-2xl font-bold text-primary">
                Student Registration Form
            </h1>

            <div class="mb-6 flex overflow-hidden rounded-div bg-[#fdf8f2]" id="wizard-tabs" role="tablist"></div>

            <form
                id="wizard-form"
                method="POST"
                action="{{ route('admin.forms.wizard.submit') }}"
                enctype="multipart/form-data"
                class="rounded-div border border-border bg-card p-6 shadow-sm"
            >
                @csrf
                @method('PATCH')

                <div data-wizard-step="0" class="wizard-panel grid grid-cols-12 gap-4">
                    <div class="col-span-12">
                        <h2 class="mb-1 text-lg font-semibold">Basic Details</h2>
                        <p class="mb-4 text-sm text-muted-foreground">Tell us about you.</p>
                    </div>
                    <x-form.element.input1 name="name" label="Name" type="text" div="1" placeholder="Rohit Sharma" required="required" />
                    <x-form.element.input1 name="email" label="Email" type="email" div="1" placeholder="rohit@example.com" required="required" />
                    <x-form.element.input1 name="phone" label="Phone" type="tel" div="1" placeholder="+1234567890" required="required" />
                    <x-form.element.input1 name="address1" label="Address Line 1" type="text" div="1" placeholder="123 Main St" required="required" />
                    <x-form.element.input1 name="address2" label="Address Line 2" type="text" div="1" placeholder="Apt, Suite, etc. (optional)" />
                    <x-form.element.input1 name="city" label="City" type="text" div="1" placeholder="New York" required="required" />
                    <x-form.element.input1 name="state" label="State" type="text" div="1" placeholder="NY" required="required" />
                    <x-form.element.input1 name="country" label="Country" type="text" div="1" placeholder="USA" required="required" />
                    <x-form.element.input1 name="pin_code" label="Pin Code" type="text" div="1" placeholder="10001" required="required" />
                    <x-form.element.input1 name="profile_pic" label="Photo" type="image" div="1" required="required" />
                </div>

                <div data-wizard-step="1" class="wizard-panel hidden grid grid-cols-12 gap-4">
                    <div class="col-span-12">
                        <h2 class="mb-1 text-lg font-semibold">Bank Details</h2>
                        <p class="mb-4 text-sm text-muted-foreground">Provide your bank details for payout.</p>
                    </div>
                    <x-form.element.input1 name="bank_account_holder_name" label="Account Holder Name" type="text" div="1" />
                    <x-form.element.input1 name="bank_account_number" label="Account Number" type="text" div="1" />
                    <x-form.element.input1 name="bank_ifsc" label="IFSC Code" type="text" div="1" />
                    <x-form.element.input1 name="bank_upi_id" label="UPI ID" type="text" div="1" />
                    <x-form.element.input1 name="proof_of_address" label="Proof of Address / Incorporation (Optional)" type="file" div="1" />
                </div>

                <div data-wizard-step="2" class="wizard-panel hidden grid grid-cols-12 gap-4">
                    <div class="col-span-12">
                        <h2 class="mb-1 text-lg font-semibold">Education</h2>
                        <p class="mb-4 text-sm text-muted-foreground">Provide your educational qualifications.</p>
                    </div>
                    @foreach ([0, 1] as $ci)
                        <div class="col-span-12 rounded-div bg-green-50 p-4 dark:bg-green-950/30">
                            <p class="mb-3 text-sm font-medium text-foreground">Course {{ $ci + 1 }}</p>
                            <div class="grid grid-cols-12 gap-4">
                                <x-form.element.input1
                                    name="courses[{{ $ci }}][name]"
                                    label="Course Title"
                                    type="text"
                                    div="1"
                                    :value="old('courses.' . $ci . '.name', $ci === 0 ? 'Matriculation' : 'Secondary School')"
                                />
                                <x-form.element.input1 name="courses[{{ $ci }}][university]" label="Board/University" type="text" div="1" placeholder="Delhi University" />
                                <x-form.element.input1 name="courses[{{ $ci }}][marks]" label="Marks" type="number" div="1" />
                                <x-form.element.input1 name="courses[{{ $ci }}][passing_year]" label="Passing Year" type="number" div="1" />
                            </div>
                        </div>
                    @endforeach
                </div>

                <div data-wizard-step="3" class="wizard-panel hidden grid grid-cols-12 gap-4">
                    <div class="col-span-12">
                        <h2 class="mb-1 text-lg font-semibold">Other Information</h2>
                        <p class="mb-4 text-sm text-muted-foreground">Additional notes for the team.</p>
                    </div>
                    <x-form.element.input1 name="short_description" label="Short description" type="textarea" div="1" />
                    <x-form.element.input1 name="biodata" label="Biodata" type="editor" div="1" />
                </div>

                <div data-wizard-step="4" class="wizard-panel hidden">
                    <h2 class="mb-1 text-lg font-semibold">Preview</h2>
                    <p class="mb-4 text-sm text-muted-foreground">Review your answers before submitting.</p>
                    <div id="wizard-preview-summary" class="rounded-div border border-input-border bg-input-bg p-4 text-sm"></div>
                </div>

                <div class="mt-6 flex justify-between border-t border-border pt-6">
                    <button
                        type="button"
                        id="wizard-btn-prev"
                        class="inline-flex items-center justify-center rounded-button border border-input-border bg-background px-4 py-2.5 text-sm font-medium hover:bg-input-hover-bg"
                    >
                        Previous
                    </button>
                    <div class="flex gap-2">
                        <button
                            type="button"
                            id="wizard-btn-next"
                            class="inline-flex items-center justify-center rounded-button bg-primary px-4 py-2.5 text-sm font-medium text-primary-foreground hover:opacity-95"
                        >
                            Save &amp; Next
                        </button>
                        <button
                            type="submit"
                            id="wizard-btn-submit"
                            class="hidden inline-flex items-center justify-center rounded-button bg-primary px-4 py-2.5 text-sm font-medium text-primary-foreground hover:opacity-95"
                        >
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <script>
            (function () {
                var stepTitles = ['Basic Details', 'Bank Detail', 'Education', 'Other Info', 'Preview'];
                var stepKeys = ['basic_details', 'bank_detail', 'education', 'other_info'];
                var partialUrl = @json(route('admin.forms.wizard.partial_update'));
                var totalSteps = stepTitles.length;
                var step = 0;
                var completed = {};

                var form = document.getElementById('wizard-form');
                var tabsEl = document.getElementById('wizard-tabs');
                var btnPrev = document.getElementById('wizard-btn-prev');
                var btnNext = document.getElementById('wizard-btn-next');
                var btnSubmit = document.getElementById('wizard-btn-submit');

                function token() {
                    var t = form.querySelector('input[name="_token"]');
                    return t ? t.value : '';
                }

                function renderTabs() {
                    tabsEl.innerHTML = '';
                    for (var i = 0; i < totalSteps; i++) {
                        var b = document.createElement('button');
                        b.type = 'button';
                        b.setAttribute('data-tab-index', String(i));
                        b.textContent = stepTitles[i];
                        var cls =
                            'flex-1 border-r border-white p-3 text-sm font-medium last:border-r-0 transition-colors ';
                        if (i === step) {
                            cls += 'bg-[#E2BE68] text-white';
                        } else if (completed[i]) {
                            cls += 'bg-[#A3D86F] text-white';
                        } else {
                            cls += 'bg-background2 text-gray-700 hover:bg-gray-100';
                        }
                        b.className = cls;
                        b.addEventListener('click', function (idx) {
                            return function () {
                                goToStep(idx);
                            };
                        }(i));
                        tabsEl.appendChild(b);
                    }
                }

                function showPanels() {
                    var panels = document.querySelectorAll('.wizard-panel');
                    for (var i = 0; i < panels.length; i++) {
                        if (i === step) {
                            panels[i].classList.remove('hidden');
                        } else {
                            panels[i].classList.add('hidden');
                        }
                    }
                    btnPrev.style.visibility = step > 0 ? 'visible' : 'hidden';
                    if (step === totalSteps - 1) {
                        btnNext.classList.add('hidden');
                        btnSubmit.classList.remove('hidden');
                        fillPreview();
                    } else {
                        btnNext.classList.remove('hidden');
                        btnSubmit.classList.add('hidden');
                    }
                    renderTabs();
                }

                function fieldVal(name) {
                    var el = form.querySelector('[name="' + name + '"]');
                    if (!el) {
                        return '';
                    }
                    if (el.type === 'file') {
                        return el.files && el.files[0] ? el.files[0].name : '';
                    }
                    return el.value || '';
                }

                function fillPreview() {
                    var rows = [];
                    var labels = [
                        ['Name', 'name'],
                        ['Email', 'email'],
                        ['Phone', 'phone'],
                        ['Address', 'address1'],
                        ['City', 'city'],
                        ['State', 'state'],
                        ['Country', 'country'],
                        ['Pin Code', 'pin_code'],
                        ['Photo', 'profile_pic'],
                        ['Account holder', 'bank_account_holder_name'],
                        ['Account number', 'bank_account_number'],
                        ['IFSC', 'bank_ifsc'],
                        ['UPI', 'bank_upi_id'],
                        ['Proof upload', 'proof_of_address'],
                        ['Short description', 'short_description'],
                    ];
                    for (var i = 0; i < labels.length; i++) {
                        var v = fieldVal(labels[i][1]);
                        rows.push(
                            '<tr><th class="border-b border-input-border py-2 pr-4 text-left font-medium">' +
                                labels[i][0] +
                                '</th><td class="border-b border-input-border py-2">' +
                                (v || '—') +
                                '</td></tr>'
                        );
                    }
                    for (var c = 0; c < 2; c++) {
                        var cn = fieldVal('courses[' + c + '][name]');
                        if (cn || fieldVal('courses[' + c + '][university]')) {
                            rows.push(
                                '<tr><th class="border-b border-input-border py-2 pr-4 text-left font-medium" colspan="2">Course ' +
                                    (c + 1) +
                                    '</th></tr>'
                            );
                            rows.push(
                                '<tr><th class="py-1 pr-4 text-left">Title</th><td>' +
                                    (cn || '—') +
                                    '</td></tr>'
                            );
                            rows.push(
                                '<tr><th class="py-1 pr-4 text-left">University</th><td>' +
                                    (fieldVal('courses[' + c + '][university]') || '—') +
                                    '</td></tr>'
                            );
                            rows.push(
                                '<tr><th class="py-1 pr-4 text-left">Marks / Year</th><td>' +
                                    fieldVal('courses[' + c + '][marks]') +
                                    ' / ' +
                                    fieldVal('courses[' + c + '][passing_year]') +
                                    '</td></tr>'
                            );
                        }
                    }
                    var bio = fieldVal('biodata');
                    if (bio) {
                        rows.push(
                            '<tr><th class="py-2 pr-4 align-top text-left font-medium">Biodata</th><td class="py-2">' +
                                bio.replace(/</g, '&lt;').replace(/>/g, '&gt;') +
                                '</td></tr>'
                        );
                    }
                    document.getElementById('wizard-preview-summary').innerHTML =
                        '<table class="w-full border-collapse">' + rows.join('') + '</table>';
                }

                function goToStep(n) {
                    if (n < 0 || n >= totalSteps) {
                        return;
                    }
                    step = n;
                    showPanels();
                }

                btnPrev.addEventListener('click', function () {
                    goToStep(step - 1);
                });

                btnNext.addEventListener('click', function () {
                    var key = stepKeys[step];
                    if (!key) {
                        goToStep(step + 1);
                        return;
                    }
                    var fd = new FormData(form);
                    fd.set('field', key);
                    fd.set('_method', 'PATCH');
                    btnNext.disabled = true;
                    fetch(partialUrl, {
                        method: 'POST',
                        body: fd,
                        headers: {
                            'X-CSRF-TOKEN': token(),
                            Accept: 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        credentials: 'same-origin',
                    })
                        .then(function (r) {
                            if (r.status === 422) {
                                return r.json().then(function (j) {
                                    var msg = (j && j.message) || 'Validation failed';
                                    if (j && j.errors) {
                                        msg += '\n' + JSON.stringify(j.errors);
                                    }
                                    alert(msg);
                                    throw new Error('validation');
                                });
                            }
                            if (!r.ok) {
                                alert('Could not save step.');
                                throw new Error('http');
                            }
                            completed[step] = true;
                            goToStep(step + 1);
                        })
                        .catch(function () {})
                        .finally(function () {
                            btnNext.disabled = false;
                        });
                });

                showPanels();
            })();
        </script>
    </x-admin.page>
</x-layout.admin.app>
