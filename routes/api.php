<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PhotoController;
use App\Models\Photo;
use App\Models\Category;
use App\Http\Controllers\API\CategoryController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });




// Option 1
// Route::get('photos', function () {
//     return Photo::all();
// });


// Route Api Photo
Route::get('photos', [PhotoController::class, 'index']);
Route::get('photos/{photo}', [PhotoController::class, 'show']);


// Route Api Category
Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{category}', [CategoryController::class, 'show']);
