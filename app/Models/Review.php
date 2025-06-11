<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tmdb_id',
        'rating',
        'comment',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'tmdb_id' => 'integer',
        'rating' => 'float',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


}
