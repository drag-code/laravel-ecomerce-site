<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Livewire\Admin\Products\{Index, Create, Edit};
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('admin.index');
Route::get('products/{product}/edit', Edit::class)->name('admin.products.edit');
Route::get('products/create', Create::class)->name('admin.products.create');

Route::post('products/{product}/files',[ProductController::class, 'files'])->name('admin.products.files');
