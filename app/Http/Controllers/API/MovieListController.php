<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MovieList;
use App\Models\MovieListItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class MovieListController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
        ]);

        $list = MovieList::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'is_public' => $request->is_public ?? true,
        ]);

        return response()->json($list, 201);
    }

    public function update(Request $request, MovieList $list)
    {
        $this->authorize('update', $list);
        
        $request->validate([
            'title' => 'string|max:100',
            'description' => 'nullable|string',
            'is_public' => 'boolean',
        ]);

        $list->update($request->only(['title', 'description', 'is_public']));
        
        return response()->json($list);
    }

    public function destroy(MovieList $list)
    {
        $this->authorize('delete', $list);
        $list->delete();
        
        return response()->json([
            'message' => 'Lista removida com sucesso'
        ]);
    }

    public function addMovieToList(Request $request, MovieList $list, $tmdb_id)
    {
        $this->authorize('update', $list);
        $list->items()->create(['tmdb_id' => $tmdb_id]);
        
        return response()->json([
            'message' => 'Filme adicionado à lista'
        ], 201);
    }

    public function removeMovieFromList(MovieList $list, $tmdb_id)
    {
        $this->authorize('update', $list);
        $list->items()->where('tmdb_id', $tmdb_id)->delete();
        
        return response()->json([
            'message' => 'Filme removido da lista'
        ]);
    }

    public function show(MovieList $list)
    {
        return response()->json([
            'list' => $list->load('items')
        ]);
    }
}