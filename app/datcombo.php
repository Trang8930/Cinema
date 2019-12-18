<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class datcombo extends Model
{
    protected $table='datcombo';
    public $timestamps=true;
    
    public function combo() {
        return $this->belongsTo('App\combo', 'id_combo', 'id');
    }
}
