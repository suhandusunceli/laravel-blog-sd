<?php

use App\Http\Controllers\Back\ConfigController;
use App\Http\Controllers\Back\PageController;
use App\Http\Controllers\Front\Homepage;
use App\Http\Controllers\Back\Dashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\CategoryController;

// Auth routes provided by Laravel
Auth::routes();

/*
|------------------------------------------------------------------
| Backend Routes
|------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard route
    Route::get('panel', [Dashboard::class, 'index'])->name('dashboard');

    // Logout route
    Route::get('cikis', [LoginController::class, 'logout'])->name('logout');

    // Article routes
    Route::get('/switch', [ArticleController::class, 'switch'])->name('switch');
    Route::get('/deletearticle/{id}', [ArticleController::class, 'delete'])->name('delete.article');
    Route::delete('/admin/makaleler/{id}', [ArticleController::class, 'destroy'])->name('admin.makaleler.destroy');
    Route::get('/recoverarticle/{id}', [ArticleController::class, 'recover'])->name('recover.article');
    Route::get('makaleler/silinenler', [ArticleController::class, 'trashed'])->name('trashed.article');
    Route::resource('makaleler', ArticleController::class); // CRUD resource for articles

    // Category routes
    Route::get('/kategoriler', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/kategoriler/create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('/kategori/status', [CategoryController::class, 'switch'])->name('category.switch');
    Route::get('/kategori/getData', [CategoryController::class, 'getData'])->name('category.getdata');
    Route::delete('/kategori/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    // Page routes
    Route::resource('/sayfalar', PageController::class)->names('page');
    Route::post('/sayfa/switch', [PageController::class, 'switch'])->name('page.switch');
    Route::get('/sayfa/siralama', [PageController::class, 'orders'])->name('page.orders');

    // Config routes
    Route::get('/ayarlar', [ConfigController::class, 'index'])->name('config.index');
    Route::post('/ayarlar/update', [ConfigController::class, 'update'])->name('config.update');



});

/*
|------------------------------------------------------------------
| Front Routes
|------------------------------------------------------------------
*/
Route::get('/', [Homepage::class, 'index'])->name('homepage'); // Homepage route
Route::post('/iletisim-gonder', [Homepage::class, 'post'])->name('contact.post'); // Contact form submission
Route::get('/iletisim', [Homepage::class, 'contact'])->name('contact'); // Contact page
Route::get('/kategori/{category}', [Homepage::class, 'category'])->name('category'); // Category page
Route::get('/blog/{category}/{slug}', [Homepage::class, 'single'])->name('single'); // Single blog post
Route::get('/{sayfa}', [Homepage::class, 'page'])->name('page'); // Generic page route
Route::get('/search', [Homepage::class, 'search'])->name('search');
Route::get('site-bakimda',function(){
    return view('front.offline');
});
