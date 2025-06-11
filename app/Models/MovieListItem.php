<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\MovieList;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovieListItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_list_id',
        'tmdb_id',
        'custom_order',
    ];

    protected $casts = [
        'tmdb_id' => 'integer',
        'custom_order' => 'integer',
    ];

    public function movieList(){
        return $this->belongsTo(MovieList::class);
    }
}
