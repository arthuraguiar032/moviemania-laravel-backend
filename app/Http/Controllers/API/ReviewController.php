<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    // registra uma nova avaliação
    public function store(Request $request, int $tmdb_id) {
        // Verifica se o usuário está autenticado
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Validação dos dados da requisição
        $validador = Validator::make($request->all(), [
            'content' => 'nullable|string|max:1000',
            'rating' => 'required|numeric|min:0|max:10',
        ]);

        if ($validador->fails()) {
            return response()->json($validador->errors(), 422);
        }

        // Verifica se já existe uma avaliação para o usuário e o tmdb_id
        $jaExiste = Review::where('tmdb_id', $tmdb_id)
            ->where('user_id', Auth::id())
            ->exists();
        
        if ($jaExiste) {
            return response()->json([
                'error' => 'Conflict',
                'message' => 'Você já avaliou este filme. Use PUT para atualizar a review existente.'
            ], 409);
        }

        // cria uma nova avaliação se não existir
        $review = Review::create([
            'tmdb_id' => $tmdb_id,
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
            'rating' => $request->input('rating'),
        ]);

        return response()->json($review, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $tmdb_id) {
        // Verifica se o usuário está autenticado
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
