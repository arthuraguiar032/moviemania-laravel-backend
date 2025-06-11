<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\MovieList;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\SpecialLists;
use Laravel\Sanctum\HasApiTokens; 

class User extends Authenticatable {
    
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_url',
        'bio',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function specialLists() {
        return $this->hasMany(SpecialList::class);
    }

    public function movieLists() {
        return $this->hasMany(MovieList::class);
    }

    public function followers() {
        return $this->belongsToMany(
            User::class, 
            'followers', 
            'followed_id', 
            'follower_id'
        )->withTimestamps();
    }

    public function following() {
        return $this->belongsToMany(
            User::class, 
            'followers', 
            'follower_id', 
            'followed_id'
        )->withTimestamps();
    }

    //listas especiais
    public function favoritesList() {
        return $this->specialLists()->firstOrCreate(
            ['list_type' => 'favorites'],
            ['list_type' => 'favorites']
        );
    }

    public function watchedList() {
        return $this->specialLists()->firstOrCreate(
            ['list_type' => 'watched'],
            ['list_type' => 'watched']
        );
    }
    
    public function watchlistList() {
        return $this->specialLists()->firstOrCreate(
            ['list_type' => 'watchlist'],
            ['list_type' => 'watchlist']
        );
    }
}
