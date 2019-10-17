<?php

namespace App\Models;

use App\Models\Room;
use App\Models\DetailBorrowing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Seat extends Model
{
    use SoftDeletes, CascadeSoftDeletes;

    /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'seats';

    protected $cascadeDeletes = ['details'];

    protected $dates = ['deleted_at'];

    const IS_AVAILABLE = 1;
    const NOT_AVAILABLE = 0;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'room_id',
        'x_seats',
        'y_seats',
        'status',
    ];

    /**
     * The room that belong to the users.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get details that owns the borrowings.
     */
    public function details()
    {
        return $this->hasMany(DetailBorrowing::class);
    }
}
