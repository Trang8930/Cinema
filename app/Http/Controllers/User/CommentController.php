<?php

namespace App\Http\Controllers\User;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\Frontend\CommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $request = Input::all(); 
        $result = Comment::create([
            "user_id" => $request["id_user"],
            "film_id" => $request["id_film"],
            "content" => $request["content"],
        ]);
        $count = Comment::where("film_id", $request["id_film"])->count();
        if ($result) {
            return response()->json(['code' => 200, 'count' => $count]);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommentRequest $request, $id)
    {
        $comment = Comment::findOrFail($id);
        
        if (request()->ajax()) {
            $result = $comment->update([
                "content" => $request->content,
            ]);
            if($result) {
                return response()->json(['code' => 200, 'content' => $request->content]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if (request()->ajax()) {
            $result = $comment->delete();
            if($result) {
                return response()->json(['code' => 200]);
            }
        }
    }
}
