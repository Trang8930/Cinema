<?php

namespace App\Http\Controllers\Admin;

use App\Models\Borrowing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Borrowing::where('status', 1);
        $created = null;
        if (!request()->all() == []) {
            $created = request()->created_at;
            $bookings = $bookings->where('created_at', 'like', '%' . request()->created_at . '%');
        }

        $bookings = $bookings->paginate(10);
        $createdAts = Borrowing::select('created_at')->distinct()->where('status', 1)->get();
        $arr = [];
        foreach ($createdAts as $val) {
            // $date = date_create($val);
            $date = date_format($val->created_at, 'Y-m-d');
            if(!in_array($date, $arr)) {
                array_push($arr, $date);
            }
        }
        return view('backend.bookings.index', ['bookings' => $bookings, 'createdAts' => $arr, 'created' => $created]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $bookings = Borrowing::where('status', 1)->where('created_at', 'like', '%' . $request->created . '%')->get();
        $column[] = ['STT', 'Name', 'Total', 'Date'];
        foreach ($bookings as $val) {
            $column[] = [
                'STT' => $val->id,
                'Name' => $val->user ? $val->user->fullname : '',
                'Total' => $val->total_price,
                'Date' => date_format($val->created_at, 'Y-m-d'),
            ];
        }
        Excel::create('Thống kê', function($excel) use ($column){
            $excel->sheet('Thống kê', function($sheet) use ($column){
                $sheet->fromArray($column, null, 'A1', false, false);
               });
        })->export('xlsx');
    }

}
