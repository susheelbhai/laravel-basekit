<?php

use App\Models\Blog;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\PageContact;
use App\Models\PagePrivacy;
use App\Models\PageRefund;
use App\Models\PageTnc;
use App\Models\PricingCategory;
use App\Models\PricingPackage;
use Illuminate\Database\Eloquent\Model;

/**
 * Meta descriptions are emitted via Inertia <Head> and require SSR to appear in raw HTML.
 * This test still proves each route resolves and renders the expected page component after CMS setup.
 */
it('resolves key public pages with the expected Inertia components', function () {
    PageContact::unguarded(fn () => PageContact::query()->create([
        'form_heading1' => 'Contact',
        'form_paragraph1' => 'Hello',
        'map_embad_url' => 'https://example.com/map',
        'working_hour' => '9–5',
    ]));

    foreach ([PagePrivacy::class, PageTnc::class, PageRefund::class] as $modelClass) {
        /** @var Model $page */
        $page = new $modelClass;
        $page->id = 1;
        $page->title = 'Legal page';
        $page->content = '<p>Content</p>';
        $page->save();
    }

    FaqCategory::query()->insert([
        'title' => 'General',
        'is_active' => true,
    ]);
    $faqCategory = FaqCategory::query()->firstOrFail();

    $faq = new Faq;
    $faq->faq_category_id = (int) $faqCategory->id;
    $faq->question = 'Example?';
    $faq->answer = 'Example answer.';
    $faq->is_active = true;
    $faq->save();

    $pricingCategory = PricingCategory::query()->create([
        'title' => 'Web',
        'slug' => 'web-meta-'.uniqid(),
        'description' => null,
        'sort_order' => 0,
        'is_active' => true,
    ]);

    $package = PricingPackage::query()->create([
        'pricing_category_id' => $pricingCategory->id,
        'title' => 'Starter',
        'short_description' => null,
        'price' => 999,
        'original_price' => null,
        'price_label' => null,
        'features' => null,
        'is_featured' => false,
        'is_active' => true,
        'sort_order' => 0,
        'cta_text' => 'Buy',
        'cta_url' => null,
    ]);

    Blog::unguarded(fn () => Blog::query()->create([
        'title' => 'Domain guide',
        'slug' => 'domain-guide-meta-test',
        'short_description' => 'Short intro for the post.',
        'long_description1' => '<p>One</p>',
        'long_description2' => '<p>Two</p>',
        'long_description3' => '<p>Three</p>',
        'is_active' => true,
    ]));

    $pages = [
        [route('contact'), 'user/pages/contact/index'],
        [route('tnc'), 'user/pages/tnc'],
        [route('privacy'), 'user/pages/privacy'],
        [route('faq'), 'user/pages/faq'],
        [route('refund'), 'user/pages/refund'],
        [route('pricing'), 'user/pages/pricing/index'],
        [route('checkout.show', $package->id), 'user/pages/checkout/index'],
        [route('blog.show', 'domain-guide-meta-test'), 'user/pages/blog/detail'],
    ];

    foreach ($pages as [$url, $component]) {
        $this->get($url)
            ->assertSuccessful()
            ->assertInertia(fn ($page) => $page->component($component));
    }
});
