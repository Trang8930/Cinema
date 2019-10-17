<?php

namespace App\Http\Controllers\User;

use App\Models\Film;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilmFEController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Film::select("video_url", "image", "name", "id")->orderBy("is_active", "DESC")
            ->orderBy("updated_at", "ASC")->paginate(8);
        return view("frontend.videos.index", ['videos' => $videos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $film = Film::findOrFail($id);
        $arrKind = explode(",",$film->kind);
        
        $comments = Comment::where("film_id", $id)->orderBy("id", "DESC")->with("user")->paginate(4);
        
        $films = Film::select("films.*", \DB::raw("count(comments.film_id) as cmt_count"))
                ->leftjoin("comments", "film_id", "=", "films.id")
                ->groupBy("films.id")
                ->orderBy("cmt_count", "DESC")->limit(5)->get();

        $filmsNew = Film::where("is_active", 0)->orderBy("id", "DESC")->limit(4)->get();

        return view("frontend.details.index", ["film" => $film, "comments" =>$comments, 'kinds' => $arrKind, 'films' => $films, 'filmsNew' => $filmsNew]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
