<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\MovieListItem;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpecialList extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'list_type'];

    protected static function booted(){
        //impede exclusao de listas especiais
        static::deleting(function ($list) {
            throw new \Exception('You cannot delete a special list.');
        });
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function items(){
        return $this->hasMany(MovieListItem::class);
    }

    public function scopeFavorites($query){
        return $query->where('list_type', 'favorites');
    }

    public function scopeWatchlist($query){
        return $query->where('list_type', 'watchlist');
    }

    public function scopeWatched($query){
        return $query->where('list_type', 'watched');
    }

}
