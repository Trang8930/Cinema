<?php

namespace App\Models;

use App\Models\Cinema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class City extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    
    /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'cities';

    protected $cascadeDeletes = ['cinemas'];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the cinemas of cities .
     */
    public function cinemas()
    {
        return $this->hasMany(Cinema::class);
    }

    /**
     * Get the users of cities .
     */
    public function users()
    {
        return $this->hasMany(Cinema::class);
    }
}
