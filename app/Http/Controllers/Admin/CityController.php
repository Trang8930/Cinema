<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CreateCityRequest;
use Illuminate\Database\QueryException;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.cities.index', ['cities' => City::orderBy('id', 'DESC')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Backend\CreateCityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCityRequest $request)
    {
        $result = City::create($request->all());
        if ($result) {
            $check = 1;
            return redirect()->route('cities.index', compact('check'));
        } else {
            $check = 0;
            return redirect()->route('cities.index', compact('check'));
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
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Backend\CreateCityRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCityRequest $request, $id)
    {
        $result = City::findOrFail($id)->update(['name' => $request->name]);
        if ($result) {
            return response()->json('200');
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
            City::findOrFail($id)->delete();
            \DB::commit();
            $check = 3;
            return redirect()->route('cities.index', compact('check'));
        } catch (QueryException $e) {
            \DB::rollBack();
            $check = 0;
            return redirect()->route('cities.index', compact('check'));
        } catch (\Exception $e) {
            \DB::rollBack();
            $check = 0;
            return redirect()->route('cities.index', compact('check'));
        } 
    }
}
