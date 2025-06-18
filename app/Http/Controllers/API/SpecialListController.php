<?php

// app/Http/Controllers/API/SpecialListController.php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SpecialList;
use App\Models\SpecialListItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SpecialListController extends Controller
{
    public function addToFavorites(Request $request, $tmdb_id)
    {
        $user = Auth::user();
        $favorites = $user->favoritesList();
        
        // Verificar limite de 5 favoritos
        if ($favorites->items()->count() >= 5) {
            throw ValidationException::withMessages([
                'error' => 'Limite de 5 favoritos atingido'
            ]);
        }
        
        // Adicionar item
        $favorites->items()->firstOrCreate(['tmdb_id' => $tmdb_id]);
        
        return response()->json([
            'message' => 'Filme adicionado aos favoritos'
        ], 201);
    }

    public function removeFromFavorites($tmdb_id)
    {
        $user = Auth::user();
        $favorites = $user->favoritesList();
        $favorites->items()->where('tmdb_id', $tmdb_id)->delete();
        
        return response()->json([
            'message' => 'Filme removido dos favoritos'
        ]);
    }

    public function addToWatchlist(Request $request, $tmdb_id)
    {
        $user = Auth::user();
        $watchlist = $user->watchlistList();
        $watchlist->items()->firstOrCreate(['tmdb_id' => $tmdb_id]);
        
        return response()->json([
            'message' => 'Filme adicionado à watchlist'
        ], 201);
    }

    public function removeFromWatchlist($tmdb_id)
    {
        $user = Auth::user();
        $watchlist = $user->watchlistList();
        $watchlist->items()->where('tmdb_id', $tmdb_id)->delete();
        
        return response()->json([
            'message' => 'Filme removido da watchlist'
        ]);
    }

    public function markAsWatched($tmdb_id)
    {
        $user = Auth::user();
        $watched = $user->watchedList();
        $watched->items()->firstOrCreate(['tmdb_id' => $tmdb_id]);
        
        return response()->json([
            'message' => 'Filme marcado como assistido'
        ], 201);
    }

    public function getSpecialLists()
    {
        $user = Auth::user();
        
        return response()->json([
            'favorites' => $user->favoritesList->items->pluck('tmdb_id'),
            'watched' => $user->watchedList->items->pluck('tmdb_id'),
            'watchlist' => $user->watchlistList->items->pluck('tmdb_id')
        ]);
    }
}