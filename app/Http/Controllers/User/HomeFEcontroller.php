<?php

namespace App\Http\Controllers\User;

use App\Models\Film;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeFEcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $films = Film::where("is_active", 1)->orderBy("id", "DESC")->limit(6)->get();
        $filmsNew = Film::where("is_active", 0)->orderBy("id", "ASC")->limit(4)->get();
        $news = Film::where("is_active", 0)->orderBy("id", "ASC")->limit(2)->get();
        return view("frontend.home.index", ['films' => $films, 'filmsNew' => $filmsNew, 'news' => $news]);
    }
}
