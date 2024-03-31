<?php

use Illuminate\Support\Facades\Route;

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
use App\Http\Controllers\HomeController;
    Route::get('/', [HomeController::class, 'index']);
use App\Http\Controllers\ContactController;
    Route::get('/contact', [ContactController::class, 'index']);
    Route::post('/contact', [ContactController::class, 'store']); //ajout de la route pour le formulaire de contact
use App\Http\Controllers\RecettesController;
    Route::get('/recettes', [RecettesController::class, 'index']);
    Route::get('/recettes/search', [RecettesController::class, 'search']);
    Route::get('/recettes/{url}',[RecettesController::class, 'show']);
use App\Http\Controllers\CommentController;
    Route::post('/comment', [CommentController::class, 'store']);
use App\Http\Controllers\AdminController;
    Route::resource('/admin/recettes', AdminController::class);
use App\Http\Controllers\CaptchaServiceController;
    Route::get('/captcha', [CaptchaServiceController::class, 'index']);
    Route::post('/captcha', [CaptchaServiceController::class, 'capthcaFormValidate']);
    Route::get('/reload-captcha', [CaptchaServiceController::class, 'reloadCaptcha']);
/* Captcha controller - Problem de route
use App\Http\Controllers\CaptchaController;
    Route::get('/captcha', [CaptchaController::class, 'showForm']);
    Route::post('/captcha', [CaptchaController::class, 'handleSubmit']);
*/

use App\Http\Controllers\TagController;
    Route::get('/tags', [TagController::class, 'index']);
    Route::get('/tags/{name}', [TagController::class, 'searchByTag']);
