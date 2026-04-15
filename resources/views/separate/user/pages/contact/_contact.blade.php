@php
    $appPhone = config('app.phone');
    $appEmail = config('app.email');
    $appAddress = config('app.address');
@endphp

<div class="min-h-screen bg-background text-foreground">
    <x-container class="px-4 py-12 lg:py-16">
        <div class="mb-10 text-center">
            <span class="inline-flex items-center rounded-full bg-muted px-3 py-1 text-xs font-medium uppercase tracking-wide text-muted-foreground">
                Get in touch
            </span>
            <h1 class="mt-4 text-3xl font-bold tracking-tight sm:text-4xl lg:text-5xl">
                We'd love to hear from you
            </h1>
            <p class="mx-auto mt-3 max-w-2xl text-sm text-muted-foreground sm:text-base">
                Have a question, suggestion, or need support? Send us a message and we'll get back to you as soon as possible.
            </p>
        </div>

        <div class="grid gap-10 rounded-div bg-card p-6 shadow-[0_24px_60px_rgba(0,0,0,0.08)] ring-1 ring-border md:grid-cols-5 md:p-8 lg:p-10">
            <div class="space-y-6 border-b border-border pb-6 md:col-span-2 md:border-r md:border-b-0 md:pr-8 md:pb-0">
                <h2 class="text-xl font-semibold">Contact Information</h2>
                <p class="text-sm text-muted-foreground">
                    Reach out to us via phone, email, or visit us during working hours.
                </p>

                <div class="space-y-4">
                    <div class="flex gap-3 rounded-div bg-muted/80 p-3.5">
                        <div class="flex h-10 w-10 items-center justify-center rounded-div bg-primary/10 text-primary">📞</div>
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-muted-foreground">Phone</p>
                            <a href="tel:{{ $appPhone }}" class="text-sm font-semibold hover:text-accent">{{ $appPhone }}</a>
                        </div>
                    </div>
                    <div class="flex gap-3 rounded-div bg-muted/80 p-3.5">
                        <div class="flex h-10 w-10 items-center justify-center rounded-div bg-primary/10 text-primary">✉</div>
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-muted-foreground">Email</p>
                            <a href="mailto:{{ $appEmail }}" class="text-sm font-semibold break-all hover:text-accent">{{ $appEmail }}</a>
                        </div>
                    </div>
                    <div class="flex gap-3 rounded-div bg-muted/80 p-3.5">
                        <div class="flex h-10 w-10 items-center justify-center rounded-div bg-primary/10 text-primary">📍</div>
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-muted-foreground">Address</p>
                            <p class="text-sm font-semibold whitespace-pre-line">{{ $appAddress }}</p>
                        </div>
                    </div>
                    <div class="flex gap-3 rounded-div bg-muted/80 p-3.5">
                        <div class="flex h-10 w-10 items-center justify-center rounded-div bg-primary/10 text-primary">🕐</div>
                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-muted-foreground">Working Hours</p>
                            <p class="text-sm font-semibold">{{ $data->working_hour }}</p>
                        </div>
                    </div>
                </div>

                <p class="pt-2 text-xs text-muted-foreground">
                    We usually respond within <span class="font-semibold">24–48 business hours.</span>
                </p>
            </div>

            <div class="md:col-span-3 md:pl-6 lg:pl-10">
                <h2 class="mb-4 text-xl font-semibold">Send us a message</h2>
                <p class="mb-6 text-sm text-muted-foreground">
                    Fill out the form below and we'll get back to you as soon as we can.
                </p>

                @if (session('success'))
                    <p class="mb-4 rounded-div bg-primary/10 px-4 py-2 text-sm text-primary">{{ session('success') }}</p>
                @endif

                <form class="flex flex-col gap-4" action="{{ url('/contact') }}" method="post">
                    @csrf
                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-medium">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="rounded-div border border-border bg-background px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-primary/30" />
                            @error('name')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-medium">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="rounded-div border border-border bg-background px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-primary/30" />
                            @error('email')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-medium">Phone</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" required class="rounded-div border border-border bg-background px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-primary/30" />
                            @error('phone')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-medium">Subject</label>
                            <input type="text" name="subject" value="{{ old('subject') }}" class="rounded-div border border-border bg-background px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-primary/30" />
                            @error('subject')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-sm font-medium">Message</label>
                        <textarea name="message" rows="4" class="rounded-div border border-border bg-background px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-primary/30">{{ old('message') }}</textarea>
                        @error('message')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                    </div>
                    <div class="pt-2">
                        <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-div bg-primary px-6 py-2.5 text-sm font-semibold text-primary-foreground shadow hover:bg-primary/90 md:w-auto">
                            Submit Message
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-10 lg:mt-12">
            <h3 class="mb-3 text-base font-semibold">Find us on the map</h3>
            <div class="overflow-hidden rounded-div border border-border bg-card shadow-[0_20px_45px_rgba(0,0,0,0.08)]">
                <iframe
                    src="{{ $data->map_embad_url }}"
                    width="100%"
                    height="380"
                    style="border:0"
                    loading="lazy"
                    allowfullscreen
                    referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
            </div>
        </div>
    </x-container>
</div>
