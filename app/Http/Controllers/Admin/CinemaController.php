<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Cinema;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Requests\Backend\CreateCinemaRequest;

class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cinemas = Cinema::orderBy('id', 'DESC')->with('city');
        if(Auth::user()->id != 1) {
            $cityID = Auth::user()->city_id;
            $cinemas->where("city_id", $cityID);
        }

        $cinemas = $cinemas->get();
        return view('backend.cinemas.index', ['cinemas' => $cinemas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.cinemas.create', ['cities' => City::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Backend\CreateCinemaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCinemaRequest $request)
    {
        try {
            $result = Cinema::create([
                'name' => $request->name,
                'city_id' => $request->city_id
            ]);
            if ($result) {
                $check = 1;
                return redirect()->route('cinemas.index', compact('check'));
            }

            $check = 0;
            return redirect()->route('cinemas.create', compact('check'));
        } catch (QueryException $e) {
            $check = 0;
            return redirect()->route('cinemas.create', compact('check'));
        } catch (\Exception $e) {
            $check = 0;
            return redirect()->route('cinemas.create', compact('check'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cinema = Cinema::findOrFail($id);
        return view('backend.cinemas.update', ['cinema' => $cinema, 'cities' => City::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Backend\CreateCinemaRequest  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCinemaRequest $request, $id)
    {
        try {
            $cinema = Cinema::findOrFail($id);
            $result = $cinema->update([
                'name' => $request->name,
                'city_id' => $request->city_id
            ]);
            if ($result) {
                $check = 2;
                return redirect()->route('cinemas.index', compact('check'));
            } else {
                $check = 0;
                return redirect()->route('cinemas.update', compact('check'));    
            }
        } catch (QueryException $e) {
            $check = 0;
            return redirect()->route('cinemas.update', compact('check'));
        } catch (\Exception $e) {
            $check = 0;
            return redirect()->route('cinemas.update', compact('check'));
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
        \DB::beginTransaction();
        try {
            $cinema = Cinema::findOrFail($id);
            $result = $cinema->delete();
            \DB::commit();
            $check = 3;
            return redirect()->route('cinemas.index', compact('check'));
        } catch (QueryException $e) {
            \DB::rollBack();
            $check = 0;
            return redirect()->route('cinemas.index', compact('check'));
        } catch (\Exception $e) {
            \DB::rollBack();
            $check = 0;
            return redirect()->route('cinemas.index', compact('check'));
        }
    }

    /**
     * Show list cinemas follow city.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getListCinemabyCityId($cityId)
    {
        if(request()->ajax()) {
            return response()->json(['cinemas' => Cinema::where('city_id', $cityId)->get()],200);
        }
    }
}
