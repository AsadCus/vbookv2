<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BookingRoom;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        $companyId = Auth::user()->company_id;
        $countUser = User::where('role_id', 3)->where('company_id', $companyId)->count();
        $countRoom = Room::where('company_id', $companyId)->count();
        $userActivity = User::where('role_id', 4)->where('company_id', $companyId)->orderBy('last_seen', 'DESC')->get();
        $latestBooking = BookingRoom::with('room', 'user')->orderBy('created_at', 'DESC')->whereNot('status_booking', 'cancel')->whereNot('status_booking', 'finished')->where('company_id', $companyId)->get()->take(6);
        // return $latestBooking;
        return view('admin.dashboard.index', [
            'count_user' => $countUser,
            'count_room' => $countRoom,
            'user_activity' => $userActivity,
            'latest_booking' => $latestBooking,
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
