<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
    return view('welcome');
});

Route::get('/dashboard', function (Request $request) {
    return view('dashboard', [
        'countries' => App\Models\Country::all()->keyBy('id'),
        //'editedCountry' => $request->country_id ? App\Models\Country::find($request->country_id) : null,
        'editedCountryId' => $request->country_id ? $request->country_id : null,
    ]);
})->middleware(['auth', 'blockByIp'])->name('dashboard');

Route::get('/', function () {
    return Redirect::to('/dashboard');
});

Route::controller(CountryController::class)->middleware(['auth', 'blockByIp'])->group(function () {
    Route::post('/country', 'store')->name('country.store');
    Route::delete('/country/{country}', 'destroy')->name('country.destroy');
});

require __DIR__.'/auth.php';
