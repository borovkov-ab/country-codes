<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Country;
use App\Http\Controllers\CountryController;

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

Route::get('/welcome', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'countries' => Country::all(),
        'countryIpInfo' => request()->countryIpInfo ?? [],
    ]);

})->middleware(['auth', 'verified', 'blockByIp'])->name('dashboard');

Route::get('/', function () {
    return Redirect::to('/dashboard');
});

Route::controller(CountryController::class)->group(function () {
    Route::post('/country', 'store')->middleware(['auth', 'verified'])->name('country');
    Route::delete('/country/{country}', 'destroy')->middleware(['auth', 'verified'])->name('country.destroy');
});


require __DIR__.'/auth.php';
