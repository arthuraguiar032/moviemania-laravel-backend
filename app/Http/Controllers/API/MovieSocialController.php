<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
use App\Models\MovieList;
use App\Models\Review;
use App\Models\SpecialListItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieSocialController extends Controller {
    public function show($tmdb_id) {
        return response()->json([
            'tmdb_id' => (int)$tmdb_id,
            'average_rating' => Review::where('tmdb_id', $tmdb_id)->avg('rating') ?: 0,
            'review_count' => Review::where('tmdb_id', $tmdb_id)->count(),
            'favorites_count' => $this->countSpecialListItems($tmdb_id, 'favorites'),
            'watchlist_count' => $this->countSpecialListItems($tmdb_id, 'watchlist'),
            'popular_lists' => MovieList::public()
                ->whereHas('items', fn($q) => $q->where('tmdb_id', $tmdb_id))
                ->limit(5)
                ->get(['id', 'title', 'user_id'])
        ]);
    }

    private function countSpecialListItems($tmdb_id, $type) {
        return DB::table('special_list_items')
            ->join('special_lists', 'special_lists.id', '=', 'special_list_items.special_list_id')
            ->where('special_lists.list_type', $type)
            ->where('special_list_items.tmdb_id', $tmdb_id)
            ->count();
    }
}
