<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    data-appearance="{{ $appearance ?? config('app.appearance_default', 'light') }}"
    data-ga-id="{{ config('app.google_analytics_id') }}"
    @class(['dark' => ($appearance ?? config('app.appearance_default', 'light')) == 'dark'])
>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Inline script to detect system dark mode preference and apply it immediately --}}
        <script>
            (function() {
                const appearance = document.documentElement.dataset.appearance || 'light';

                if (appearance === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                    if (prefersDark) {
                        document.documentElement.classList.add('dark');
                    }
                }
            })();
        </script>

        <link rel="icon" href="{{ config('app.favicon', 'Favicon') }}" sizes="any">
        <link rel="icon" href="{{ config('app.favicon', 'Favicon') }}" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600|plus-jakarta-sans:400,500,600,700" rel="stylesheet" />

        @if (is_string(config('app.google_analytics_id')) && trim((string) config('app.google_analytics_id')) !== '')
            @php
                $googleAnalyticsId = trim((string) config('app.google_analytics_id'));
            @endphp
            <!-- Google tag (gtag.js) -->
            <script async src="https://www.googletagmanager.com/gtag/js?id={{ $googleAnalyticsId }}"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', document.documentElement.dataset.gaId);
            </script>
        @endif

        @php
            $canonicalUrl = url()->current();
            $appName = (string) config('app.name');
            $sameAs = array_values(array_filter(array_map(static fn ($v) => is_string($v) ? trim($v) : '', [
                config('app.facebook'),
                config('app.instagram'),
                config('app.linkedin'),
                config('app.youtube'),
                config('app.twitter'),
            ])));

            $organizationJsonLd = [
                '@context' => 'https://schema.org',
                '@type' => 'Organization',
                'name' => $appName,
                'url' => $canonicalUrl,
            ];

            if (! empty($sameAs)) {
                $organizationJsonLd['sameAs'] = $sameAs;
            }

            $websiteJsonLd = [
                '@context' => 'https://schema.org',
                '@type' => 'WebSite',
                'name' => $appName,
                'url' => $canonicalUrl,
            ];

            $address = is_string(config('app.address')) ? trim((string) config('app.address')) : '';
            $phone = is_string(config('app.phone')) ? trim((string) config('app.phone')) : '';
            $email = is_string(config('app.email')) ? trim((string) config('app.email')) : '';

            $localBusinessJsonLd = null;
            if ($address !== '' || $phone !== '' || $email !== '') {
                $localBusinessJsonLd = array_filter([
                    '@context' => 'https://schema.org',
                    '@type' => 'LocalBusiness',
                    'name' => $appName,
                    'url' => $canonicalUrl,
                    'telephone' => $phone !== '' ? $phone : null,
                    'email' => $email !== '' ? $email : null,
                    'address' => $address !== '' ? [
                        '@type' => 'PostalAddress',
                        'streetAddress' => $address,
                    ] : null,
                    'sameAs' => ! empty($sameAs) ? $sameAs : null,
                ], static fn ($v) => $v !== null);
            }
        @endphp

        <script type="application/ld+json">{!! json_encode($organizationJsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
        <script type="application/ld+json">{!! json_encode($websiteJsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
        @if ($localBusinessJsonLd)
            <script type="application/ld+json">{!! json_encode($localBusinessJsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
        @endif

        @if (is_string(config('app.facebook_pixel_id')) && trim((string) config('app.facebook_pixel_id')) !== '')
            @php
                $facebookPixelId = trim((string) config('app.facebook_pixel_id'));
            @endphp
            <script>
                !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window, document,'script','https://connect.facebook.net/en_US/fbevents.js');
                fbq('init','{{ $facebookPixelId }}');
                fbq('track','PageView');
            </script>
        @endif

        @php
            $seo = $page['props']['seo'] ?? [];
            // Fall back to reading from the 'data' prop that controllers already pass
            $pageData = $page['props']['data'] ?? [];
            $seoTitle = is_string($seo['title'] ?? null) ? trim($seo['title']) : '';
            if ($seoTitle === '' && is_array($pageData)) {
                $seoTitle = is_string($pageData['meta_title'] ?? null) ? trim($pageData['meta_title']) : '';
                if ($seoTitle === '') {
                    $seoTitle = is_string($pageData['title'] ?? null) ? trim($pageData['title']) : '';
                }
            }
            $seoDescription = is_string($seo['description'] ?? null) ? trim($seo['description']) : '';
            if ($seoDescription === '' && is_array($pageData)) {
                $seoDescription = is_string($pageData['meta_description'] ?? null) ? trim($pageData['meta_description']) : '';
                if ($seoDescription === '') {
                    $seoDescription = is_string($pageData['short_description'] ?? null) ? trim($pageData['short_description']) : '';
                }
            }
            $seoCanonical = is_string($seo['canonical'] ?? null) ? trim($seo['canonical']) : '';
            $seoImage = is_string($seo['image'] ?? null) ? trim($seo['image']) : '';
            $appName = (string) config('app.name');
            $resolvedTitle = $seoTitle !== '' ? "{$seoTitle} - {$appName}" : $appName;
        @endphp

        <title>{{ $resolvedTitle }}</title>
        <meta property="og:title" content="{{ $resolvedTitle }}">
        <meta name="twitter:title" content="{{ $resolvedTitle }}">
        @if ($seoCanonical !== '')
            <link rel="canonical" href="{{ $seoCanonical }}">
            <meta property="og:url" content="{{ $seoCanonical }}">
        @endif
        @if ($seoDescription !== '')
            <meta name="description" content="{{ $seoDescription }}">
            <meta property="og:description" content="{{ $seoDescription }}">
            <meta name="twitter:description" content="{{ $seoDescription }}">
        @endif
        @if ($seoImage !== '')
            <meta property="og:image" content="{{ $seoImage }}">
            <meta name="twitter:image" content="{{ $seoImage }}">
            <meta name="twitter:card" content="summary_large_image">
        @endif

        @routes
        @viteReactRefresh
        @php $pageComponent = "resources/js/pages/{$page['component']}.tsx"; @endphp
        @vite(['resources/js/app.tsx', $pageComponent])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @if (is_string(config('app.facebook_pixel_id')) && trim((string) config('app.facebook_pixel_id')) !== '')
            <noscript>
                <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{ trim((string) config('app.facebook_pixel_id')) }}&ev=PageView&noscript=1" alt="" />
            </noscript>
        @endif
        @inertia
    </body>
</html>
