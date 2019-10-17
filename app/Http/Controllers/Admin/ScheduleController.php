<?php

namespace App\Http\Controllers\Admin;

use App\Models\Film;
use App\Models\Room;
use App\Models\Cinema;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Requests\Backend\ScheduleRequest;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::with(['room', 'film']);
        $cinemaIDs = [];
        $roomIDs = [];

        if(Auth::user()->id != 1) {
            $cityID = Auth::user()->city_id;
            
            $cinemas = Cinema::select('id', "name")->where("city_id", $cityID)->get();
            foreach ($cinemas as $cinema) {
                array_push($cinemaIDs, $cinema->id);
            }
            
            $rooms = Room::whereIn("cinema_id", $cinemaIDs)->get();
            foreach ($rooms as $room) {
                array_push($roomIDs, $room->id);
            }

            $schedules = $schedules->whereIn("room_id", $roomIDs);
        }

        $schedules = $schedules->get();

        return view("backend.schedules.index", ['schedules' => $schedules]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cinemas = Cinema::get();
        $films = Film::orderBy('id', 'DESC')->get();
        $image = Film::orderBy('id', 'DESC')->first()->image;
        $rooms = Room::where("cinema_id", $cinemas->first()->id)->get();
        $timeLimit = Film::select('time_limit')->first();
        return view("backend.schedules.create", compact(['films', 'rooms', 'timeLimit', 'image', "cinemas"]));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Backend\ScheduleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleRequest $request)
    {
        try{
            $result = Schedule::create([
                'room_id' => $request->room_id,
                'film_id' => $request->film_id,
                'time_start' => $request->time_start,
                'time_finish' => $request->time_finish,
                'date' => $request->date
                ]);
            if ($result) {
                $check = 1;
                return redirect()->route('schedules.index', compact('check'));
            }
        } catch (QueryException $e) {
            $check = 0;
            return redirect()->route('schedules.create', compact('check'));
        } catch (\Exception $e) {
            $check = 0;
            return redirect()->route('schedules.create', compact('check'));
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
        $films = Film::orderBy('id', 'DESC')->get();
        $rooms = Room::get();
        $schedule = Schedule::findOrFail($id);
        return view("backend.schedules.update", compact(['films', 'rooms', 'schedule']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\Backend\ScheduleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleRequest $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        if ($request->time_finish == null) {
            $request->time_finish = $schedule->time_finish;
        }
        $result = $schedule->update([
            'room_id' => $request->room_id,
            'film_id' => $request->film_id,
            'date' => $request->date,
            'time_start' => $request->time_start,
            'time_finish' => $request->time_finish
        ]);

        if ($result) {
            $check = 1;
            return redirect()->route('schedules.index', compact('check'));
        } else {
            $check = 0;
            return redirect()->route('schedules.index', compact('check'));
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
        try {
            Schedule::findOrFail($id)->delete();
            $check = 3;
            return redirect()->route('schedules.index', compact('check'));
        } catch (QueryException $e) {
            $check = 0;
            return redirect()->route('schedules.index', compact('check'));
        } catch (\Exception $e) {
            $check = 0;
            return redirect()->route('schedules.index', compact('check'));
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string  $date
     * @param  int  $roomId
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateSchedule($date, $roomId)
    {
        $schedules = Schedule::where('date', $date)
            ->where('room_id', $roomId)->orderBy('time_start', 'ASC')->get();
        if(request()->ajax()) {
            return response()->json($schedules);
        }
    }
}
