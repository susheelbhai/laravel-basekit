<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FaqRequest;
use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Response;

class FaqController extends Controller
{
    public function index()
    {
        $data = Faq::with('category')->latest()->get();

        $this->seo(title: 'FAQs — Admin');

        return $this->render('admin/resources/faq/index', compact('data'));
    }

    public function create()
    {
        $categories = FaqCategory::get();

        $this->seo(title: 'Create FAQ — Admin');

        return $this->render('admin/resources/faq/create', compact('categories'));
    }

    public function store(FaqRequest $request)
    {
        $image_name = 'images/testimonials/dummy.png';
        $faq = new Faq;

        $faq->faq_category_id = $request->faq_category_id;
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->is_active = $request->is_active;
        $faq->save();

        return redirect()->route('admin.faq.index')->with('success', 'New Faq created successfully');
    }

    public function show($id)
    {
        $data = Faq::findOrFail($id);

        $this->seo(title: 'FAQ Detail — Admin');

        return $this->render('admin/resources/faq/show', compact('data'));
    }

    public function edit($id)
    {
        $categories = FaqCategory::get();
        $data = Faq::find($id);

        $this->seo(title: 'Edit FAQ — Admin');

        return $this->render('admin/resources/faq/edit', compact('data', 'categories'));
    }

    public function update(FaqRequest $request, $id)
    {
        $faq = Faq::find($id);

        $faq->faq_category_id = $request->faq_category_id;
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->is_active = $request->is_active;
        $faq->update();

        return redirect()->route('admin.faq.index')->with('success', 'Faq updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
