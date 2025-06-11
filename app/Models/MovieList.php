<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\MovieListItem;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MovieList extends Model{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tittle',
        'description',
        'is_public'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function items(){
        return $this->hasMany(MovieListItem::class);
    }

    //Scopes
    public function scopePublic($query){
        return $query->where('is_public', true);
    }
}
