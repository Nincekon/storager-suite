<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TownController;
use App\Http\Controllers\Admin\ActorController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\QuarterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CharacterController;
use App\Http\Controllers\Admin\ResidenceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/tableau-de-bord', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('tableau');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::resource('categories', CategoryController::class);
        Route::resource('characters', CharacterController::class);
        Route::resource('features', FeatureController::class);
        Route::resource('cities', CityController::class);
        Route::resource('towns', TownController::class);
        Route::resource('quarters', QuarterController::class);
        Route::resource('residences', ResidenceController::class);
        Route::resource('actors', ActorController::class);
        Route::resource('roles', RoleController::class);

    });

});

require __DIR__.'/auth.php';
