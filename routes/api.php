<?php

use App\Http\Controllers\API\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {
    return response()->json([
        'message' => 'pong',
    ]);
});

Route::apiResource('books', BookController::class);