<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Inertia\Inertia;

abstract class Controller
{
    private array $seoData = [];

    protected function seo(string $title, string $description = '', string $canonical = '', string $image = ''): static
    {
        $this->seoData = array_filter([
            'title' => $title,
            'description' => $description,
            'canonical' => $canonical,
            'image' => $image,
        ]);

        return $this;
    }

    protected function render(string $path, array $data = [], $render_type = null)
    {
        if ($render_type == null) {
            $render_type = config('app.render_type', 'blade');
        }
        $render_type = Str::lower($render_type);

        if ($render_type === 'inertia') {
            $component = str_replace('.', '/', $path);

            if (! empty($this->seoData)) {
                Inertia::share('seo', $this->seoData);
            }

            return Inertia::render($component, $data);
        }

        return view($path, $data);
    }
}
