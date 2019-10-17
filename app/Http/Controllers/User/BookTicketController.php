<?php

namespace App\Http\Controllers\User;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Film;
use App\Models\Room;
use App\Models\Seat;
use App\Models\Schedule;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use App\Models\DetailBorrowing;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\QueryException;
use App\Http\Requests\Frontend\CreateBookingRequest;

class BookTicketController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function booking($id)
    {
        $schedule = Schedule::where("id", $id)->first();
        // $arrKey = [
        //     'A' => 1,
        //     'B' => 2,
        //     'C' => 4,
        //     'D' => 5,
        //     'E' => 6,
        //     'F' => 7,
        //     'G' => 8,
        //     'H' => 9,
        //     'I' => 10,
        // ];
        $seats = Seat::where("room_id", $schedule->room_id)->where("status", 0)->get();
        $arrUnavailable = [];

        foreach($seats as $seat) {
            switch ($seat->y_seats) {
                case "B":
                    $nameSeat = 2 . "_".$seat->x_seats;
                    array_push($arrUnavailable, $nameSeat);
                    break;
                case "C":
                    $nameSeat = 4 . "_".$seat->x_seats;
                    array_push($arrUnavailable, $nameSeat);
                    break;
                case "D":
                    $nameSeat = 5 . "_".$seat->x_seats;
                    array_push($arrUnavailable, $nameSeat);
                    break;
                case "E":
                    $nameSeat = 6 . "_".$seat->x_seats;
                    array_push($arrUnavailable, $nameSeat);
                    break;
                case "F":
                    $nameSeat = 7 . "_".$seat->x_seats;
                    array_push($arrUnavailable, $nameSeat);
                    break;
                case "G":
                    $nameSeat = 8 . "_".$seat->x_seats;
                    array_push($arrUnavailable, $nameSeat);
                    break;
                case "H":
                    $nameSeat = 9 . "_".$seat->x_seats;
                    array_push($arrUnavailable, $nameSeat);
                    break; 
                case "I":
                    $nameSeat = 10 . "_".$seat->x_seats;
                    array_push($arrUnavailable, $nameSeat);
                    break;
                default:
                    $nameSeat = 1 . "_".$seat->x_seats;
                    array_push($arrUnavailable, $nameSeat);
                    break;   
            }
        }
        $arrUnavailable = implode(",",$arrUnavailable);

        $film = Film::where("id", $schedule->film_id)->first();
        return view("frontend.booking.index", ["seatUnavailable" => $arrUnavailable, "film" => $film, "roomID" => $schedule->room_id ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createBooking()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function payment()
    {
        $request = Input::all();
        return view('frontend.booking.payment', ['request' => $request]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function striperCard(Request $request)
    {
        \Stripe\Stripe::setApiKey('sk_test_4Ig2akKoyBCUZX5yF54ym5li');
        try {
            $payment = \Stripe\Charge::create ( array (
                    "amount" => $request->total,
                    "currency" => "vnd",
                    "source" => $request->token, // obtained with Stripe.js
                    "description" => "Booking ticket payment." 
            ) );
            if ($payment) {
                $result = Borrowing::where('id', $request->booking)->update([
                    "status" => 1
                ]);
                if($result) {
                    DetailBorrowing::where('borrowing_id', $request->booking)->update([
                        "is_finish" => 1, 
                    ]);
                    
                    $details = DetailBorrowing::where('borrowing_id', $request->booking)->get();

                    foreach($details as $detail) {
                        Seat::where('id', $detail->seat_id)->update([
                            'status' => 0
                        ]);
                    }
                    $seat = Seat::where('id', $details->first()->seat_id)->first();
                    $count = Seat::where("room_id", $seat->room_id)->where("status", 1)->count();
                    $room = Room::findOrFail($seat->room_id)->update([
                        "seats_available" => $count
                    ]);
                }
            }
            $url = route('homepage');
            return response()->json(['data' => $payment, 'url' => $url]);
        } catch ( \Exception $e ) {
            return response()->json(['code' => 500]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBookingRequest $request)
    {

        $userID = null;
        $total = $request->total;
        if (\Auth::check()) {
            $userID = \Auth::user()->id;
            $request->total = $request->total/60000 * 45000;
        }
        try {
            $booking = Borrowing::create([
                'user_id' => $userID,
                'schedule_id' => $request->schedule_id,
                'total_price' => $request->total,
                'status' => 0,
            ]);
            $roomID = Schedule::select('room_id')->where('id', $request->schedule_id)->first();
            if ($booking) {
                foreach($request->seats as $seat) {
                    $arr = explode("_",$seat);
                    
                    switch ($arr[0]) {
                        case "2":
                            $seatID = Seat::select('id')->where('room_id', $roomID->room_id)
                                ->where('x_seats', $arr[1])->where('y_seats', 'B')->first()->id;
                            DetailBorrowing::create([
                                'borrowing_id' => $booking->id,
                                'seat_id' => $seatID,
                                'price' => $request->price,
                                'is_finish' => 0,
                            ]);
                            break;
                        case "4":
                            $seatID = Seat::select('id')->where('room_id', $roomID->room_id)
                                ->where('x_seats', $arr[1])->where('y_seats', 'C')->first()->id;
                            DetailBorrowing::create([
                                'borrowing_id' => $booking->id,
                                'seat_id' => $seatID,
                                'price' => $request->price,
                                'is_finish' => 0,
                            ]);
                            break;
                        case "5":
                            $seatID = Seat::select('id')->where('room_id', $roomID->room_id)
                                ->where('x_seats', $arr[1])->where('y_seats', 'D')->first()->id;
                            DetailBorrowing::create([
                                'borrowing_id' => $booking->id,
                                'seat_id' => $seatID,
                                'price' => $request->price,
                                'is_finish' => 0,
                            ]);
                            break;  
                        case "6":
                            $seatID = Seat::select('id')->where('room_id', $roomID->room_id)
                                ->where('x_seats', $arr[1])->where('y_seats', 'E')->first()->id;
                            DetailBorrowing::create([
                                'borrowing_id' => $booking->id,
                                'seat_id' => $seatID,
                                'price' => $request->price,
                                'is_finish' => 0,
                            ]);
                            break;
                        case "7":
                            $seatID = Seat::select('id')->where('room_id', $roomID->room_id)
                                ->where('x_seats', $arr[1])->where('y_seats', 'F')->first()->id;
                            DetailBorrowing::create([
                                'borrowing_id' => $booking->id,
                                'seat_id' => $seatID,
                                'price' => $request->price,
                                'is_finish' => 0,
                            ]);
                            break;
                        case "8":
                            $seatID = Seat::select('id')->where('room_id', $roomID->room_id)
                                ->where('x_seats', $arr[1])->where('y_seats', 'G')->first()->id;
                            DetailBorrowing::create([
                                'borrowing_id' => $booking->id,
                                'seat_id' => $seatID,
                                'price' => $request->price,
                                'is_finish' => 0,
                            ]);
                            break;
                        case "9":
                            $seatID = Seat::select('id')->where('room_id', $roomID->room_id)
                                ->where('x_seats', $arr[1])->where('y_seats', 'H')->first()->id;
                            DetailBorrowing::create([
                                'borrowing_id' => $booking->id,
                                'seat_id' => $seatID,
                                'price' => $request->price,
                                'is_finish' => 0,
                            ]);
                            break;
                        case "10":
                            $seatID = Seat::select('id')->where('room_id', $roomID->room_id)
                                ->where('x_seats', $arr[1])->where('y_seats', 'I')->first()->id;
                            DetailBorrowing::create([
                                'borrowing_id' => $booking->id,
                                'seat_id' => $seatID,
                                'price' => $request->price,
                                'is_finish' => 0,
                            ]);
                            break;
                        default:
                            $seatID = Seat::select('id')->where('room_id', $roomID->room_id)
                                ->where('x_seats', $arr[1])->where('y_seats', 'A')->first()->id;
                            DetailBorrowing::create([
                                'borrowing_id' => $booking->id,
                                'seat_id' => $seatID,
                                'price' => $request->price,
                                'is_finish' => 0,
                            ]);
                            break;   
                        }
                    } 
            }
            return response()->json(['code' => 200, 'seats' => implode(", ",$request->seats), 'total' => $request->total, 'booking_id' => $booking->id]);
        } catch (QueryException $e) {
            return response()->json(['code' => 500]);
        } catch (\Exception $e) {
            return response()->json(['code' => 500]);
        }
    }
}
