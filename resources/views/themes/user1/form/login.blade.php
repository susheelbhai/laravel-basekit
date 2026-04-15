<div {{ $attributes }}>
    <div class="flex flex-col gap-2">
        @include('theme1.auth.partials.heading', ['title' => $title, 'description' => $description ?? null])

        <form id="auth-primary-form" action="{{ $action }}" method="post" class="{{ $formClass ?? 'space-y-2' }}">
            @csrf
            {{ $slot }}

            @if ($showSubmit)
                <button
                    type="submit"
                    class="mt-4 inline-flex h-9 w-full items-center justify-center gap-2 rounded-button bg-primary px-4 py-2 text-sm font-medium text-primary-foreground shadow-xs hover:opacity-95 disabled:cursor-not-allowed disabled:opacity-60"
                >
                    {{ $submitName }}
                </button>
            @endif

            @isset($belowSubmit)
                {{ $belowSubmit }}
            @endisset
        </form>
    </div>
</div>
