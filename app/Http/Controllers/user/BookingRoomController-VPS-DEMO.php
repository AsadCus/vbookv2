<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Jobs\SendMailJob;
use App\Models\BookingRoom;
use App\Models\Participant;
use App\Models\Room;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Mail\AddMailToMeeting;
use App\Models\Division;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Concerns\ToArray;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class BookingRoomController extends Controller
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


        return view('user.booking.create', [
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
        $conflictingSchedule = BookingRoom::where('room_id', $requestRoomId)->whereMonth('start_date', \Carbon\Carbon::now()->month)->get();

        $startDateTime = \Carbon\Carbon::parse($request->start_date)->format('Y-m-d H:i:s');
        $endDateTime   = \Carbon\Carbon::parse($request->end_date)->format('Y-m-d H:i:s');
        // $startDateTime = \Carbon\Carbon::parse($request->start_date);
        // $endDateTime   = \Carbon\Carbon::parse($request->end_date);

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
                $newBooking->description = $request->description;
                $newBooking->reload = 1;
                $newBooking->remainder_at = $request->remainder_at;

                $roomChek = $request->room_id;
                $startChek = $request->start_date;

                $newBooking->date = $request->start_date;

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
                    $newBooking->start_date = $request->start_date;
                    $newBooking->end_date = $request->end_date;
                }

                $newBooking->save();

                $roomId = $request->room_id;


                $getRoom = Room::where('id', $roomId)->first();




                $bookingId = $newBooking->id;
                $title = $request->title;


                // =============  LOCAL QRCODE ==============
                // $Link = env('APP_URL') . '/' . 'participants-attended' . '/' . $bookingId . '/' . 'presence';
                // $QrCode = QrCode::size(200)->generate($Link);
                // ============= END LOCAL QRCODE ==============

                // =============  DEMO QRCODE ==============
                $Link = env('APP_URL') . '/' . 'participants-attended' . '/' . $bookingId . '/' . 'display-presence';
                $QrcodeName = str_replace(' ', '_', $title);
                QrCode::format('png')->size(200)->merge('https://demo.vbooksystem.com/gambar/logo-vbook.png', .4, true)->generate($Link, '../public/qrcode/' . $QrcodeName . '.png');
                // ============= END DEMO QRCODE ==============


                // =============  TESTING QRCODE ==============
                // $Link = env('APP_URL') . '/' . 'participants-attended' . '/' . $bookingId . '/' . 'display-presence';
                // $QrcodeName = str_replace(' ', '_', $title);
                // QrCode::format('png')->size(200)->merge('https://testing.vbooksystem.com/gambar/logo-vbook.png', .4, true)->generate($Link, '../public/qrcode/' . $QrcodeName . '.png');
                // ============= END TESTING QRCODE ==============




                // =========== START DATE ISO FORMAT ============
                $startDateFormat = Carbon::parse($request->start_date)->timezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
                $startReplaceStrip = Str::replace('-', '', $startDateFormat);
                $startReplaceDot = Str::replace('.', '', $startReplaceStrip);
                $startReplaceColon = Str::replace(':', '', $startReplaceDot);
                $startDateIsoFormat = $startReplaceColon;

                // =========== END DATE ISO FORMAT ============
                $endDateFormat = Carbon::parse($request->end_date)->timezone('UTC')->format('Y-m-d\TH:i:s.v\Z');
                $endReplaceStrip = Str::replace('-', '', $endDateFormat);
                $endReplaceDot = Str::replace('.', '', $endReplaceStrip);
                $endReplaceColon = Str::replace(':', '', $endReplaceDot);
                $endDateIsoFormat = $endReplaceColon;
                $location = 'RUANG MEETING : ' . $getRoom->name;
                $description =  $request->description . '.' . ' ' . 'MEETING INI DILAKSANAKAN DI RUANG : ' . $getRoom->name;

                $data = ([
                    'title' => $request->title,
                    'description' => $description,
                    'room' => $getRoom->name,
                    'department' => $request->department,
                    //==== LOCAL USE QRCODE =====
                    // 'qrcode' => $QrCode,
                    //==== END LOCAL USE QRCODE =====

                    // === PROD USE QRCODENAME ==
                    'qrcode_name' => $QrcodeName,
                    // === END PROD USE QRCODENAME ==


                    'link' => $Link,
                    'date' => Carbon::parse($request->start_date)->format('Y-m-d'),
                    'time' => Carbon::parse($request->start_date)->format('H:i'),
                    'organizer' => Auth::user()->name,
                    'start_date' => $startDateIsoFormat,
                    'end_date' => $endDateIsoFormat,
                    'start_date_microsoft' => $startDateFormat,
                    'end_date_microsoft' => $endDateFormat,
                    'location' => $location,

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

                foreach ($mail as $emailList) {
                    $newParticipan = new Participant();
                    $newParticipan->booking_id =  $newBooking->id;
                    $newParticipan->email =  $emailList;
                    $newParticipan->status_booking = 'waiting';
                    $newParticipan->save();

                    // $emailOrganizer = Auth::user()->email;
                    dispatch(new SendMailJob($data, $emailList));
                    // Mail::to('fauziagustian68@gmail.com')->send(new AddMailToMeeting($data));

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
        $bookingEvent = BookingRoom::find($id);
        // return $bookingEvent;
        return view('user.booking.detail', [
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
        $bookingEvent = BookingRoom::find($id);
        // return $bookingEvent;
        return view('user.booking.edit', [
            'bookingEvent' => $bookingEvent,
        ]);
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
        try {

            $updateBookingEvent = BookingRoom::find($id);
            $updateBookingEvent->title = $request->title;
            $updateBookingEvent->start_date = $request->start_date;
            $updateBookingEvent->end_date = $request->end_date;
            $updateBookingEvent->save();

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

    public function cancel(Request $request, $id)
    {
        try {

            $updateBookingEvent = BookingRoom::find($id);
            $updateBookingEvent->status_booking = 'cancel';

            $updateBookingEvent->save();

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $bookingEvent = BookingRoom::find($id);

        try {
            $bookingEvent->delete();
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
