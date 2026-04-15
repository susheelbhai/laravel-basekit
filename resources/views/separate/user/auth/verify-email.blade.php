<x-layout.user.guest>

    <x-slot name="head">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Email verification - {{ config('app.name') }}</title>
    </x-slot>

    <div class="flex flex-col gap-2">
        @include('theme1.auth.partials.heading', [
            'title' => 'Verify email',
            'description' => 'Please verify your email address by clicking on the link we just emailed to you.',
        ])

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-center text-sm font-medium text-green-600">
                A new verification link has been sent to the email address you provided during registration.
            </div>
        @endif

        <div class="space-y-6 text-center">
            <form method="POST" action="{{ route('verification.send') }}" id="auth-verify-resend-form">
                @csrf
                <button
                    type="submit"
                    class="inline-flex h-9 w-full cursor-pointer items-center justify-center gap-2 whitespace-nowrap rounded-button border border-input bg-secondary px-4 py-2 text-sm font-medium text-secondary-foreground shadow-xs outline-none transition-[color,box-shadow] hover:bg-secondary/80 focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50 disabled:pointer-events-none disabled:opacity-50"
                >
                    Resend verification email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    type="submit"
                    class="mx-auto block text-sm decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current dark:decoration-neutral-500"
                >
                    Log out
                </button>
            </form>
        </div>

        <script>
            (function () {
                var form = document.getElementById('auth-verify-resend-form');
                if (!form) return;
                form.addEventListener('submit', function () {
                    var btn = form.querySelector('button[type="submit"]');
                    if (!btn) return;
                    btn.disabled = true;
                    btn.innerHTML = '<svg class="h-4 w-4 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" aria-hidden="true"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Resend verification email';
                });
            })();
        </script>
    </div>

</x-layout.user.guest>
