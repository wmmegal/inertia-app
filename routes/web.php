<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EndpointDestroyController;
use App\Http\Controllers\EndpointIndexController;
use App\Http\Controllers\EndpointsStoreController;
use App\Http\Controllers\EndpointUpdateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteNotificationEmailDestroyController;
use App\Http\Controllers\SiteNotificationEmailStoreController;
use App\Http\Controllers\SitesStoreController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// sites
Route::get('/dashboard/{site?}', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/sites', SitesStoreController::class)->middleware(['auth'])->name('add-site');

//endpoints
Route::post('/sites/{site}/endpoints', EndpointsStoreController::class)->middleware(['auth'])->name('add-endpoint');
Route::get('/endpoints/{endpoint}', EndpointIndexController::class)->middleware(['auth'])->name('show-endpoint');
Route::patch('/endpoints/{endpoint}', EndpointUpdateController::class)->middleware(['auth'])->name('update-endpoint');
Route::delete('/endpoints/{endpoint}', EndpointDestroyController::class)->middleware(['auth'])->name('delete-endpoint');

//notifications
Route::post('/sites/{site}/notifications/email', SiteNotificationEmailStoreController::class)->middleware('auth')->name('notifications.email');
Route::delete('/sites/{site}/notifications/email', SiteNotificationEmailDestroyController::class)->middleware('auth')->name('notifications.email.delete');

// user
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
