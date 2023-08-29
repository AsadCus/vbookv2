<?php

namespace App\Http\Controllers\guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\SendMailJob;
use App\Models\BookingRoom;
use App\Models\Participant;
use App\Models\Room;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Mail\AddMailToMeeting;
use App\Models\Division;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Concerns\ToArray;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CreateBookingGuestController extends Controller
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
    public function create($id)
    {
        $users = User::where('role_id', '3')->get();
        $rooms = Room::where('id', $id)->first();
        $emailOrganizer = Auth::user()->email;
        $companyId = Auth::user()->company_id;

        $division = Division::where('company_id', $companyId)->get();
        // return $user;
        return view('guest.booking.create', [
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
            'start_date.after' => "Jam Akhir Tidak boleh kurang dari Jam saat ini atau jam awal"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'jam Akhir tidak boleh kurang dari jam saat ini atau jam awal',
                'errors' => [],
                'status' => true,
                'code' => 400,
            ], 400);
        }

        $requestRoomId = $request->room_id;
        $dateNow = Carbon::now()->format('Y-m-d');
        $startTimeNow = \Carbon\Carbon::parse($request->start_date)->format('H:i:s');
        $endTimeNow = \Carbon\Carbon::parse($request->end_date)->format('H:i:s');

        $startDateTime = $dateNow . ' ' . $startTimeNow;
        $endDateTime = $dateNow . ' ' . $endTimeNow;

        // $startDateTime = \Carbon\Carbon::parse($request->start_date)->format('Y-m-d H:i:s');
        // $endDateTime   = \Carbon\Carbon::parse($request->end_date)->format('Y-m-d H:i:s');


        $isBooked = BookingRoom::where('room_id', $requestRoomId)
            ->whereNot('status_booking', 'cancel')
            ->where('start_date', '<=', $endDateTime)
            ->where('end_date', '>=', $startDateTime)
            ->get();


        $isBookedCount = $isBooked->count();


        // return response()->json([
        //     'data' => $isBookedCount,
        //     'JAM' => $startDateTime,

        // ]);





        if ($isBookedCount > 0) {

            return response()->json([
                'success' => false,
                'message' => 'Room sudah di booking silahkan ganti waktu yang sesuai'
            ], 500);
        } else {

            try {

                DB::beginTransaction();


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
                $newBooking->remainder_at = $request->remainder_at;

                $roomChek = $request->room_id;
                $startChek = $request->start_date;



                // return response()->json([
                //     'data' => json_decode($getEmailList),

                // ]);


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
                    // $newBooking->start_date = $request->start_date;
                    // $newBooking->end_date = $request->end_date;
                    $newBooking->start_date = $startDateTime;
                    $newBooking->end_date = $endDateTime;
                }

                $newBooking->date = $startDateTime;

                $newBooking->save();

                $roomId = $request->room_id;


                $getRoom = Room::where('id', $roomId)->first();




                $bookingId = $newBooking->id;
                $title = $request->title;
                $Link = env('APP_URL') . '/' . 'participants-attended' . '/' . $bookingId . '/' . 'presence';
                $QrCode = QrCode::size(200)->generate($Link);

                $data = ([
                    'title' => $request->title,
                    'room' => $getRoom->name,
                    'department' => $request->department,
                    'qrcode' => $QrCode,
                    'link' => $Link,
                    'date' => Carbon::parse($startDateTime)->format('Y-m-d'),
                    'time' => Carbon::parse($endDateTime)->format('H:i'),
                    'organizer' => Auth::user()->name,

                ]);


                // return response()->json([
                //     'data' => $data
                // ]);


                // $getSendMail = json_decode($request->participant);
                // $getSendMail = explode(",", $request->participant);
                // $roomTitle = $request->title;
                // foreach ($sendMail as $mail) {
                //     Mail::to($mail)->send(new AddMailToMeeting($data));
                // }

                // $getSendMail = $request->participant;
                // dispatch(new SendMailJob($data, $getSendMail));

                // dispatch(new SendMailJob($data));

                $getEmailList =  $request->participant;



                $mail = collect($getEmailList)->map(function ($mailList) {
                    return $mailList['email'];
                });




                // $gm = json_decode($mail, true);

                // $getEmailList = (explode(",", $request->participant));


                // $getEmailList = json_decode($getSendMail[0]);

                // return response()->json([
                //     'mail' => $mail
                // ]);

                foreach ($mail as $emailList) {
                    $newParticipan = new Participant();
                    $newParticipan->booking_id =  $newBooking->id;
                    $newParticipan->email =  $emailList;
                    $newParticipan->status_booking = 'waiting';
                    $newParticipan->save();

                    // $emailOrganizer = Auth::user()->email;
                    dispatch(new SendMailJob($data, $emailList));
                }


                // foreach ($getEmailList as $emailList) {
                //     $newParticipan = new Participant();
                //     $newParticipan->booking_id =  $newBooking->id;
                //     $newParticipan->email =  $emailList;
                //     $newParticipan->status_booking = 'waiting';
                //     $newParticipan->save();
                //     // $emailOrganizer = Auth::user()->email;
                //     dispatch(new SendMailJob($data, $emailList));
                //     // $job = SendMailJob::dispatch($data, $emailList);
                //     // dispatch($job);
                // }


                // Mail::to('fauziagustian68@gmail.com')->send(new AddMailToMeeting($roomTitle));

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
        //
    }
}
