<footer class="bg-footer text-footer-foreground">
    <div class="h-1 w-full bg-primary"></div>

    <x-container class="mx-auto max-w-[1320px] justify-between px-4 py-10">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-3">
            <div class="space-y-4">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3">
                    @if(config('app.light_logo'))
                        <img src="{{ asset(config('app.light_logo')) }}" alt="{{ config('app.name') }}" class="h-10 w-auto">
                    @endif
                </a>

                <p class="max-w-xs text-sm text-muted-foreground">
                    {{ config('app.tagline', 'Committed to delivering quality services with trust and excellence.') }}
                </p>

                <div class="mt-4 space-y-1.5 text-sm">
                    <p>
                        <span class="mr-1.5 text-primary">📞</span>
                        <a href="tel:{{ config('app.phone') }}" class="transition-colors hover:text-primary">
                            {{ config('app.phone') }}
                        </a>
                    </p>
                    <p>
                        <span class="mr-1.5 text-primary">✉️</span>
                        <a href="mailto:{{ config('app.email') }}" class="break-all transition-colors hover:text-primary">
                            {{ config('app.email') }}
                        </a>
                    </p>
                    <p class="flex items-start text-sm">
                        <span class="mr-1.5 text-primary">🏢</span>
                        <span class="text-muted-foreground">{{ config('app.address') }}</span>
                    </p>
                </div>
            </div>

            <div>
                <h2 class="mb-4 text-base font-semibold tracking-wide text-footer-foreground">
                    Important Links
                </h2>
                <ul class="space-y-2 text-sm">
                    @foreach(config('important_links', []) as $link)
                        <li>
                            <a
                                href="{{ data_get($link, 'href', data_get($link, 'url', '#')) }}"
                                class="inline-flex items-center gap-2 text-muted-foreground transition-colors hover:text-primary"
                            >
                                {{ data_get($link, 'name', 'Link') }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="space-y-4">
                <h2 class="mb-2 text-base font-semibold tracking-wide text-footer-foreground">
                    Connect With Us
                </h2>
                <div class="flex flex-wrap items-center gap-3">
                    @if(config('app.facebook'))
                        <a href="{{ config('app.facebook') }}" target="_blank" rel="noreferrer"
                           aria-label="Facebook"
                           class="flex h-9 w-9 items-center justify-center rounded-full bg-muted text-muted-foreground transition-all hover:-translate-y-0.5 hover:bg-primary hover:text-primary-foreground">
                            <span class="sr-only">Facebook</span>
                            <i class="fa-brands fa-facebook-f text-[16px] leading-none" aria-hidden="true"></i>
                        </a>
                    @endif
                    @if(config('app.twitter'))
                        <a href="{{ config('app.twitter') }}" target="_blank" rel="noreferrer"
                           aria-label="X (Twitter)"
                           class="flex h-9 w-9 items-center justify-center rounded-full bg-muted text-muted-foreground transition-all hover:-translate-y-0.5 hover:bg-primary hover:text-primary-foreground">
                            <span class="sr-only">X (Twitter)</span>
                            <i class="fa-brands fa-x-twitter text-[16px] leading-none" aria-hidden="true"></i>
                        </a>
                    @endif
                    @if(config('app.instagram'))
                        <a href="{{ config('app.instagram') }}" target="_blank" rel="noreferrer"
                           aria-label="Instagram"
                           class="flex h-9 w-9 items-center justify-center rounded-full bg-muted text-muted-foreground transition-all hover:-translate-y-0.5 hover:bg-primary hover:text-primary-foreground">
                            <span class="sr-only">Instagram</span>
                            <i class="fa-brands fa-instagram text-[16px] leading-none" aria-hidden="true"></i>
                        </a>
                    @endif
                    @if(config('app.linkedin'))
                        <a href="{{ config('app.linkedin') }}" target="_blank" rel="noreferrer"
                           aria-label="LinkedIn"
                           class="flex h-9 w-9 items-center justify-center rounded-full bg-muted text-muted-foreground transition-all hover:-translate-y-0.5 hover:bg-primary hover:text-primary-foreground">
                            <span class="sr-only">LinkedIn</span>
                            <i class="fa-brands fa-linkedin-in text-[16px] leading-none" aria-hidden="true"></i>
                        </a>
                    @endif
                    @if(config('app.youtube'))
                        <a href="{{ config('app.youtube') }}" target="_blank" rel="noreferrer"
                           aria-label="YouTube"
                           class="flex h-9 w-9 items-center justify-center rounded-full bg-muted text-muted-foreground transition-all hover:-translate-y-0.5 hover:bg-primary hover:text-primary-foreground">
                            <span class="sr-only">YouTube</span>
                            <i class="fa-brands fa-youtube text-[16px] leading-none" aria-hidden="true"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="border-t border-border py-4 text-center text-xs text-muted-foreground">
            <div class="flex flex-col justify-between md:flex-row md:gap-4">
                <div class="copy">
                    © {{ date('Y') }} <span class="font-medium">{{ config('app.name') }}</span>. All rights reserved.
                </div>
                <div class="credit">
                    Developed by
                    <a href="https://digamite.com" target="_blank" rel="noreferrer" class="hover:underline">
                        Digamite Private Limited
                    </a>
                </div>
            </div>
        </div>
    </x-container>
</footer>