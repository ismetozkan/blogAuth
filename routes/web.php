<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BlogHomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->middleware('auth')->group(function() {
    Route::any('panel', [AdminController::class, 'index'])->name('admin.index');
    Route::any('deletearticle/{id}', [ArticleController::class, 'delete'])->name('delete');
    Route::any('harddeletearticle/{id}', [ArticleController::class, 'hardDelete'])->name('hard.delete');
    Route::any('trash', [ArticleController::class, 'trash'])->name('trash');
    Route::any('callback/{id}', [ArticleController::class, 'callBack'])->name('callback');
    Route::resource('articles', ArticleController::class);
    Route::prefix('categories')->group(function () {
        Route::any('index', [CategoryController::class, 'index'])->name('category.index');
        Route::any('create', [CategoryController::class, 'create'])->name('category.create');
        Route::any('update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::any('edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::any('delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    });
    Route::resource('pages', PageController::class);
    Route::prefix('pages')->group(function () {
        Route::any('deletepage/{id}', [PageController::class, 'delete'])->name('delete.page');
        Route::any('harddeletearticle/{id}', [PageController::class, 'hardDelete'])->name('hard.delete.page');
        Route::any('trash', [PageController::class, 'trash'])->name('trash.page');
        Route::any('callback/{id}', [PageController::class, 'callBack'])->name('callback.page');
    });

    Route::get('settings',[SettingsController::class,'index'])->name('admin.settings');
    Route::post('settings/update',[SettingsController::class,'update'])->name('update.settings');
});

Route::prefix('bloghome')->group(function(){
    Route::any('/', [BlogHomeController::class,'index'])->name('bloghome.index');
    Route::get('contact',[BlogHomeController::class,'contact'])->name('contact');
    Route::post('contact',[BlogHomeController::class,'contactPost'])->name('contactPost');
    Route::any('blog/{slug}',[BlogHomeController::class,'single'])->name('single.blog');
});

Route::any('category/{category}',[BlogHomeController::class,'category'])->name('category.show');
Route::any('{page}',[BlogHomeController::class,'page'])->name('page');

Route::get('maintenance', function (){
   view('front.offline');
});
