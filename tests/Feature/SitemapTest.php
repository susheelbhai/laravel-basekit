<?php

use App\Models\Blog;
use App\Models\PricingCategory;
use App\Models\PricingPackage;
use App\Models\Service;

beforeEach(function () {
    $this->category = PricingCategory::unguarded(function () {
        return PricingCategory::create([
            'title' => 'Web',
            'slug' => 'web',
            'is_active' => true,
        ]);
    });

    $this->package = PricingPackage::unguarded(function () {
        return PricingPackage::create([
            'pricing_category_id' => $this->category->id,
            'title' => 'Basic',
            'price' => 99.00,
            'is_active' => true,
        ]);
    });

    $this->service = Service::unguarded(function () {
        return Service::create([
            'title' => 'Consulting',
            'slug' => 'consulting',
            'is_active' => true,
        ]);
    });

    $this->blog = Blog::unguarded(function () {
        return Blog::create([
            'title' => 'Hello',
            'slug' => 'hello-world',
            'is_active' => true,
        ]);
    });
});

it('serves sitemap xml with public urls', function () {
    $response = $this->get('/sitemap.xml');

    $response->assertSuccessful();
    expect($response->headers->get('Content-Type'))->toContain('xml');

    $body = $response->getContent();
    expect($body)->not->toBeEmpty()
        ->and($body)->toContain(route('home'))
        ->and($body)->toContain(route('blog.show', $this->blog->slug))
        ->and($body)->toContain(route('serviceDetail', $this->service->slug))
        ->and($body)->toContain(route('checkout.show', $this->package->id))
        ->and($body)->toContain(route('pricing'));
});
