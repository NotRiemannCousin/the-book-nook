<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
    APIBookController,
    APIAuthorController,
    APIPublisherController,
    APIGenreController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return response()->json(['sla' => 'idk']);
});



Route::apiResources(
    [
        '/books' => APIBookController::class,
        '/authors' => APIAuthorController::class,
        '/publishers' => APIPublisherController::class,
        '/genres' => APIGenreController::class
    ],
    [
        'only' => [
            'index',
            'show'
        ]
    ]
);