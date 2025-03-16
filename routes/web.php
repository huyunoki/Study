<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookMarkController;

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
    return view('auth.login');
});
Route::middleware('auth')->group(function () {

    Route::get('/place', [PlaceController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/places/create', [PlaceController::class, 'create']);
    Route::post('/places/store', [PlaceController::class, 'store']);
    Route::get('/places/{id}', [PlaceController::class, 'show'])->name('markdown.show');
    Route::get('/places/{id}/edit', [PlaceController::class, 'edit']);
    Route::put('/places/{id}/update', [PlaceController::class, 'update']);
    Route::delete('/places/{id}/delete', [PlaceController::class, 'delete']);

    Route::post('/category', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.show');

    Route::post('/places/{id}/bookmark', [BookmarkController::class, 'store']);
    Route::delete('/places/{id}/bookmark', [BookmarkController::class, 'destroy']);
});

require __DIR__ . '/auth.php';
