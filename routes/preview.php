<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PreviewController;

Route::get('cover/{id}', [PreviewController::class, 'getCover']);
Route::get('doc/{id}', [PreviewController::class, 'getDocumento']);
