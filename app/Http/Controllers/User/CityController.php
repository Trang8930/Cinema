<?php

namespace App\Http\Controllers\User;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    /**
     * Show the cities that have cinemas.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCityHaveCinema()
    {
        $dateTime = request()->input('dateTime');
        $result = City::select("cities.id","cities.name")->distinct()->join("cinemas", "cities.id", "cinemas.city_id")->where("cities.created_at","<=", $dateTime)->get();
        if ($result) {
            return response()->json(['cities' => $result]);
        }
    }
}
