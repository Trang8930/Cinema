<?php

namespace App\Models;

use App\Models\City;
use App\Models\Room;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Cinema extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    
    /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'cinemas';

    protected $cascadeDeletes = ['rooms'];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city_id',
        'name',
    ];

    /**
     * Get the rooms of cinemas.
     */
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    /**
     * Get the city that owns the cinemas.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
