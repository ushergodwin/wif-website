<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\PartnershipController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\PartnerInquiryController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// About
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Projects
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');

// Testimonials
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');

// Partnerships
Route::get('/partnerships', [PartnershipController::class, 'index'])->name('partnerships.index');
Route::post('/partnerships/inquiry', [PartnerInquiryController::class, 'store'])->name('partnerships.inquiry.store');

// Gallery
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Subscribers
Route::get('/join', [SubscriberController::class, 'create'])->name('subscribers.create');
Route::post('/subscribers', [SubscriberController::class, 'store'])->name('subscribers.store');
