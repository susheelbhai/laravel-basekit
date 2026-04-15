<div class="relative border-b border-gray-200 bg-primary/5 backdrop-blur dark:border-slate-800 dark:bg-slate-900/80">
    <x-container class="flex items-center justify-between px-4 py-2 text-xs text-gray-600 sm:text-sm dark:text-slate-200">
        <div class="flex items-center gap-3 sm:gap-4">
            <a
                href="mailto:{{ config('app.email') }}"
                class="inline-flex cursor-pointer items-center gap-2 font-medium text-gray-700 transition-colors hover:text-primary dark:text-slate-100"
            >
                <span class="select-none">✉️</span>
                <span class="truncate">{{ config('app.email') }}</span>
            </a>

            <span class="hidden h-4 w-px bg-gray-300 md:inline-block dark:bg-slate-600"></span>

            <span class="hidden text-xs text-gray-500 md:inline-block dark:text-slate-300">
                <span class="font-medium text-gray-700 dark:text-slate-100">
                    {{ config('app.working_hour') ?: '8:00am – 5:00pm' }}
                </span>
            </span>
        </div>

        <div class="flex items-center gap-3 sm:gap-4">
            <div class="hidden items-center gap-2 md:flex">
                @if(config('app.facebook'))
                    <a href="{{ config('app.facebook') }}" target="_blank" rel="noopener noreferrer" aria-label="Facebook"
                       class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full border border-gray-200 text-gray-500 transition-all hover:-translate-y-0.5 hover:border-primary/40 hover:bg-primary/5 hover:text-primary dark:border-slate-700 dark:text-slate-200 dark:hover:border-primary/60">
                        <span class="sr-only">Facebook</span>
                        <i class="fa-brands fa-facebook-f text-[14px] leading-none" aria-hidden="true"></i>
                    </a>
                @endif
                @if(config('app.twitter'))
                    <a href="{{ config('app.twitter') }}" target="_blank" rel="noopener noreferrer" aria-label="X (Twitter)"
                       class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full border border-gray-200 text-gray-500 transition-all hover:-translate-y-0.5 hover:border-primary/40 hover:bg-primary/5 hover:text-primary dark:border-slate-700 dark:text-slate-200 dark:hover:border-primary/60">
                        <span class="sr-only">X (Twitter)</span>
                        <i class="fa-brands fa-x-twitter text-[14px] leading-none" aria-hidden="true"></i>
                    </a>
                @endif
                @if(config('app.linkedin'))
                    <a href="{{ config('app.linkedin') }}" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn"
                       class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full border border-gray-200 text-gray-500 transition-all hover:-translate-y-0.5 hover:border-primary/40 hover:bg-primary/5 hover:text-primary dark:border-slate-700 dark:text-slate-200 dark:hover:border-primary/60">
                        <span class="sr-only">LinkedIn</span>
                        <i class="fa-brands fa-linkedin-in text-[14px] leading-none" aria-hidden="true"></i>
                    </a>
                @endif
                @if(config('app.instagram'))
                    <a href="{{ config('app.instagram') }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram"
                       class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full border border-gray-200 text-gray-500 transition-all hover:-translate-y-0.5 hover:border-primary/40 hover:bg-primary/5 hover:text-primary dark:border-slate-700 dark:text-slate-200 dark:hover:border-primary/60">
                        <span class="sr-only">Instagram</span>
                        <i class="fa-brands fa-instagram text-[14px] leading-none" aria-hidden="true"></i>
                    </a>
                @endif
                @if(config('app.youtube'))
                    <a href="{{ config('app.youtube') }}" target="_blank" rel="noopener noreferrer" aria-label="YouTube"
                       class="flex h-8 w-8 cursor-pointer items-center justify-center rounded-full border border-gray-200 text-gray-500 transition-all hover:-translate-y-0.5 hover:border-primary/40 hover:bg-primary/5 hover:text-primary dark:border-slate-700 dark:text-slate-200 dark:hover:border-primary/60">
                        <span class="sr-only">YouTube</span>
                        <i class="fa-brands fa-youtube text-[14px] leading-none" aria-hidden="true"></i>
                    </a>
                @endif
            </div>

            <span class="hidden h-4 w-px bg-border md:inline-block"></span>

            @include('components.starter-kit-appearance-toggle')
        </div>
    </x-container>
</div>