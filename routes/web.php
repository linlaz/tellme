<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\blogController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\saveController;
use App\Http\Controllers\userController;
use App\Http\Controllers\storyController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\konsultasiController;
use App\Http\Controllers\SuggestionsController;
use App\Models\Suggestions;
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

Route::get('/', [storyController::class, 'index'])->name('indexstory');
// Route::get('/', function (Request $request) {
//     return view('index', ['location' => $request->ipinfo->all]);
// });
Route::get('/blocked', function () {
    return view('welcome');
});
//story
Route::get('/story/{slug}', [storyController::class, 'show'])->name('showstory');
Route::get('/blog', [blogController::class, 'index'])->name('blogs');
Route::get('/blog/category/{slug}', [blogController::class, 'showbycategory'])->name('showbycategoryblogs');
Route::get('/blog/read/{slug}', [blogController::class, 'show'])->name('showblogs');
Route::get('/register', [userController::class, 'create'])->name('registers');
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware(['guest:' . config('fortify.guard')])->name('registers');

Route::get('/suggestions', [SuggestionsController::class, 'index'])->name('suggestion');
Route::post('/suggestions', [SuggestionsController::class, 'store'])->name('addsuggestion');
// user

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/save', [saveController::class, 'index'])->name('indexsave');
    Route::get('/consultation', [konsultasiController::class, 'index'])->name('indexkonsultasi');
    Route::get('/profile', [userController::class, 'index'])->name('indexprofile');
    Route::get('/settingprofile', [userController::class, 'setting'])->name('settingprofile');
});

Route::group(['prefix' => 'dashboard',  'middleware' => 'auth:sanctum'], function () {

    Route::group(['prefix' => '/story', 'middleware' => ['role_or_permission:konsultan|writer|admin']], function () {
        Route::get('/', [storyController::class, 'showdashboard'])->name('storydashboard');
    });
    Route::group(['prefix' => '/blog', 'middleware' => ['role_or_permission:writer|admin|add-blog']], function () {
        Route::get('/', [blogController::class, 'showdashboard'])->name('blogdashboard');
        Route::get('/create', [blogController::class, 'create'])->name('createblogdashboard');
        Route::post('/create', [blogController::class, 'store'])->name('storeblogdashboard');
        Route::get('/{slug}/edit', [blogController::class, 'editdashboard'])->name('editblogdashboard');
        Route::post('/edit', [blogController::class, 'updatedashboard'])->name('editblogdashboard');
    });
    Route::group(['prefix' => '/category', 'middleware' => ['role_or_permission:writer|admin|add-category']], function () {
        Route::get('/', [categoryController::class, 'showcategorydashboard'])->name('showcategorydashboard');
    });
    Route::group(['prefix' => '/komunikasi', 'middleware' => ['role_or_permission:konsultan|admin|add-category']], function () {
        Route::get('/', [konsultasiController::class, 'indexkonsultasidashboard'])->name('indexkonsultasidashboard');
    });
    Route::group(['prefix' => '/admin', 'middleware' => ['role_or_permission:konsultan|admin|add-category']], function () {
        Route::get('/', [SuggestionsController::class, 'indexdashboardadmin'])->name('indexdashboardadmin');
    });
    Route::group(['prefix' => '/role', 'middleware' => ['role_or_permission:konsultan|admin|add-category']], function () {
        Route::get('/', [roleController::class, 'index'])->name('indexrole');
    });
    Route::group(['prefix' => '/User', 'middleware' => ['role_or_permission:konsultan|admin|add-category']], function () {
        Route::get('/', [userController::class, 'indexdashboard'])->name('user');
    });
    Route::group(['prefix' => '/suggestion', 'middleware' => ['role_or_permission:konsultan|admin|add-category']], function () {
        Route::get('/', [SuggestionsController::class, 'indexdashboard'])->name('indexdashboard');
    });
    // Route::get('/story', [storyController::class, 'create'])->name('addstory');
    // Route::post('/addstory', [storyController::class, 'store'])->name('addstories');
    // Route::get('/edit/{slug}', [storyController::class, 'edit'])->name('editstory');
    // Route::post('/story', [storyController::class, 'update'])->name('editstories');
    // Route::get('/storyhistory/{slug}', [storyController::class, 'showhistory'])->name('historystory');
    //endstory
});
//enduser


//writer
// Route::group(['prefix' => 'blogs', 'middleware' => ['auth:sanctum', 'role_or_permission::writer|admin|add-blog|delete-category']], function () {
//     Route::get('/', [blogController::class, 'index'])->name('blog');
//     Route::get('/create', [blogController::class, 'create'])->name('createblog');
//     Route::post('/create/add', [blogController::class, 'store'])->name('createblogs');
//     Route::get('/edit/{slug}', [blogController::class, 'edit'])->name('editblog');
//     Route::get('/history/{slug}', [blogController::class, 'showhistory'])->name('historyblog');
//     Route::post('/edit/submit', [blogController::class, 'update'])->name('editblogs');
//     Route::get('/category', [blogController::class, 'categoryindex'])->name('category');
// });
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
