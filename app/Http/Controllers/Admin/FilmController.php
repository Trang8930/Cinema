<?php

namespace App\Http\Controllers\Admin;

use App\Models\Film;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use Illuminate\Database\QueryException;
use App\Http\Requests\Backend\FilmRequest;
use App\Http\Requests\Backend\ImportFileRequest;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.films.index', ['films' => Film::orderBy('id', 'DESC')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.films.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Backend\FilmRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FilmRequest $request)
    {
        $genre = implode(',', $request->genre);
        $kind = implode(',', $request->kind);
        $fileName = "";
        try {
            if ($request->has('image') && $request->image != null) {
                $image = $request->file('image');
                $fileName = 'img' . '-' . time() . '.' . $image->getClientOriginalExtension();
                $filePath = public_path('fe_images/');
                $request->file('image')->move($filePath, $fileName);
            }

            if ($request->has('video_url')) {
                $videoURL =  $request->video_url;
            }

            $result = Film::create([
                'name' => $request->name,
                'year' => $request->year,
                'price' => $request->price,
                'author' => $request->author,
                'actor' => $request->actor,
                'genre' => $genre,
                'time_limit' => $request->time_limit,
                'kind' => $kind,
                'image' => $fileName,
                'video_url' => $videoURL,
                'avg_rating' => 0.00,
                'total_rating' => 0,
                'content' => $request->content,
                'is_active' => Film::IS_ACTIVE
            ]);
            $check = 1;
            return redirect()->route('films.index', compact('check'));
        } catch (QueryException $e) {
            $check = 0;
            return redirect()->route('films.create', compact('check'));
        } catch (\Exception $e) {
            $check = 0;
            return redirect()->route('films.create', compact('check'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $film = Film::findOrFail($id);
        $genres = explode(',', $film->genre);
        $kinds = explode(',', $film->kind);
        return view('backend.films.update', compact('film', 'genres', 'kinds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Backend\FilmRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FilmRequest $request, $id)
    {
        $genre = implode(',', $request->genre);
        $kind = implode(',', $request->kind);
        $film = Film::findOrFail($id);
        if ($film->image != null) {
            $oldImage = $film->image;
        }
        try {
            if ($request->has('image') && $request->image != null) {
                $image = $request->file('image');
                $fileName = 'img' . '-' . time() . '.' . $image->getClientOriginalExtension();
                $filePath = public_path('fe_images/');
                $request->file('image')->move($filePath, $fileName);
            }

            if ($request->has('video_url')) {
                $videoURL =  $request->video_url;
            }

            $result = $film->update([
                'name' => $request->name,
                'year' => $request->year,
                'price' => $request->price,
                'author' => $request->author,
                'actor' => $request->actor,
                'genre' => $genre,
                'time_limit' => $request->time_limit,
                'kind' => $kind,
                'image' => $fileName,
                'video_url' => $videoURL,
            ]);
            if(\File::exists($film->image) && $result && $oldImage != null && $request->has('image')) {
                $delteImg = public_path() . '/' . $oldImage;
                \File::delete($delteImg);
            }
            $check = 2;
            return redirect()->route('films.index', compact('check'));
        } catch (QueryException $e) {
            $check = 0;
            return redirect()->route('films.index', compact('check'));
        } catch (\Exception $e) {
            $check = 0;
            return redirect()->route('films.index', compact('check'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \DB::beginTransaction();
        try {
            $film = Film::findOrFail($id);
            $image = $film->image;
            $result = $film->delete();
            if(\File::exists($image) && $result) {
                $fileName = public_path() . '/' . $image;
                \File::delete($fileName);
            }
            \DB::commit();
            $check = 3;
            return redirect()->route('films.index', compact('check'));
        } catch (QueryException $e) {
            \DB::rollBack();
            $check = 0;
            return redirect()->route('films.index', compact('check'));
        } catch (\Exception $e) {
            \DB::rollBack();
            $check = 0;
            return redirect()->route('films.index', compact('check'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateActive($id)
    {
        $film = Film::findOrFail($id);
        if ($film->is_active  == Film::NOT_ACTIVE) {
            $film->update([
                'is_active' => Film::IS_ACTIVE
            ]);
        } else {
            $film->update([
                'is_active' => Film::NOT_ACTIVE
            ]);
        }
        
        if (request()->ajax()) {
            return response()->json($film, 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function getData($id)
    {
        $film = Film::select(['image', 'time_limit'])->findOrFail($id);
        if (request()->ajax()) {
            return response()->json($film);
        }
    }

    /**
     * Import file into database Code
     *
     * @var array
     */

    public function importExcel(ImportFileRequest $request)
    {
        if($request->hasFile('import_data')){
            $extension = \File::extension($request->import_data->getClientOriginalName());
            $extensionArr = ["xlsx", "xls", "csv", "txt"];
            if (in_array($extension, $extensionArr)) {
                $path = $request->file('import_data')->getRealPath();
                $data = Excel::load($path, function($reader) {})->get();
                if(!empty($data) && $data->count()){
                    foreach ($data->toArray() as $key => $value) {
                        if(!empty($value)){
                            foreach ($value as $k => $v) {
                                unset($value["stt"]);
                                if (strpos($k, "_") && explode("_", $k)[0] == "x001d") {
                                    $oldKey = $k;
                                    $k = explode("_",$k)[1];
                                    $value[$k] = $value[$oldKey];
                                    unset($value[$oldKey]);
                                }
                            }
                        }
                        $insert[] = $value;
                    }
                    try{
                        for ($i = 0; $i < count($insert); $i++) {
                            Film::create([
                                'name' => $insert[$i]['name'],
                                'year' => $insert[$i]['year'],
                                'price' => $insert[$i]['price'],
                                'author' => $insert[$i]['author'],
                                'actor' => $insert[$i]['actor'],
                                'genre' => $insert[$i]['genre'],
                                'time_limit' => $insert[$i]['time_limit'],
                                'kind' => $insert[$i]['kind'],
                                'image' => $insert[$i]['image'],
                                'video_url' => $insert[$i]['video_url'],
                                'content' => $insert[$i]['content'],
                            ]);
                        }
                        $check = 1;
                        return redirect()->route('films.index', compact('check'));
                    } catch (QueryException $e) {
                        $check = 0;
                        return redirect()->route('films.index', compact('check'));
                    } catch (\Exception $e) {
                        $check = 0;
                        return redirect()->route('films.index', compact('check'));
                    }
                }
            }
        }
        $check = 0;
        return redirect()->route('films.index', compact('check'));
    }
}
