<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\BookingRoom;
use App\Models\Company;
use App\Models\RecurrenceBooking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // if ($request->ajax()) {
        //     $data = BookingRoom::whereDate('start_date', '>=', $request->start)
        //         ->whereDate('end_date',   '<=', $request->end)
        //         ->get(['id', 'title', 'start_date', 'end_date']);
        //     return response()->json($data);
        // }
        $companyId = Auth::user()->company_id;
        $emailUser = Auth::user()->email;
        $userId = Auth::user()->id;
        $events = array();

        $recurrenceBooking = RecurrenceBooking::where('user_id', $userId)->first();
        // return $recurrenceBooking;

        // $bookings = BookingRoom::with('room')->where('user_id', $userId)->whereNot('status_booking', 'finished')->get();
        // $myEvents = BookingRoom::with('room')->where('user_id', $userId)->whereNot('status_booking', 'finished')->get();

        // $myEvents =  BookingRoom::whereHas('participant', function ($q) use ($emailUser) {
        //     $q->where('email', $emailUser);
        // })->with(['room', 'participant'])->whereNot('status_booking', 'finished')->where('company_id', $companyId)->get();
        // $bookings =  BookingRoom::whereHas('participant', function ($q) use ($emailUser) {
        //     $q->where('email', $emailUser);
        // })->with(['room', 'participant', 'recurrence'])->where('company_id', $companyId)->get();


        $myEvents =  BookingRoom::whereHas('participant', function ($q) use ($emailUser) {
            $q->where('email', $emailUser);
        })->with(['room', 'participant'])->whereNot('status_booking', 'finished')->whereNot('status_booking', 'cancel')->where('company_id', $companyId)->get();

        // $bookings =  BookingRoom::with(['room', 'participant', 'recurrence'])->where('company_id', $companyId)->get();

        $bookings =  BookingRoom::whereHas('participant', function ($q) use ($emailUser) {
            $q->where('email', $emailUser);
        })->with(['room', 'participant', 'recurrence'])->whereNot('status_booking', 'cancel')->where('company_id', $companyId)->get();

        // return $bookings;
        // $bookings = BookingRoom::with('room', 'participant')->where('user_id', $userId)->get();



        // $bookingAdmin = BookingRoom::with('room')->whereNot('status_booking', 'finished')->get();
        $bookingAdmin = BookingRoom::with('room')->whereNot('status_booking', 'cancel')->where('company_id', $companyId)->get();
        // $myEventsAdmin = BookingRoom::with('room')->whereNot('status_booking', 'finished')->get();
        $myEventsAdmin =  BookingRoom::whereHas('participant', function ($q) use ($emailUser) {
            $q->where('email', $emailUser);
        })
        ->with(['room', 'participant'])->whereNot('status_booking', 'finished')->whereNot('status_booking', 'cancel')->where('company_id', $companyId)->get();



        // $myEvents2 =  BookingRoom::whereHas('participant', function ($q) use ($emailUser) {
        //     $q->where('email', $emailUser);
        // })->with(['room', 'participant'])->whereNot('status_booking', 'finished')->get();
        // return $myEvents2;


        // $bookings = BookingRoom::all();

        if ($userId == 2) {

            foreach ($bookingAdmin as $bookingAdmins) {
                $color = "#32a852";
                $bdcolor = "#ff034a";


                $events[] = [
                    'id'   => $bookingAdmins->id,
                    'title' => $bookingAdmins->title,
                    'start' => $bookingAdmins->start_date,
                    'end' => $bookingAdmins->end_date,
                    'color' => $bookingAdmins->room->color_code ?? '#32a852',
                    'borderColor'    => $bdcolor
                ];
            }
            $rooms = Room::where('company_id', $companyId)->get();
            return view('user.dashboard.booking-room', [
                'rooms' => $rooms,
                'events' => $events,
                'bookings' => $bookingAdmin,
                'myEvents' => $myEventsAdmin,
            ]);
        } else {
            foreach ($bookings as $booking) {
                $color = "#32a852";
                $bdcolor = "#ff034a";


                $events[] = [
                    'id'   => $booking->id,
                    'title' => $booking->title,
                    'start' => $booking->start_date,
                    'end' => $booking->end_date,
                    'color' => $booking->room->color_code ?? '#32a852',
                    'borderColor'    => $bdcolor
                ];
            }
            $rooms = Room::where('company_id', $companyId)->get();
            return view('user.dashboard.booking-room', [
                'rooms' => $rooms,
                'events' => $events,
                'bookings' => $bookings,
                'myEvents' => $myEvents,
            ]);
        }
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

    public function guestAccess(Request $request)
    {
        $userId = Auth::user()->id;
        $guestAccess = $request->guest_access;
        $checkKeyAccess = Company::where('guest_access', $guestAccess)->first();


        if ($checkKeyAccess != null) {
            $companyId = $checkKeyAccess->id;
            $updateCompany = User::find($userId);
            $updateCompany->company_id = $companyId;
            $updateCompany->save();
        } else {
            return response()->json([
                'message' => 'invalid access code',
                'code' => 500,
                'error' => true,
            ], 500);
        }
    }



    public function profile()
    {

        return view('user.profile.index');
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

    public function logout()
    {
        Cache::flush();
        Auth::logout();
        return redirect('/login');
    }
}
