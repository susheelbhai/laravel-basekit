<?php

namespace App\Http\Controllers\User;

use App\Events\ContactFormSubmitted;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserQueryRequest;
use App\Models\Faq;
use App\Models\Newsletter;
use App\Models\PageAbout;
use App\Models\PageContact;
use App\Models\PageHome;
use App\Models\PagePrivacy;
use App\Models\PageRefund;
use App\Models\PageTnc;
use App\Models\Portfolio;
use App\Models\Project;
use App\Models\Service;
use App\Models\Team;
use App\Models\Testimonial;
use App\Models\UserQuery;
use Illuminate\Http\Request;

class HomeController extends Controller
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
            title: $data?->banner_heading ?? config('app.name'),
            description: 'Digamite is an IT company building premium websites, mobile apps, custom software, and digital marketing—focused on performance, design, and measurable growth.',
            canonical: route('home'),
            image: 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1200&q=80',
        );

        return $this->render('user/pages/home/index', compact('services', 'projects', 'testimonials', 'team', 'clients', 'data'));
    }

    public function about()
    {
        $data = PageAbout::firstOrFail();

        return $this->render('user/pages/about/index', compact('data'));
    }

    public function services()
    {
        $data = Service::whereIsActive(1)->get();

        return $this->render('user/pages/service/index', compact('data'));
    }

    public function serviceDetail($slug)
    {
        $data = Service::whereSlug($slug)->whereIsActive(1)->firstOrFail();

        return $this->render('user/pages/service/detail', compact('data'));
    }

    public function contact()
    {
        $data = PageContact::firstOrFail();

        return $this->render('user/pages/contact/index', compact('data'));
    }

    public function contactSubmit(UserQueryRequest $request)
    {
        $data = new UserQuery;
        $data->name = $request['name'];
        $data->email = $request['email'];
        $data->phone = $request['phone'];
        $data->subject = $request['subject'];
        $data->message = $request['message'];
        $data->save();
        event(new ContactFormSubmitted($data));

        return back()->with('success', 'You have successfully submitted the form');
    }

    public function newsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);
        Newsletter::updateOrCreate(
            ['email' => $request['email']],
            ['unsubscribed_at' => null]
        );

        return back()->with('success', 'You have successfully subscribed to our newwsletter');
    }

    public function privacy()
    {
        $data = PagePrivacy::whereId(1)->first();

        return $this->render('user/pages/privacy', compact('data'));
    }

    public function tnc()
    {
        $data = PageTnc::whereId(1)->first();

        return $this->render('user/pages/tnc', compact('data'));
    }

    public function refund()
    {
        $data = PageRefund::whereId(1)->first();

        return $this->render('user/pages/refund', compact('data'));
    }

    public function faq()
    {
        $faqs = Faq::where('is_active', 1)
            ->with('category')
            ->orderBy('faq_category_id')
            ->get()
            ->groupBy('faq_category_id')
            ->map(function ($items) {
                return [
                    'category_title' => $items->first()->category->title,
                    'faqs' => $items->map(function ($faq) {
                        return [
                            'id' => $faq->id,
                            'question' => $faq->question,
                            'answer' => $faq->answer,
                        ];
                    })->values(),
                ];
            });

        $data = $faqs->values();

        return $this->render('user/pages/faq', compact('data'));
    }
}
