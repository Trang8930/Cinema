<?php

namespace App\Models;

use App\Models\Seat;
use App\Models\Borrowing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailBorrowing extends Model
{
    use SoftDeletes;
    /**
     * Declare table
     *
     * @var string $tabel table name
     */
    protected $table = 'detail_booking_films';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'borrowing_id',
        'seat_id',
        'price',
        'is_finish'        
    ];

   /**
     * Get the film that owns the details.
     */
    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class);
    }

    /**
     * Get the seat that owns the details.
     */
    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
}
