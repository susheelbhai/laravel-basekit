<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestimonialRequest;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $data = Testimonial::latest()->paginate(15)->through(function ($testimonial) {
            return [
                'id' => $testimonial->id,
                'name' => $testimonial->name,
                'designation' => $testimonial->designation,
                'organisation' => $testimonial->organisation,
                'message' => $testimonial->message,
                'is_active' => $testimonial->is_active,
                'image' => $testimonial->image,
                'image_thumb' => $testimonial->getFirstMediaUrl('image', 'thumb'),
            ];
        });

        $this->seo(title: 'Testimonials — Admin');

        return $this->render('admin/resources/testimonial/index', compact('data'));
    }

    public function create()
    {
        $this->seo(title: 'Create Testimonial — Admin');

        return $this->render('admin/resources/testimonial/create');
    }

    public function store(TestimonialRequest $request)
    {
        $testimonial = new Testimonial;

        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->organisation = $request->organisation;
        $testimonial->message = $request->message;
        $testimonial->is_active = $request->is_active;
        $testimonial->save();

        if ($request->hasFile('image')) {
            $testimonial->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        return redirect()->route('admin.testimonial.index')->with('success', 'New testimonial created successfully');
    }

    public function show($id)
    {
        $data = Testimonial::findOrFail($id);

        $this->seo(title: "{$data->name} — Admin");

        return $this->render('admin/resources/testimonial/show', compact('data'));
    }

    public function edit($id)
    {
        $data = Testimonial::find($id);

        $this->seo(title: 'Edit Testimonial — Admin');

        return $this->render('admin/resources/testimonial/edit', compact('data'));
    }

    public function update(TestimonialRequest $request, $id)
    {
        // Validation handled by TestimonialRequest
        $testimonial = Testimonial::find($id);

        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->organisation = $request->organisation;
        $testimonial->message = $request->message;
        $testimonial->is_active = $request->is_active;
        $testimonial->update();

        if ($request->hasFile('image')) {
            $testimonial->clearMediaCollection('image');
            $testimonial->addMediaFromRequest('image')
                ->toMediaCollection('image');
        }

        return redirect()->route('admin.testimonial.index')->with('success', 'Testimonial updated successfully');
    }

    public function destroy($id)
    {
        //
    }
}
