<?php

namespace App\Http\Controllers\guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SearchBookingGuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companyId = Auth::user()->company_id;
        $userId = Auth::user()->id;
        $roleId = Auth::user()->role_id;
        $divisionId = Auth::user()->division_id;
        $floor = Auth::user()->guest->floor;
        // $floors = User::with('guest')->where('company_id', $companyId)->get();
        // return $floor;



        if ($roleId == 2) {
            $roomRestrict =  Room::where('restrict_room', 'yes')->get();
        } else {
            $roomRestrict =  Room::whereHas('roomRestrict', function ($q) use ($divisionId) {
                $q->where('division_id', $divisionId);
            })->with(['roomRestrict'])->where('company_id', $companyId)->get();
        }



        // if ($getRoomDivision !== null) {
        //     $checkRestric = User::where('id', $userId)->whereIn('division_id', $getRoomDivision)->get();
        // }

        // return $myEvents;

        $req_search = $request->query('search');
        $projector = $request->query('projector');
        $internet = $request->query('internet');
        $capacity = $request->query('capacity');

        // $roomQuery = Room::with(['bookingRoom'])->where('floor', $floor)->where('company_id', $companyId)->whereNull('restrict_room');
        $roomQuery = Room::with(['bookingRoom'])->where('company_id', $companyId)->whereNull('restrict_room');

        if ($req_search !== null) {
            $roomQuery->where('name', 'LIKE', "%{$req_search}%");
        }

        if ($internet !== null) {
            $roomQuery->where('internet', $internet);
        }

        if ($projector !== null) {
            $roomQuery->where('projector', $projector);
        }

        // if ($capacity !== null) {
        //     $roomQuery->where('capacity', '>=', $capacity);
        // }
        if ($capacity !== null) {
            if ($capacity == 10) {
                $roomQuery->whereBetween('capacity', [0, $capacity]);
            }
            if ($capacity == 20) {
                $roomQuery->whereBetween('capacity', [10, $capacity]);
            }
            if ($capacity == 30) {
                $roomQuery->whereBetween('capacity', [20, $capacity]);
            }
            if ($capacity == 50) {
                $roomQuery->whereBetween('capacity', [30, $capacity]);
            }
            if ($capacity == 51) {
                $roomQuery->where('capacity', '>', $capacity);
            }
        }


        $rooms = $roomQuery->orderBy('id', 'DESC')->paginate(6);
        $rooms->withQueryString();
        // return $rooms;

        $currentPage = $rooms->currentPage();
        $currentUrl = "/search?page=" . $currentPage;
        $prevPage = $rooms->previousPageUrl();
        $nextPage = $rooms->nextPageUrl();
        $next2Page = $currentPage + 2;
        $prev2Page = $currentPage - 2;
        $next2Url = "/search?page=" . $next2Page;
        $prev2Url = "/search?page=" . $prev2Page;
        $lastPage = $rooms->lastPage();
        $totalItem = $rooms->total();
        // return $rooms;
        return view('guest.booking.search', [
            'room_restrict' => $roomRestrict,
            'rooms' => $rooms,
            'internet' => $internet,
            'projector' => $projector,
            'capacity' => $capacity,
            'currentPage' => $currentPage,
            'currentUrl' => $currentUrl,
            'prevPage' => $prevPage,
            'nextPage' => $nextPage,
            'next2Page' => $next2Page,
            'prev2Page' => $prev2Page,
            'next2Url' => $next2Url,
            'prev2Url' => $prev2Url,
            'lastPage' => $lastPage,
            'totalItem' => $totalItem,
            'req_search' => $req_search,
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
