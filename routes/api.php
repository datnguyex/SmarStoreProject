<?php 
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Vite;
use Illuminate\Http\Request;
use App\Http\Controllers\ProductController;

Route::get('ajax-search', [ProductController::class, 'ajaxSearch'])->name('ajax-search');