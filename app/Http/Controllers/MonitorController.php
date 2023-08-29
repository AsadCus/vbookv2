<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Room;
use App\Models\Company;
use App\Models\BookingRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitorController extends Controller
{
    public function __construct(Room $room, BookingRoom $bookingroom, Company $company) {
        $this->room = $room;
        $this->bookingroom = $bookingroom;
        $this->company = $company;
    }

    public function index(){
        $companyId = Auth::user()->company_id;
        $company = $this->company->where('id', $companyId)->first();
        $monitor = $this->room->with('bookingRoom')->where('company_id', $companyId)
        // ->whereHas('bookingRoom', function($query) {
        //     $query->whereDate('start_date', '=', \Carbon\Carbon::today()->toDateString());
        // })
        ->get();
        return view('admin.monitor.index', [
            'monitor' => $monitor,
            'company' => $company,
        ]);
    }

    public function cardInfo(){
        $companyId = Auth::user()->company_id;
        $company = $this->company->where('id', $companyId)->first();
        $monitor = $this->room->with('bookingRoom')->where('company_id', $companyId)
        // ->whereHas('bookingRoom', function($query) {
        //     $query->whereDate('start_date', '=', \Carbon\Carbon::today()->toDateString());
        // })
        ->get();
        return view('admin.monitor.card', [
            'monitor' => $monitor,
            'company' => $company,
        ]);
    }
}