<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateTmdbId {

    public function handle(Request $request, Closure $next) {
        $tmdb_id = $request->route('tmdb_id');
    
        if (!is_numeric($tmdb_id)) {
            return response()->json(['error' => 'TMDB ID deve ser numérico'], 400);
        }
        
        return $next($request);
    }
}