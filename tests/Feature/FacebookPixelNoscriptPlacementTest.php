<?php

it('keeps facebook pixel noscript out of head for valid html', function () {
    config(['app.facebook_pixel_id' => '123456789012345']);

    $html = $this->get(route('home'))->assertSuccessful()->getContent();

    preg_match('#<head\b[^>]*>(.*?)</head>#is', $html, $matches);
    $headInner = $matches[1] ?? '';

    expect($headInner)->not->toContain('<noscript>')
        ->and($html)->toContain('https://www.facebook.com/tr?id=123456789012345&ev=PageView&noscript=1');
});
