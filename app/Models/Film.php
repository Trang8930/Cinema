<?php

namespace App\Models;

use App\Models\Room;
use App\Models\User;
use App\Models\Comment;
use App\Models\Favorite;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Film extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    
    /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'films';

    protected $cascadeDeletes = ['schedules', 'comments', 'favorites'];

    protected $dates = ['deleted_at'];

    public static $kind = [
        '2D' => '2D',
        '3D' => '3D',
        '4D' => '4D',
        'IMAX' => 'IMAX',
    ];

    public static $genre = [
        'action' => 'Action',
        'romantice' => 'Romantice',
        'supernatural' => 'Supernatural',
        'fiction' => 'Fiction'
    ];

    const IS_ACTIVE = 1;
    const NOT_ACTIVE = 0;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'year',
        'price',
        'author',
        'actor',
        'genre',
        'time_limit',
        'kind',
        'avg_rating',
        'total_rating',
        'is_active',
        'image',
        'video_url',
        'content'
    ];

    /**
     * The film that belong to the users.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * The film that belong to the rooms.
     */
    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }

    /**
     * Get the schedules for film.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Get film that owns the borrowings.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get all of the cinema's favorites.
     */
    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favoritable');
    }
}
