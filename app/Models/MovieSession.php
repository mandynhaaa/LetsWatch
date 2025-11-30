<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MovieSession extends Model
{
    use HasFactory;
    
    protected $table = 'movie_session'; 

    protected $fillable = [
        'group_id',
        'tmdb_movie_id',
        'rating',
        'comment',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
