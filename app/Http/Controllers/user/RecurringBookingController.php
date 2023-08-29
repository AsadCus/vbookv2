<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessBookingRecurrence;
use Illuminate\Http\Request;
use App\Jobs\SendMailJob;
use App\Models\BookingRoom;
use App\Models\Division;
use App\Models\FailedBookingRecurrence;
use App\Models\Participant;
use App\Models\RecurrenceBooking;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Google\Service\SecurityCommandCenter\Process;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RecurringBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $companyId = Auth::user()->company_id;
        $emailUser = Auth::user()->email;
        $userId = Auth::user()->id;
        $recurrence =  RecurrenceBooking::with(['room', 'division'])->where('company_id', $companyId)->where('user_id', $userId)->get();
        // return $recurrence;
        return view('user.recurrence.index', [
            'recurrence' => $recurrence
        ]);
    }

    public function search(Request $request)
    {

        $companyId = Auth::user()->company_id;
        $userId = Auth::user()->id;
        $divisionId = Auth::user()->division_id;


        $roomRestrict =  Room::whereHas('roomRestrict', function ($q) use ($divisionId) {
            $q->where('division_id', $divisionId);
        })->with(['roomRestrict'])->where('company_id', $companyId)->get();



        // if ($getRoomDivision !== null) {
        //     $checkRestric = User::where('id', $userId)->whereIn('division_id', $getRoomDivision)->get();
        // }

        // return $myEvents;

        $req_search = $request->query('search');
        $projector = $request->query('projector');
        $internet = $request->query('internet');
        $capacity = $request->query('capacity');

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
        return view('user.recurrence.search-recurring', [
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
    public function create($id)
    {
        $recurrences = [
            'daily'     => [
                'times'     => 365,
                'function'  => 'addDay'
            ],
            'weekly'    => [
                'times'     => 52,
                'function'  => 'addWeek'
            ],
            'monthly'    => [
                'times'     => 12,
                'function'  => 'addMonth'
            ]
        ];

        // return response()->json([
        //     'data' => $recurrences['daily']
        // ]);
        $users = User::where('role_id', '3')->get();
        $rooms = Room::where('id', $id)->first();
        $emailOrganizer = Auth::user()->email;
        $companyId = Auth::user()->company_id;

        $division = Division::where('company_id', $companyId)->get();
        // return $user;
        return view('user.recurrence.recurring', [
            'rooms' => $rooms,
            'users' => $users,
            'emailOrganizer' => $emailOrganizer,
            'division' => $division,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $now = \Carbon\Carbon::now();

        $validator = Validator::make($request->all(), [
            'start_date'           => 'required|after:' . now(),
            'end_date'             => 'required|after:start_date',
        ], [
            'start_date.after' => "Tanggal Akhir Tidak boleh kurang dari waktu saat ini atau tanggal awal"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Tanggal Akhir Tidak boleh kurang dari waktu saat ini atau tanggal awal',
                'errors' => [],
                'status' => true,
                'code' => 400,
            ], 400);
        }

        $requestRoomId = $request->room_id;

        $startDateTime = \Carbon\Carbon::parse($request->start_date)->format('Y-m-d H:i:s');
        $endDateTime   = \Carbon\Carbon::parse($request->end_date)->format('Y-m-d H:i:s');


        $isBooked = BookingRoom::with('user')->where('room_id', $requestRoomId)
            ->whereNot('status_booking', 'cancel')
            ->where('start_date', '<=', $endDateTime)
            ->where('end_date', '>=', $startDateTime)
            ->orderBy('created_at', 'desc')->first();




        if (isset($isBooked)) {
            $failedRecurrenceBooking = new FailedBookingRecurrence();
            $failedRecurrenceBooking->user_id = Auth::user()->id;
            $failedRecurrenceBooking->company_id = Auth::user()->company_id;
            $failedRecurrenceBooking->title = $isBooked->title;
            $failedRecurrenceBooking->room_id = $isBooked->room_id;
            $failedRecurrenceBooking->start_date =  $isBooked->start_date;
            $failedRecurrenceBooking->end_date =  $isBooked->end_date;
            $failedRecurrenceBooking->save();

            return response()->json([
                'success' => false,
                'message' => 'Room sudah di booking silahkan ganti waktu yang sesuai , Room dengan waktu yang sama,                   ' .  '🎫 :' . $isBooked->title . ', ' . '📅: ' . $isBooked->start_date,

            ], 500);
        } else {

            try {
                $recurrences = [
                    'daily'     => [
                        'times'     => 365,
                        'function'  => 'addDay'
                    ],
                    'weekly'    => [
                        'times'     => 52,
                        'function'  => 'addWeek'
                    ],
                    'monthly'    => [
                        'times'     => 12,
                        'function'  => 'addMonth'
                    ]
                ];


                $startTime = Carbon::parse($request->start_date);
                $endTime = Carbon::parse($request->end_date);
                // $rec = $request->recurrence;
                $recurrence = $recurrences[$request->recurrence] ?? null;
                // return response()->json([
                //     'data' => $recurrence
                // ]);

                DB::beginTransaction();
                $newRecurrenceBooking = new RecurrenceBooking();
                $newRecurrenceBooking->title = $request->title;
                $newRecurrenceBooking->division_id = $request->department;
                $newRecurrenceBooking->user_id = Auth::user()->id;
                $newRecurrenceBooking->company_id = Auth::user()->company_id;
                $newRecurrenceBooking->room_id = $request->room_id;
                $newRecurrenceBooking->recurrence = $request->recurrence;
                $newRecurrenceBooking->start_date =  $request->start_date;
                $newRecurrenceBooking->end_date =  $request->end_date;
                $newRecurrenceBooking->save();

                for ($i = 0; $i < $recurrence['times']; $i++) {
                    $startTime->{$recurrence['function']}();
                    $endTime->{$recurrence['function']}();


                    $newBooking = new BookingRoom();
                    $newBooking->title = $request->title;
                    $newBooking->user_id = Auth::user()->id;
                    $newBooking->company_id = Auth::user()->company_id;
                    $newBooking->room_id = $request->room_id;
                    $newBooking->department = $request->department;
                    $newBooking->status = 1;
                    $newBooking->status_booking = 'waiting';
                    $newBooking->reminder = 'not';
                    $newBooking->reload = 1;
                    $newBooking->recurrence = $request->recurrence;
                    $newBooking->recurrence_booking_id = $newRecurrenceBooking->id;

                    $roomChek = $request->room_id;
                    $startChek = $request->start_date;
                    $newBooking->date = $request->start_date;
                    $newBooking->remainder_at = $request->remainder_at;


                    $bookingCheck = BookingRoom::where('room_id', $roomChek)->where('start_date', $startChek)->first();
                    if ($bookingCheck) {
                        // throw new Error('Maaf Email sudah pernah mengisi POST TEST');
                        return response()->json([
                            'message' => 'Maaf Ruang dengan waktu Booking Di input Sudah di booking',
                            'errors' => [],
                            'status' => true,
                            'code' => 400,
                        ], 400);
                    } else {
                        $newBooking->start_date = $startTime;
                        $newBooking->end_date = $endTime;
                    }
                    $newBooking->save();

                    // ================== queue participant ====================

                    $getEmailListst =  $request->participant;
                    $mailing = collect($getEmailListst)->map(function ($mailList) {
                        return $mailList['email'];
                    });
                    foreach ($mailing as $getEmail) {
                        $dataParticipant = ([
                            'booking_id' => $newBooking->id,
                            'email' => $getEmail,
                            'status_booking' => $request->department,
                            'recurrence_booking_id' => $newRecurrenceBooking->id,
                        ]);


                        $this->dispatch(new ProcessBookingRecurrence($dataParticipant));
                    }
                }



                $roomId = $request->room_id;
                $getRoom = Room::where('id', $roomId)->first();
                $bookingId = $newBooking->id;
                $Link = env('APP_URL') . '/' . 'participants-attended' . '/' . $bookingId . '/' . 'presence';
                $QrCode = QrCode::size(200)->generate($Link);

                $data = ([
                    'title' => $request->title,
                    'room' => $getRoom->name,
                    'department' => $request->department,
                    'qrcode' => $QrCode,
                    'link' => $Link,
                    'date' => Carbon::parse($request->start_date)->format('Y-m-d'),
                    'time' => Carbon::parse($request->start_date)->format('H:i'),
                    'organizer' => Auth::user()->name,

                ]);


                $getEmailList =  $request->participant;
                $mail = collect($getEmailList)->map(function ($mailList) {
                    return $mailList['email'];
                });

                foreach ($mail as $emailList) {
                    // $newParticipan = new Participant();
                    // $newParticipan->booking_id =  $newBooking->id;
                    // $newParticipan->email =  $emailList;
                    // $newParticipan->status_booking = 'waiting';
                    // $newParticipan->recurrence_booking_id = $newRecurrenceBooking->id;
                    // $newParticipan->save();

                    // $emailOrganizer = Auth::user()->email;
                    dispatch(new SendMailJob($data, $emailList));
                }




                DB::commit();
                return response()->json([
                    'message' => 'Data has been saved',
                    'code' => 200,
                    'error' => false,
                ]);
            } catch (\Throwable $e) {
                DB::rollBack();
                return response()->json([
                    'message' => $e->getMessage(),
                    'line' => $e->getLine(),
                ], 500);
            }
        }
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
        $recurence = RecurrenceBooking::find($id);
        $booking = BookingRoom::where('recurrence_booking_id', $id);
        try {
            $recurence->delete();
            $booking->delete();
            return [
                'message' => 'data has been deleted',
                'error' => false,
                'code' => 200,
            ];
        } catch (Exception $e) {
            return [
                'message' => 'internal error',
                'error' => true,
                'code' => 500,
                'errors' => $e,
            ];
        }
    }
}
