<?php

it('adds strict transport security header in production', function () {
    config(['app.env' => 'production']);

    $secureResponse = $this->call('GET', '/contact/email-image?v=plain', [], [], [], [
        'HTTPS' => 'on',
        'SERVER_PORT' => 443,
        'REQUEST_SCHEME' => 'https',
        'HTTP_X_FORWARDED_PROTO' => 'https',
    ]);

    $secureResponse->assertSuccessful();
    $secureResponse->assertHeader(
        'Strict-Transport-Security',
        'max-age=31536000; includeSubDomains; preload'
    );
});

it('does not add strict transport security header outside production', function () {
    config(['app.env' => 'local']);

    $response = $this->call('GET', '/contact/email-image?v=plain', [], [], [], [
        'HTTPS' => 'on',
        'SERVER_PORT' => 443,
    ]);

    $response->assertSuccessful();
    $response->assertHeaderMissing('Strict-Transport-Security');
});
