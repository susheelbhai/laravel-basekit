<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Service;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function __invoke(): Sitemap
    {
        $sitemap = Sitemap::create();

        $namedRoutes = [
            'home',
            'about',
            'blog.index',
            'services',
            'contact',
            'privacy',
            'tnc',
            'refund',
            'faq',
        ];

        foreach ($namedRoutes as $routeName) {
            $sitemap->add(Url::create(route($routeName)));
        }

        foreach (
            Blog::query()
                ->whereIsActive(1)
                ->select(['id', 'slug', 'updated_at'])
                ->cursor() as $blog
        ) {
            $sitemap->add(
                Url::create(route('blog.show', $blog->slug))
                    ->setLastModificationDate($blog->updated_at)
            );
        }

        foreach (
            Service::query()
                ->whereIsActive(1)
                ->select(['id', 'slug', 'updated_at'])
                ->cursor() as $service
        ) {
            $sitemap->add(
                Url::create(route('serviceDetail', $service->slug))
                    ->setLastModificationDate($service->updated_at)
            );
        }

        return $sitemap;
    }
}
