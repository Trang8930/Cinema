<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class datve extends Model
{
    protected $table='datve';
    public $timestamps=true;
    public function lichchieu()
    {
    	return $this->belongsTo('App\lichchieu','id_lichchieu','id');
    }
    public function user()
    {
    	return $this->belongsTo('App\User','id_user','id');
    }
}
