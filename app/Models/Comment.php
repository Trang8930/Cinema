<?php

namespace App\Models;

use App\Models\Film;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Comment extends Model
{
    use SoftDeletes, CascadeSoftDeletes;

    /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'comments';

    protected $cascadeDeletes = ['favorites'];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'film_id',
        'content',
        'parent_id',
        'rating'        
    ];

   /**
     * Get the film that owns the comments.
     */
    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    /**
     * Get the user that owns the comments.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the cinema's favorites.
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }
}
