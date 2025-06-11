<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\SpecialList;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SpecialListItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'special_list_id',
        'tmdb_id'
    ];

    protected $casts = [
        'tmdb_id' => 'integer'
    ];

    public function specialList()
    {
        return $this->belongsTo(SpecialList::class);
    }

}
