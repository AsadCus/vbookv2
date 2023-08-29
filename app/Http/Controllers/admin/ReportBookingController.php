<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BookingRoom;
use Illuminate\Http\Request;

use App\Exports\Booking;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class ReportBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $room = $request->query('room');
        $status = $request->query('status');
        $start_date = $request->query('start_date');

        $companyId = Auth::user()->company_id;
        $bookingQuery = BookingRoom::with(['participant', 'user', 'room'])->where('company_id', $companyId);


        if ($room !== null) {
            $bookingQuery->whereHas('room', function ($q) use ($room) {
                return $q->where('id', $room);
            })->get();
        }

        if ($status !== null) {
            $bookingQuery->where('status_booking', $status);
        }

        if ($start_date !== null) {
            $bookingQuery->where('date', $start_date);
        }
        $bookingRoom = $bookingQuery->orderBy('id', 'DESC')->where('company_id', $companyId)->get();

        $roomSelect = Room::where('company_id', $companyId)->get();

        // $bookingRoom = BookingRoom::with('participant', 'user', 'room')->get();
        // return $bookingRoom;
        return view('admin.report-booking.index', [
            'booking_rooms' => $bookingRoom,
            'room' => $room,
            'status' => $status,
            'start_date' => $start_date,
            'roomSelect' => $roomSelect,
        ]);
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



    public function export_excel(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        return Excel::download(new Booking($request), 'Report-Booking.xlsx');
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
