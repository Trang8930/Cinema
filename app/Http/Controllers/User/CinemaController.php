<?php

namespace App\Http\Controllers\User;

use App\Models\Cinema;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CinemaController extends Controller
{
    /**
     * Show the cities that have cinemas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $idCity = request()->input('id_city');
        if (request()->ajax()) {
            return response()->json(["cinemas" => Cinema::select("cinemas.id", "cinemas.name")->where("cinemas.city_id", $idCity)->get()]);
        }
    }
}
