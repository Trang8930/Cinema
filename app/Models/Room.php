<?php

namespace App\Models;

use App\Models\Film;
use App\Models\Seat;
use App\Models\Cinema;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Room extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    
    /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'rooms';

    protected $cascadeDeletes = ['schedules', 'seats'];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'cinema_id',
        'seats_available',
    ];

    /**
     * The films that belong to the users.
     */
    public function films()
    {
        return $this->belongsToMany(Film::class);
    }

    /**
     * Get the schedules for room.
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Get the cinema that owns the rooms.
     */
    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }

    /**
     * Get room that owns the seats.
     */
    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
