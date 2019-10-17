<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\Room;
use App\Models\Seat;
use App\Models\Cinema;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Requests\Backend\RoomRequest;
use App\Http\Requests\Backend\UpdateRoomRequest;

class RoomController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::orderBy('id', 'DESC');
        $cinemaIDs = [];
        if(Auth::user()->id != 1) {
            $cityID = Auth::user()->city_id;
            $cinemas = Cinema::select('id')->where("city_id", $cityID)->get();
            
            foreach ($cinemas as $cinema) {
                array_push($cinemaIDs, $cinema->id);
            }
            $rooms = $rooms->whereIn("cinema_id", $cinemaIDs);
        }
        $rooms = $rooms->get();
        $arrAmount = [];
        foreach($rooms as $room) {
            $count = Seat::where("room_id", $room->id)->count();
            $arrAmount[$room->name] = $count;
        }
        return view('backend.rooms.index', compact("rooms", "arrAmount"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.rooms.create', ['cities' => City::get(), 'cinemas' => Cinema::get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Backend\RoomRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request)
    {
        \DB::beginTransaction();
        try {
            $result = Room::create([
                'name' => $request->name,
                'cinema_id' => $request->cinema_id
            ]);
            if ($result) {
                $room_id = Room::select('id')->orderBy('id', 'DESC')->first()->id;

                for ($i = 1; $i <= intval($request->seats_amount); $i++) {
                    $name = chr(64+$i);
                    for ($j = 1; $j <= $request->$name; $j++) {
                        $seatResult = Seat::create([
                            "room_id" => $room_id,
                            "x_seats" => $j,
                            "y_seats" => chr(64+$i),
                            "status" => 1
                        ]);
                    }
                }
                $room = Room::findOrFail($room_id);

                $room->update([
                    "seats_available" => Seat::where("room_id", $room_id)->count()
                ]);
                $check = 1;
                \DB::commit();
                return redirect()->route('rooms.index', compact('check'));
            } else {
                \DB::rollBack();
                $check = 0;
                return redirect()->route('rooms.create', compact('check'));
            }
        } catch (QueryException $e) {
            \DB::rollBack();
            $check = 0;
            return redirect()->route('rooms.create', compact('check'));
        } catch (Exception $e) {
            \DB::rollBack();
            $check = 0;
            return redirect()->route('rooms.create', compact('check'));
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
            $result = Room::findOrFail($id)->delete();
            if ($result) {
                \DB::commit();
                $check = 3;
                return redirect()->route('rooms.index', compact('check'));
            } else {
                \DB::rollBack();
                $check = 0;
                return redirect()->route('rooms.index', compact('check'));
            }
        } catch (QueryException $e) {
            \DB::rollBack();
            $check = 0;
            return redirect()->route('rooms.index', compact('check'));
        } catch (Exception $e) {
            \DB::rollBack();
            $check = 0;
            return redirect()->route('rooms.index', compact('check'));
        }
    }

    /**
     * Show the form for editing a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room =Room::findOrFail($id);
        //get distict all y_seats into room
        $ySeats = Seat::select('y_seats')->distinct()->where('room_id', $room->id)->get();
        $ySeats = $ySeats->toArray();

        // get x_seats of each y_seats 
        $arrSeats = [];
        for($i = 0; $i < count($ySeats); $i++) {
            $xSeat = Seat::where("y_seats", $ySeats[$i]["y_seats"])->where("room_id", $room->id)->count();
            $arrSeats[$ySeats[$i]["y_seats"]] = $xSeat;
        }
        $cinemas = Cinema::get();
        $cityName = City::where('id', Cinema::findOrFail($room->cinema_id)->city_id)->get()->toArray()[0]["name"];
        return view('backend.rooms.update', compact("room", "arrSeats", "cityName", "cinemas"));
    }

    /**
     * Store a newly updated resource in storage.
     *
     * @param  App\Http\Requests\Backend\UpdateRoomRequest  $request
     * @param App\Models\Room $id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomRequest $request, $id)
    {
        \DB::beginTransaction();
        try {
            $room = Room::findOrFail($id);
            $result = $room->update([
                'name' => $request->name,
                'cinema_id' => $request->cinema_id
            ]);
            if ($result) {
                Seat::where("room_id", $id)->delete();
                for ($i = 1; $i <= intval($request->seats_amount); $i++) {
                    $name = chr(64+$i);
                    for ($j = 1; $j <= $request->$name; $j++) {
                        $seatResult = Seat::create([
                            "room_id" => $id,
                            "x_seats" => $j,
                            "y_seats" => $name,
                            "status" => 1
                        ]);
                    }
                }

                $room->update([
                    "seats_available" => Seat::where("room_id", $id)->count()
                ]);
                $check = 2;
                \DB::commit();
                return redirect()->route('rooms.index', compact('check'));
            } else {
                \DB::rollBack();
                $check = 0;
                return redirect()->route('rooms.create', compact('check'));
            }
        } catch (QueryException $e) {
            \DB::rollBack();
            $check = 0;
            return redirect()->route('rooms.create', compact('check'));
        } catch (Exception $e) {
            \DB::rollBack();
            $check = 0;
            return redirect()->route('rooms.create', compact('check'));
        }
    }

    /**
     * Store a newly updated resource in storage.
     *
     * @param App\Models\Cinema $id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function listRoomByCinemaID($cinemaID)
    {
        if(request()->ajax()) {
            return response()->json(['rooms' => Room::where('cinema_id', $cinemaID)->get()],200);
        }
    }
}
