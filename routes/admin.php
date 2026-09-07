<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\AccountController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\ProjectController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\ExperienceController;
use App\Http\Controllers\admin\SkillController;
use App\Http\Controllers\admin\EducationQualificationController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\FaqController;
use App\Http\Controllers\admin\CaseStudyController;
use App\Http\Controllers\admin\GigController;
use App\Http\Controllers\admin\InboxController;


Route::prefix('/admin')->middleware('admin')->group(function () {

    // Dashboard
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('admin.dashboard.index');
    });

    //Account
    Route::prefix('/account')->name('admin.account.')->controller(AccountController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/edit', 'edit')->name('edit');
        Route::post('/update', 'update')->name('update');
        Route::post('/delete-image', 'deleteImage')->name('deleteImage');
    });

     // Contact
    Route::prefix('/contact')->name('admin.contact.')->controller(ContactController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });

    // Projects
    Route::prefix('/projects')->name('admin.projects.')->controller(ProjectController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::get('/toggle-status/{id}', 'toggleStatus')->name('toggleStatus');
        Route::post('/delete-image/{id}', 'deleteImage')->name('deleteImage');
    });

    // Testimonials
    Route::prefix('/testimonials')->name('admin.testimonials.')->controller(TestimonialController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::get('/toggle-status/{id}', 'toggleStatus')->name('toggleStatus');
        Route::post('/delete-image/{id}', 'deleteImage')->name('deleteImage');
    });

    // Experiences
    Route::prefix('/experiences')->name('admin.experiences.')->controller(ExperienceController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::get('/toggle-status/{id}', 'toggleStatus')->name('toggleStatus');
    });

    // Education Qualifications
    Route::prefix('/education')->name('admin.education.')->controller(EducationQualificationController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::get('/toggle-status/{id}', 'toggleStatus')->name('toggleStatus');
    });

    // Skills
    Route::prefix('/skills')->name('admin.skills.')->controller(SkillController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::get('/toggle-status/{id}', 'toggleStatus')->name('toggleStatus');
    });

    // Services
    Route::prefix('/services')->name('admin.services.')->controller(ServiceController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::get('/toggle-status/{id}', 'toggleStatus')->name('toggleStatus');
    });

    // Case Studies
    Route::prefix('/case-studies')->name('admin.casestudies.')->controller(CaseStudyController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::get('/toggle-status/{id}', 'toggleStatus')->name('toggleStatus');
        Route::post('/delete-image/{id}', 'deleteImage')->name('deleteImage');
    });

    // Gigs
    Route::prefix('/gigs')->name('admin.gigs.')->controller(GigController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::get('/toggle-status/{id}', 'toggleStatus')->name('toggleStatus');
        Route::post('/delete-image/{id}', 'deleteImage')->name('deleteImage');
    });

    // FAQs
    Route::prefix('/faqs')->name('admin.faqs.')->controller(FaqController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
        Route::get('/toggle-status/{id}', 'toggleStatus')->name('toggleStatus');
    });

    // Inbox
    Route::prefix('/inbox')->name('admin.inbox.')->controller(InboxController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
        Route::post('/{id}/send', 'sendMessage')->name('send');
    });
});