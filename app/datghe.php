<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class datghe extends Model
{
    protected $table='datghe';
    public $timestamps=true;
    public function datve()
    {
    	return $this->belongsTo('App\datve','id_datve','id');
    }
    public function ghe()
    {
    	return $this->belongsTo('App\ghe','id_ghe','id');
    }
     public function lichchieu()
    {
    	return $this->belongsTo('App\lichchieu','id_lichchieu','id');
    }
}
