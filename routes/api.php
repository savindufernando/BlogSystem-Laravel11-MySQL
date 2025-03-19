<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('api')->get('/example', function () {
    return response()->json(['message' => 'Hello from the API!']);
});


// Public routes for authentication (login/register)
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

// Routes for posts (protected by Sanctum authentication)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/posts', [PostController::class, 'store']);   // Create a new post
    Route::get('/posts', [PostController::class, 'index']);    // List all posts (only the authenticated user's posts)
    Route::get('/posts/{id}', [PostController::class, 'show']); // Retrieve a specific post
    Route::put('/posts/{id}', [PostController::class, 'update']); // Update a specific post
    Route::delete('/posts/{id}', [PostController::class, 'destroy']); // Delete a post
    
    // Bonus: Search posts by title
    Route::get('/posts/search', [PostController::class, 'search']);
});
