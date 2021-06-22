<?php

use App\Http\Livewire\Admin\Products\{Index, Create};
use Illuminate\Support\Facades\Route;

Route::get('/', Index::class)->name('admin.index');
Route::get('product/{product}/edit')->name('admin.products.edit');
Route::get('products/create', Create::class)->name('admin.products.create');
