<?php

namespace App\Http\Controllers\User;

use App\Events\ContactFormSubmitted;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserQueryRequest;
use App\Models\Faq;
use App\Models\Newsletter;
use App\Models\PageAbout;
use App\Models\PageContact;
use App\Models\PagePrivacy;
use App\Models\PageRefund;
use App\Models\PageTnc;
use App\Models\Service;
use App\Models\UserQuery;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        $data = PageAbout::firstOrFail();

        $this->seo(
            title: 'About Us',
            description: 'Digamite: Shaping your digital outcomes. We provide premium web development and digital marketing services to build modern websites that convert visitors into customers.',
            canonical: route('about'),
        );

        return $this->render('user/pages/about/index', compact('data'));
    }

    public function services()
    {
        $data = Service::whereIsActive(1)->get();

        $this->seo(
            title: 'Services — web, apps, software & marketing',
            description: 'Website development, mobile and web apps, custom software, and digital marketing from Digamite. SEO-ready sites, secure backends and APIs, and growth campaigns with clear reporting—open any service below for scope and deliverables.',
            canonical: route('services'),
        );

        return $this->render('user/pages/service/index', compact('data'));
    }

    public function serviceDetail($slug)
    {
        $data = Service::whereSlug($slug)->whereIsActive(1)->firstOrFail();
        $heroImage = $data->display_img_converted?->large ?? $data->display_img;
        $plainSummary = strip_tags($data->short_description ?? '');
        $description = str($plainSummary ?: "{$data->title} by Digamite — web, mobile, software, and marketing delivery with clear milestones.")
            ->limit(158, '…')
            ->toString();

        $this->seo(
            title: $data->title,
            description: $description,
            canonical: route('serviceDetail', $slug),
            image: $heroImage ?: '',
        );

        return $this->render('user/pages/service/detail', compact('data'));
    }

    public function contact()
    {
        $data = PageContact::firstOrFail();

        $this->seo(
            title: 'Contact Us',
            description: 'Contact Digamite for websites, mobile apps, and digital marketing. Reach our team by phone, email, or message—we typically reply within 24–48 business hours.',
            canonical: route('contact'),
        );

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

        $this->seo(
            title: 'Privacy Policy',
            description: 'Learn how Digamite collects, uses, and protects your personal data. Our privacy policy explains cookies, third parties, and your rights.',
            canonical: route('privacy'),
        );

        return $this->render('user/pages/privacy', compact('data'));
    }

    public function tnc()
    {
        $data = PageTnc::whereId(1)->first();

        $this->seo(
            title: 'Terms and Conditions',
            description: 'Read Digamite’s terms and conditions for using our websites, apps, and digital services—billing, service scope, and your responsibilities in one place.',
            canonical: route('tnc'),
        );

        return $this->render('user/pages/tnc', compact('data'));
    }

    public function refund()
    {
        $data = PageRefund::whereId(1)->first();

        $this->seo(
            title: 'Refund Policy',
            description: 'Understand Digamite’s refund and cancellation policy—eligibility, timelines, and how to request a refund for digital services and packages.',
            canonical: route('refund'),
        );

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

        $this->seo(
            title: 'FAQ',
            description: 'Find answers about Digamite services, pricing, delivery, and support. Browse our help center by category for websites, apps, and digital marketing.',
            canonical: route('faq'),
        );

        return $this->render('user/pages/faq', compact('data'));
    }
}
