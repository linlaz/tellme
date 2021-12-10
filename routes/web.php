<?php

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\blogController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\saveController;
use App\Http\Controllers\userController;
use App\Http\Controllers\storyController;
use App\Http\Controllers\konsultasiController;
use App\Http\Controllers\SuggestionsController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

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

Route::get('/', [storyController::class, 'showAll'])->name('showAllStory');
Route::get('/blocked', function () {
    return view('welcome');
});
Route::get('/story/{slug}', [storyController::class, 'show'])->name('showstory');
Route::get('/addstory', [storyController::class, 'createguest'])->name('addstoryguest');
Route::post('/addstory', [storyController::class, 'store'])->name('storestoryguest');
Route::get('/register', [userController::class, 'create'])->name('registers');
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware(['guest:' . config('fortify.guard')])->name('registers');
Route::get('/blogs',[blogController::class,'showall'])->name('blogs');
Route::get('/blogs/{slug}', [blogController::class, 'show'])->name('showblogs');
Route::get('/suggestions', [SuggestionsController::class, 'index'])->name('suggestion');
Route::post('/suggestions', [SuggestionsController::class, 'store'])->name('addsuggestion');
// user
Route::group(['prefix' => 'dashboard',  'middleware' => 'auth:sanctum'], function () {
    //story
    Route::get('/', [storyController::class, 'index'])->name('dashboard');
    Route::get('/story', [storyController::class, 'create'])->name('addstory');
    Route::post('/addstory', [storyController::class, 'store'])->name('addstories');
    Route::get('/edit/{slug}', [storyController::class, 'edit'])->name('editstory');
    Route::post('/story', [storyController::class, 'update'])->name('editstories');
    Route::get('/storyhistory/{slug}', [storyController::class, 'showhistory'])->name('historystory');
    //endstory

    Route::get('/save', [saveController::class, 'index'])->name('save');
    Route::get('/konsultasi', [konsultasiController::class, 'index'])->name('konsultasi');
});
//enduser

//konsultan
Route::group(['middleware' => ['auth:sanctum', 'role:komunikasi|admin']], function () {
    Route::get('/komunikasi', [konsultasiController::class, 'index'])->name('komunikasi');
});
//endkonsultan

//writer
Route::group(['prefix' => 'blog', 'middleware' => ['auth:sanctum', 'role_or_permission::writer|admin|add-blog|delete-category']], function () {
    Route::get('/', [blogController::class, 'index'])->name('blog');
    Route::get('/create', [blogController::class, 'create'])->name('createblog');
    Route::post('/create/add', [blogController::class, 'store'])->name('createblogs');
    Route::get('/edit/{slug}', [blogController::class, 'edit'])->name('editblog');
    Route::get('/history/{slug}', [blogController::class, 'showhistory'])->name('historyblog');
    Route::post('/edit/submit', [blogController::class, 'update'])->name('editblogs');
    Route::get('/category', [blogController::class, 'categoryindex'])->name('category');
});
//endwriter

//admin
Route::group(['middleware' => ['role:admin', 'auth:sanctum']], function () {
    Route::get('/dashboardadmin', function () {
        return view('dashboardadmin.index');
    })->name('dashboardadmin');
    Route::get('/user', [userController::class, 'index'])->name('user');
    Route::get('/user/detailuser/{name}', [userController::class, 'show'])->name('detailuser');
    Route::get('/role', [roleController::class, 'index'])->name('aboutrole');
    Route::get('/admin/suggestions', [SuggestionsController::class, 'showall'])->name('adminsuggestions');
});
//endmain
