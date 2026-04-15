@props([
    'productId',
    'productTitle' => '',
    'buttonText' => 'Send Enquiry',
])

@php
    $openFromValidationErrors = $errors->any() && (string) old('product_id') === (string) $productId;
@endphp

<div x-data="{ isEnquiryOpen: {{ $openFromValidationErrors ? 'true' : 'false' }} }">
    <button
        type="button"
        {{ $attributes->merge(['class' => 'flex w-full cursor-pointer items-center justify-center gap-2 rounded-div bg-primary px-6 py-3 font-semibold text-white transition-all hover:bg-primary/90 hover:shadow-lg']) }}
        @click="isEnquiryOpen = true"
    >
        <span class="sr-only">Send enquiry</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14.536 21.686a.5.5 0 0 0 .744-.275l2.006-7.125a.5.5 0 0 1 .084-.155l4.435-5.83a.5.5 0 0 0-.348-.8l-7.123-1.071a.5.5 0 0 1-.164-.06L6.14 2.15a.5.5 0 0 0-.8.348l-1.07 7.123a.5.5 0 0 1-.06.164L2.15 17.86a.5.5 0 0 0 .349.8l7.123 1.07a.5.5 0 0 1 .164.06l4.75 2.897Z"/><path d="m10 14 2 2 4-4"/></svg>
        {{ $buttonText }}
    </button>

    <div
        x-show="isEnquiryOpen"
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4"
        @keydown.escape.window="isEnquiryOpen = false"
    >
        <div class="relative w-full max-w-md rounded-div bg-background p-6 shadow-xl">
            <button
                type="button"
                class="absolute right-4 top-4 text-muted-foreground hover:text-foreground"
                @click="isEnquiryOpen = false"
                aria-label="Close"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
            </button>

            <h2 class="mb-2 text-2xl font-bold text-foreground">Product Enquiry</h2>
            <p class="mb-6 text-sm text-muted-foreground">
                Interested in {{ $productTitle }}? Fill out the form below and we'll get back to you soon.
            </p>

            <form action="{{ route('product.enquiry') }}" method="post" class="space-y-4">
                @csrf
                <input type="hidden" name="product_id" value="{{ $productId }}" />

                <div>
                    <label class="text-sm font-medium">Name</label>
                    <input type="text" name="name" required value="{{ old('name') }}" class="mt-1 w-full rounded-div border border-border bg-background px-3 py-2 text-sm" />
                    @error('name')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="text-sm font-medium">Email</label>
                    <input type="email" name="email" required value="{{ old('email') }}" class="mt-1 w-full rounded-div border border-border bg-background px-3 py-2 text-sm" />
                    @error('email')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="text-sm font-medium">Phone</label>
                    <input type="tel" name="phone" required value="{{ old('phone') }}" class="mt-1 w-full rounded-div border border-border bg-background px-3 py-2 text-sm" />
                    @error('phone')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="text-sm font-medium">Message</label>
                    <textarea name="message" rows="3" required class="mt-1 w-full rounded-div border border-border bg-background px-3 py-2 text-sm">{{ old('message') }}</textarea>
                    @error('message')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
                </div>

                <button type="submit" class="w-full rounded-div bg-primary px-6 py-2.5 text-sm font-semibold text-primary-foreground hover:bg-primary/90">
                    Submit Enquiry
                </button>
            </form>
        </div>
    </div>
</div>

