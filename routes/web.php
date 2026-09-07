<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\InboxController;
use Illuminate\Support\Facades\Session;

// Language Switch Route
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'bn'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back() ?: redirect('/');
})->name('language.switch');

Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/gig/{id}', 'gigDetail')->name('gig.detail');
    Route::get('/case-study/{id}', 'caseStudyDetail')->name('case-study.detail');
    Route::get('/project/{id}', 'projectDetail')->name('project.detail');
});

Route::prefix('/inbox')->name('inbox.')->controller(InboxController::class)->middleware('auth')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{id}', 'show')->name('show');
    Route::post('/{id}/send', 'sendMessage')->name('send');
    Route::post('/order/{gigId}/{package}', 'orderFromGig')->name('order');
});

Route::post('/contactus', [UserController::class, 'contactus'])->name('contactus');

Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Auth::routes();

include('admin.php');
