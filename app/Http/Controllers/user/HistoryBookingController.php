<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\BookingRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companyId = Auth::user()->company_id;
        $emailUser = Auth::user()->email;
        $userId = Auth::user()->id;
        $start_date = $request->query('start_date');
        $end_date = $request->query('end_date');

        if ($start_date !== null && $end_date !== null) {
            $booking =  BookingRoom::with(['room', 'participant', 'recurrence'])->whereIn('date', [$start_date, $end_date])->where('company_id', $companyId)->orderBy('created_at', 'DESC')->get();
        } else if ($start_date !== null) {
            $booking =  BookingRoom::with(['room', 'participant', 'recurrence'])->where('date', $start_date)->where('company_id', $companyId)->orderBy('created_at', 'DESC')->get();
        } else if ($end_date !== null) {
            $booking =  BookingRoom::with(['room', 'participant', 'recurrence'])->where('date', $end_date)->where('company_id', $companyId)->orderBy('created_at', 'DESC')->get();
        } else {
            $booking =  BookingRoom::with(['room', 'participant', 'recurrence'])->where('company_id', $companyId)->where('user_id', $userId)->orderBy('created_at', 'DESC')->get();
        }


        return view('user.history.index', [
            'booking' => $booking,
            'start_date' => $start_date,
            'end_date' => $end_date
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
        $bookingEvent = BookingRoom::with('participant')->find($id);
        // return $bookingEvent;
        return view('user.history.detail', [
            'bookingEvent' => $bookingEvent,
        ]);
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
