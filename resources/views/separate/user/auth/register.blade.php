<x-layout.user.guest>

    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Register - {{ config('app.name') }}</title>
    </x-slot>

    @php
        $inputClass =
            'flex h-9 w-full min-w-0 rounded-input border border-input bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground focus-visible:border-secondary focus-visible:ring-[3px] focus-visible:ring-secondary/50 disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm';
    @endphp

    <x-form.type.login
        title="Create an account"
        description="Enter your details below to create your account"
        action="{{ route('register') }}"
        submitName="Register"
        form-class="space-y-6"
    >
        <div class="grid gap-6">
            <div class="grid gap-2">
                <label for="name" class="text-sm leading-none font-medium select-none">Name</label>
                <input
                    id="name"
                    class="{{ $inputClass }}"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Full name"
                    required
                    autofocus
                    autocomplete="name"
                    tabindex="1"
                >
                @error('name')
                    <x-form.validation-error :value="$message" class="mt-2" />
                @enderror
            </div>

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
                    autocomplete="email"
                    tabindex="2"
                >
                @error('email')
                    <x-form.validation-error :value="$message" />
                @enderror
            </div>

            <div class="grid gap-2">
                <label for="password" class="text-sm leading-none font-medium select-none">Password</label>
                <input
                    id="password"
                    class="{{ $inputClass }}"
                    type="password"
                    name="password"
                    placeholder="Password"
                    required
                    autocomplete="new-password"
                    tabindex="3"
                >
                @error('password')
                    <x-form.validation-error :value="$message" />
                @enderror
            </div>

            <div class="grid gap-2">
                <label for="password_confirmation" class="text-sm leading-none font-medium select-none">Confirm password</label>
                <input
                    id="password_confirmation"
                    class="{{ $inputClass }}"
                    type="password"
                    name="password_confirmation"
                    placeholder="Confirm password"
                    required
                    autocomplete="new-password"
                    tabindex="4"
                >
                @error('password_confirmation')
                    <x-form.validation-error :value="$message" />
                @enderror
            </div>
        </div>

        <div class="text-center text-sm text-muted-foreground">
            Already have an account?
            <a
                href="{{ route('login') }}"
                class="decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current dark:decoration-neutral-500"
                tabindex="6"
            >Log in</a>
        </div>

        <script>
            (function () {
                var form = document.getElementById('auth-primary-form');
                if (!form) return;
                form.addEventListener('submit', function () {
                    var btn = form.querySelector('button[type="submit"]');
                    if (!btn) return;
                    btn.disabled = true;
                    btn.innerHTML = '<svg class="h-4 w-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Register';
                });
            })();
        </script>
    </x-form.type.login>

</x-layout.user.guest>
