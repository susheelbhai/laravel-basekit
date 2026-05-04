<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PageHome;
use App\Models\Portfolio;
use App\Models\Project;
use App\Models\Service;
use App\Models\Team;
use App\Models\Testimonial;

class HomePageController extends Controller
{
    public function dashboard()
    {
        $services = Service::whereIsActive(1)->get();
        $projects = Project::whereIsActive(1)->limit(3)->latest()->get()->map(function ($project) {
            $media = $project->getMedia('images');

            return [
                ...$project->toArray(),
                'thumbnail' => $media->first()?->getUrl('thumb'),
                'image' => $media->first()?->getUrl('medium'),
            ];
        });
        $team = Team::whereIsActive(1)->get();
        $testimonials = Testimonial::whereIsActive(1)->get();
        $clients = Portfolio::whereIsActive(1)->get();
        $data = PageHome::whereId(1)->first();

        $this->seo(
            title: 'Home',
            description: 'Welcome to our website. Explore our services, projects, and team.',
        );

        return $this->render('user/pages/home/index', compact('services', 'projects', 'testimonials', 'team', 'clients', 'data'));
    }

    public function home()
    {
        $services = Service::whereIsActive(1)->get();
        $projects = Project::whereIsActive(1)->limit(3)->latest()->get()->map(function ($project) {
            $media = $project->getMedia('images');

            return [
                ...$project->toArray(),
                'thumbnail' => $media->first()?->getUrl('thumb'),
                'image' => $media->first()?->getUrl('medium'),
            ];
        });
        $team = Team::whereIsActive(1)->get();
        $testimonials = Testimonial::whereIsActive(1)->get();
        $clients = Portfolio::whereIsActive(1)->get();
        $data = PageHome::whereId(1)->first();

        $this->seo(
            title: 'Home Page',
            description: 'Digamite: Shaping your digital outcomes. We provide premium web development and digital marketing services to build modern websites that convert visitors into customers.',
            canonical: route('about'),
        );

        return $this->render('user/pages/home/index', compact('services', 'projects', 'testimonials', 'team', 'clients', 'data'));
    }
}
