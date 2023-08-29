<?php

namespace App\Http\Controllers\user;

use Exception;
use Carbon\Carbon;
use App\Models\Room;
use App\Models\User;
use App\Models\BookingRoom;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ParticipantAttendedController extends Controller
{
    public function index($id)
    {
        $booking = BookingRoom::with('participant')->find($id);
        $room = Room::with('apiRoom.api')->where('id', $booking->room_id)->first();
        $apiDoorLockOn = $room->apiRoom[4]->name ?? '';
        $apiDoorLockOff = $room->apiRoom[5]->name ?? '';
        return view('user.presence.index', [
            'booking' => $booking,
            'apiDoorLockOn' => $apiDoorLockOn,
            'apiDoorLockOff' => $apiDoorLockOff,
        ]);
    }

    public function attendanceQrCode(Request $request)
    {
        try {
            DB::beginTransaction();
            $email = $request->email;
            $pin = $request->pin;
            $bookingId = $request->booking_id;

            $bookingRoom = BookingRoom::where('id', $bookingId)->with(['participant' => function ($q) use ($bookingId, $email, $pin) {
                return $q->where('booking_id', $bookingId)->where('email', $email)->where('pin', $pin);
            }])->first();

            $chekParticipant = $bookingRoom->participant->count();

            if ($chekParticipant > 0) {
                $datenow = Carbon::now();
                $participantDate = \Carbon\Carbon::parse($datenow)->format('Y-m-d H:i:s');
                foreach ($bookingRoom->participant as $getBooking) {
                    $participanId = $getBooking->id;
                    $updateConfirm = Participant::find($participanId);
                    $updateConfirm->participant_confirmation = 2;
                    $updateConfirm->participant_attendance = $participantDate;
                    $updateConfirm->save();
                }
            } else {
                return response()->json([
                    'message' => 'User dengan Email dan PIN tersebut Tidak ditemukan dalam Event ini',
                    'code' => 500,
                    'error' => true,
                ], 500);
            }

            DB::commit();
            return response()->json([
                'message' => 'Data has been saved',
                'code' => 200,
                'error' => false,
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Internal error',
                'code' => 500,
                'error' => true,
                'errors' => $e,
            ], 500);
        }
    }
}
