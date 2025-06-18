<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\{
    AuthController,
    ReviewController,
    SpecialListController,
    MovieListController,
    FollowController,
    MovieSocialController,
};

// ===== AUTENTICAÇÃO API =====

Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/profile', function () {
        return auth()->user();
    });
});


// ========== MOVIES ==========

Route::get('/movies/{tmdb_id}/social', [MovieSocialController::class, 'show'])
    ->middleware('tmdb.validate');

Route::get('/movies/{tmdb_id}/reviews', [ReviewController::class, 'index'])
    ->middleware('tmdb.validate');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/movies/{tmdb_id}/reviews', [ReviewController::class, 'store'])
        ->middleware('tmdb.validate');
});


// ========= REVIEWS ==========

Route::middleware('auth:sanctum')->group(function () {
    Route::put('/reviews/{review}', [ReviewController::class, 'update']);
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);
});


// ========== LISTS ============

// Listas especiais (me/lists)
Route::middleware('auth:sanctum')->prefix('me/lists')->group(function () {
    Route::get('/', [SpecialListController::class, 'getSpecialLists']);

    Route::post('/favorites/{tmdb_id}', [SpecialListController::class, 'addToFavorites'])
        ->middleware('tmdb.validate');
    Route::delete('/favorites/{tmdb_id}', [SpecialListController::class, 'removeFromFavorites'])
        ->middleware('tmdb.validate');

    Route::post('/watchlist/{tmdb_id}', [SpecialListController::class, 'addToWatchlist'])
        ->middleware('tmdb.validate');
    Route::delete('/watchlist/{tmdb_id}', [SpecialListController::class, 'removeFromWatchlist'])
        ->middleware('tmdb.validate');

    Route::post('/watched/{tmdb_id}', [SpecialListController::class, 'markAsWatched'])
        ->middleware('tmdb.validate');
});

// Listas personalizadas
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('lists', MovieListController::class);

    Route::post('/lists/{list}/movies/{tmdb_id}', [MovieListController::class, 'addMovieToList'])
        ->middleware('tmdb.validate');
    Route::delete('/lists/{list}/movies/{tmdb_id}', [MovieListController::class, 'removeMovieFromList'])
        ->middleware('tmdb.validate');
});


// ========= USERS ============

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/users/{user}/follow', [FollowController::class, 'follow']);
    Route::delete('/users/{user}/unfollow', [FollowController::class, 'unfollow']);

    Route::get('/users/{user}/followers', [FollowController::class, 'followers']);
    Route::get('/users/{user}/following', [FollowController::class, 'following']);
});