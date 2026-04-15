<x-layout.user.guest>

    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Forgot password - {{ config('app.name') }}</title>
    </x-slot>

    @php
        $inputClass =
            'flex h-9 w-full min-w-0 rounded-input border border-input bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground focus-visible:border-secondary focus-visible:ring-[3px] focus-visible:ring-secondary/50 disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm';
    @endphp

    @if (filled($status ?? null))
        <div class="mb-4 text-center text-sm font-medium text-green-600">{{ $status }}</div>
    @endif

    <x-form.type.login
        title="Forgot password"
        description="Enter your email to receive a password reset link"
        action="{{ route('password.email') }}"
        submitName="Email Password Reset Link"
        form-class="space-y-6"
    >
        <div class="grid gap-2">
            <label for="email" class="text-sm leading-none font-medium select-none">Email address</label>
            <input
                id="email"
                class="{{ $inputClass }}"
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="email@example.com"
                required
                autofocus
                autocomplete="off"
            >
            @error('email')
                <x-form.validation-error :value="$message" />
            @enderror
        </div>

        <x-slot name="belowSubmit">
            <div class="text-muted-foreground space-x-1 text-center text-sm">
                <span>Or, return to</span>
                <a
                    href="{{ route('login') }}"
                    class="decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current dark:decoration-neutral-500"
                >log in</a>
            </div>
            <script>
                (function () {
                    var form = document.getElementById('auth-primary-form');
                    if (!form) return;
                    form.addEventListener('submit', function () {
                        var btn = form.querySelector('button[type="submit"]');
                        if (!btn) return;
                        btn.disabled = true;
                        btn.innerHTML = '<svg class="h-4 w-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Email Password Reset Link';
                    });
                })();
            </script>
        </x-slot>
    </x-form.type.login>

</x-layout.user.guest>
