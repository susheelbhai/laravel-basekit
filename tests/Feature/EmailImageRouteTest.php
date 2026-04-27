<?php

it('returns svg from the production-safe email image route', function () {
    $response = $this->get(route('public.email.svg').'?v=plain');

    $response->assertSuccessful();
    $response->assertHeader('Content-Type', 'image/svg+xml; charset=UTF-8');
    expect($response->getContent())->toContain('<svg');
});

it('returns svg from the legacy path ending in .svg', function () {
    $response = $this->get('/contact/email.svg?v=plain');

    $response->assertSuccessful();
    $response->assertHeader('Content-Type', 'image/svg+xml; charset=UTF-8');
});
