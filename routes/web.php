<?php

use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\UploadController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/admin/users/login', [LoginController::class, 'index'])->name('login');
Route::post('/admin/users/login/store', [LoginController::class, 'store']);

Route::middleware(['auth'])->group(function() {
    Route::prefix('admin')->group(function() {
        Route::get('/', [MainController::class, 'index'])->name('admin');
        Route::get('main', [MainController::class, 'index']);

        #Menu
        Route::prefix('menus')->group(function() {
            Route::get('add', [MenuController::class, 'create']);
            Route::post('add', [MenuController::class, 'store']);

            Route::get('list', [MenuController::class, 'index']);
            Route::get('edit/{menu}', [MenuController::class, 'show']);
            Route::post('edit/{menu}', [MenuController::class, 'update']);

            Route::DELETE('destroy', [MenuController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('product')->group(function() {
            Route::get('list', [ProductController::class, 'index'])->name('admin.product.index');

            Route::get('add', [ProductController::class, 'create'])->name('admin.product.add');
            Route::post('add', [ProductController::class, 'store']);

            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');

            Route::delete('delete/{id}', [ProductController::class, 'destroy'])->name('admin.product.delete');

            // Route::get('list', [ProductController::class, 'index']);
        });

        #Upload
        Route::post('upload/service', [UploadController::class, 'store']);
    });
});

