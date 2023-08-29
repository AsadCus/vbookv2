<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\BookingRoom;
use App\Models\Participant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ParticipantConfirmController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function present(Request $request)
    {
        // http://127.0.0.1:8000/confirmation/present/?email=fauziagustian68@gmail.com&bookingId=14
        $datenow = Carbon::now();
        $participantDate = \Carbon\Carbon::parse($datenow)->format('Y-m-d H:i:s');
        $email = $request->query('email');
        $bookingId = $request->query('bookingId');

        $bookingRoom = BookingRoom::where('id', $bookingId)->first();

        if (isset($bookingRoom)) {
            $presentUser = Participant::where('email', $email)->where('booking_id', $bookingId)->first();
            if ($bookingRoom->status_booking == 'waiting') {
                $presentUser->participant_confirmation = 2;
                $presentUser->participant_attendance = $participantDate;
                $presentUser->save();


                return view('user.presence.success', [
                    'booking_room' => $bookingRoom,
                ]);
            } else {

                return view('user.presence.block', [
                    'booking_room' => $bookingRoom,
                ]);
            }
        } else {
            return view('user.presence.404', [
                'booking_room' => $bookingRoom,
            ]);
        }
    }

    public function not_present(Request $request)
    {
        $datenow = Carbon::now();
        $participantDate = \Carbon\Carbon::parse($datenow)->format('Y-m-d H:i:s');
        $email = $request->query('email');
        $bookingId = $request->query('bookingId');

        $bookingRoom = BookingRoom::where('id', $bookingId)->first();

        if (isset($bookingRoom)) {
            if ($bookingRoom->status_booking == 'waiting') {
                $presentUser = Participant::where('email', $email)->where('booking_id', $bookingId)->first();
                $presentUser->participant_confirmation = 3;
                $presentUser->participant_attendance = $participantDate;
                $presentUser->save();


                return view('user.presence.cancel', [
                    'booking_room' => $bookingRoom,
                ]);
            } else {

                return view('user.presence.block', [
                    'booking_room' => $bookingRoom,
                ]);
            }
        } else {
            return view('user.presence.404', [
                'booking_room' => $bookingRoom,
            ]);
        }
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
