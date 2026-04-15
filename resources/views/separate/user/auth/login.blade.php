<x-layout.user.guest>

    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Log in - {{ config('app.name') }}</title>
    </x-slot>

    @php
        $inputClass =
            'flex h-9 w-full min-w-0 rounded-input border border-input bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground focus-visible:border-secondary focus-visible:ring-[3px] focus-visible:ring-secondary/50 disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm';
    @endphp

    <x-form.type.login
        title="Log in to your account"
        description="Enter your email and password below to log in"
        :action="$submitUrl ?? route('login')"
        submitName="Sign In"
    >
        @if (! empty($socialData) && count($socialData) > 0)
            @foreach ($socialData as $item)
                @php
                    $providerKey = is_array($item) ? array_key_first($item) : null;
                    $provider = $providerKey ? ($item[$providerKey] ?? null) : null;
                    $href = is_array($provider) ? ($provider['href'] ?? '#') : '#';
                    $label = $providerKey ? ucfirst((string) $providerKey) : 'Social';
                @endphp

                @if ($providerKey)
                    <div class="mb-1">
                        <button
                            type="button"
                            class="inline-flex h-9 w-full cursor-pointer items-center justify-center gap-2 whitespace-nowrap rounded-div border border-input bg-background px-4 py-2 text-sm font-medium shadow-xs outline-none transition-[color,box-shadow] hover:bg-primary hover:text-primary-foreground focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:pointer-events-none disabled:opacity-50"
                            onclick="window.location.href='{{ $href }}'"
                        >
                            @if ($providerKey === 'google')
                                <svg class="mr-2 h-4 w-4" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                    <path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                    <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                    <path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                                </svg>
                                Continue with Google
                            @elseif ($providerKey === 'facebook')
                                <svg class="mr-2 h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                                Continue with Facebook
                            @elseif ($providerKey === 'x')
                                <svg class="mr-2 h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
                                </svg>
                                Continue with X
                            @elseif ($providerKey === 'linkedin')
                                <svg class="mr-2 h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                </svg>
                                Continue with LinkedIn
                            @elseif ($providerKey === 'github')
                                <svg class="mr-2 h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" />
                                </svg>
                                Continue with GitHub
                            @else
                                Continue with {{ $label }}
                            @endif
                        </button>
                    </div>
                @endif
            @endforeach

            <div class="relative my-2">
                <div class="absolute inset-0 flex items-center">
                    <span class="w-full border-t border-border"></span>
                </div>
                <div class="relative flex justify-center text-xs uppercase">
                    <span class="bg-background px-2 text-muted-foreground">Or continue with</span>
                </div>
            </div>
        @endif

        <div class="grid gap-6">
            <div class="grid gap-2">
                <label for="email" class="text-sm leading-none font-medium select-none">Email address</label>
                <input
                    id="email"
                    class="{{ $inputClass }}"
                    type="email"
                    name="email"
                    placeholder="email@example.com"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="email"
                    tabindex="1"
                >
                @error('email')
                    <x-form.validation-error :value="$message" />
                @enderror
            </div>

            <div class="grid gap-2">
                <div class="flex items-center">
                    <label for="password" class="text-sm leading-none font-medium select-none">Password</label>
                    @if (! empty($canResetPassword) && $canResetPassword)
                        <a
                            href="{{ route('password.request') }}"
                            class="ml-auto text-sm decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current dark:decoration-neutral-500"
                            tabindex="5"
                        >Forgot password?</a>
                    @endif
                </div>
                <div class="relative">
                    <input
                        id="password"
                        class="{{ $inputClass }} pr-10"
                        type="password"
                        name="password"
                        placeholder="Password"
                        required
                        autocomplete="current-password"
                        tabindex="2"
                    >
                    <button
                        type="button"
                        class="absolute right-0 top-0 flex h-full cursor-pointer items-center px-3 py-2 text-muted-foreground hover:bg-transparent focus:outline-none"
                        aria-label="Toggle password visibility"
                        tabindex="-1"
                        onclick="(function(){
                            var input = document.getElementById('password');
                            var eye = document.getElementById('pw-eye');
                            var eyeOff = document.getElementById('pw-eye-off');
                            if (!input) return;
                            if (input.type === 'password') {
                                input.type = 'text';
                                if (eye) eye.classList.add('hidden');
                                if (eyeOff) eyeOff.classList.remove('hidden');
                            } else {
                                input.type = 'password';
                                if (eye) eye.classList.remove('hidden');
                                if (eyeOff) eyeOff.classList.add('hidden');
                            }
                        })()"
                    >
                        <svg id="pw-eye" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                        <svg id="pw-eye-off" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden h-4 w-4"><path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"/><path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"/><path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"/><line x1="2" x2="22" y1="2" y2="22"/></svg>
                    </button>
                </div>
                @error('password')
                    <x-form.validation-error :value="$message" />
                @enderror
            </div>

            <div class="flex items-center space-x-3">
                <input
                    id="remember"
                    class="peer size-4 shrink-0 cursor-pointer rounded-[4px] border border-input accent-primary shadow-xs outline-none focus-visible:ring-[3px] focus-visible:ring-ring/50"
                    type="checkbox"
                    name="remember"
                    value="1"
                    {{ old('remember') ? 'checked' : '' }}
                    tabindex="3"
                >
                <label for="remember" class="cursor-pointer text-sm leading-none font-medium select-none">Remember me</label>
            </div>
        </div>

        <div class="text-center text-sm text-muted-foreground">
            Don't have an account?
            <a
                href="{{ route('register') }}"
                class="decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current dark:decoration-neutral-500"
                tabindex="5"
            >Sign up</a>
        </div>

        <script>
            (function () {
                var form = document.getElementById('auth-primary-form');
                if (!form) return;
                form.addEventListener('submit', function () {
                    var btn = form.querySelector('button[type="submit"]');
                    if (!btn) return;
                    btn.disabled = true;
                    btn.dataset.originalHtml = btn.innerHTML;
                    btn.innerHTML = '<svg class="h-4 w-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Sign In';
                });
            })();
        </script>
    </x-form.type.login>

</x-layout.user.guest>
