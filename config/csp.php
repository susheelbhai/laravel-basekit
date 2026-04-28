<?php

return [
    'policy' => implode('; ', [
        "default-src 'self'",
        "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://www.googletagmanager.com https://www.google-analytics.com https://cdn.jsdelivr.net https://connect.facebook.net",
        "style-src 'self' 'unsafe-inline' https://fonts.bunny.net https://fonts.googleapis.com",
        "font-src 'self' data: https://fonts.bunny.net https://fonts.gstatic.com",
        "img-src 'self' data: https: blob:",
        "connect-src 'self' https://www.google-analytics.com https://www.googletagmanager.com",
        "frame-src 'self' https://www.google.com",
        "object-src 'none'",
        "base-uri 'self'",
        "form-action 'self'",
        "frame-ancestors 'self'",
        "upgrade-insecure-requests",
    ]),
];
