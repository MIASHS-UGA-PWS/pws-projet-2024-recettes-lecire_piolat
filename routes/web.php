<?php

use App\Http\Controllers\ProfileController;
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
/* Main */
use App\Http\Controllers\HomeController;
    Route::get('/', [HomeController::class, 'index']);

/* Formulaire de contact */
use App\Http\Controllers\ContactController;
    Route::get('/contact', [ContactController::class, 'index']);
    Route::post('/contact', [ContactController::class, 'store']);

/* Recettes */
use App\Http\Controllers\RecettesController;
    Route::get('/recettes', [RecettesController::class, 'index']);
    Route::get('/recettes/search', [RecettesController::class, 'search']);
    Route::get('/recettes/{url}',[RecettesController::class, 'show']);

/* Commentaires */
use App\Http\Controllers\CommentController;
    Route::post('/comment', [CommentController::class, 'store']);
use App\Http\Controllers\AdminController;
    Route::resource('/admin/recettes', AdminController::class);

/* Notes */
 use App\Http\Controllers\RatingController;
    Route::post('/rate-recipe', [RatingController::class, 'rateRecipe']);

/* Tags */
use App\Http\Controllers\TagController;
    Route::get('/tags', [TagController::class, 'index']);
    Route::get('/tags/{name}', [TagController::class, 'searchByTag']);

/* Roles */
use App\Http\Controllers\RoleController;
    Route::get('/roles', [RoleController::class, 'index']);
    Route::get('/roles/create', [RoleController::class, 'create']);
    Route::post('/roles', [RoleController::class, 'store']);
    Route::get('/roles/{id}', [RoleController::class, 'show']);
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit']);
    Route::put('/roles/{id}', [RoleController::class, 'update']);
    Route::delete('/roles/{id}', [RoleController::class, 'destroy']);

/* Authentification */
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
