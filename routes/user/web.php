<?php

use App\Http\Controllers\User\BlogController;
use App\Http\Controllers\User\HomePageController;
use App\Http\Controllers\User\PageController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\TrackVisitor;
use App\Models\Visitor;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', HandleInertiaRequests::class, TrackVisitor::class])->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    });
    // your routes here
    Route::get('/', [HomePageController::class, 'home'])->name('home');
    Route::get('/about', [PageController::class, 'about'])->name('about');
    Route::get('/blogs', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');
    Route::post('/blog/comment/{id}', [BlogController::class, 'postComment'])->name('blog.comment');
    Route::get('/productCategory/{id}', [ProductController::class, 'productCategory'])->name('productCategory.show');
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product/{id}', [ProductController::class, 'productDetail'])->name('product.show');
    Route::post('/product_enquiry', [ProductController::class, 'productEnquiry'])->name('product.enquiry');
    Route::get('/services', [PageController::class, 'services'])->name('services');
    Route::get('/service/{id}', [PageController::class, 'serviceDetail'])->name('serviceDetail');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::post('/contact', [PageController::class, 'contactSubmit']);
    Route::post('/newsletter', [PageController::class, 'newsletter'])->name('newsletter');
    Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
    Route::get('/tnc', [PageController::class, 'tnc'])->name('tnc');
    Route::get('/refund', [PageController::class, 'refund'])->name('refund');
    Route::get('/faq', [PageController::class, 'faq'])->name('faq');
    require __DIR__.'/auth.php';
});

Route::get('/api/visitors/count', function () {
    return response()->json([
        'total' => Visitor::count(),
        'today' => Visitor::whereDate('created_at', now())->count(),
    ]);
});
