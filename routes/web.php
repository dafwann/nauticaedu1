<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;


Route::get('/{any}', [PageController::class, 'index'])
    ->where('any', '^(?!api).*$');
