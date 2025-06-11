<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Follower extends Model {
    use HasFactory;

    protected $table = 'followers';
    
    protected $fillable = [
        'follower_id',
        'followed_id',
    ];

    public function follower(){
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function followed(){
        return $this->belongsTo(User::class, 'followed_id');
    }
}
