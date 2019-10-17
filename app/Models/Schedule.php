<?php

namespace App\Models;

use App\Models\Film;
use App\Models\Room;
use App\Models\User;
use App\Models\Borrowing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Schedule extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'schedules';

    protected $cascadeDeletes = ['borrowings'];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'film_id',
        'room_id',
        'time_start',
        'time_finish',
        'date',
    ];

    /**
     * The films that belong to the users.
     */
    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    /**
     * The room that belong to the users.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get room that owns the borrowings.
     */
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    /**
     * Get room that owns the borrowings.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
