<?php

it('adds content security policy header in production', function () {
    config(['app.env' => 'production']);

    $response = $this->call('GET', '/contact/email-image?v=plain', [], [], [], [
        'HTTPS' => 'on',
        'SERVER_PORT' => 443,
        'REQUEST_SCHEME' => 'https',
        'HTTP_X_FORWARDED_PROTO' => 'https',
    ]);

    $response->assertSuccessful();
    $response->assertHeader('Content-Security-Policy');
    expect($response->headers->get('Content-Security-Policy'))->toContain("default-src 'self'");
    expect($response->headers->get('Content-Security-Policy'))->toContain('https://fonts.bunny.net');
    expect($response->headers->get('Content-Security-Policy'))->toContain('https://www.googletagmanager.com');
});

it('does not add content security policy header outside production', function () {
    config(['app.env' => 'local']);

    $response = $this->call('GET', '/contact/email-image?v=plain', [], [], [], [
        'HTTPS' => 'on',
        'SERVER_PORT' => 443,
    ]);

    $response->assertSuccessful();
    $response->assertHeaderMissing('Content-Security-Policy');
});
