<?php

use App\Http\Controllers\WidgetController;
use Illuminate\Support\Facades\Route;

Route::get('widget', [WidgetController::class, 'create']);


require __DIR__.'/auth.php';
