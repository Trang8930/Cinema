<?php

namespace App\Models;

use App\Models\User;
use App\Models\Schedule;
use App\Models\DetailBorrowing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Iatstuti\Database\Support\CascadeSoftDeletes;

class Borrowing extends Model
{
    use SoftDeletes, CascadeSoftDeletes;
    
    /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'borrowings';

    protected $cascadeDeletes = ['details'];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'schedule_id',
        'total_price',
        'status',
    ];

    /**
     * Get the detail booking seats for user.
     */
    public function details()
    {
        return $this->hasMany(DetailBorrowing::class);
    }

    /**
     * Get the user that owns the borrowings.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the schedule that owns the borrowings.
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
