<?php

namespace App\Http\Controllers\room;

use Exception;
use Carbon\Carbon;
use App\Models\BookingRoom;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ScanQrcodeController extends Controller
{
    public function index()
    {
        return view('user.presence.scan-qrcode');
    }

    public function attendance()
    {
        return view('user.presence.attendance');
    }

    public function postAttendance(Request $request)
    {
        try {
            DB::beginTransaction();
            $email = $request->email;
            $pin = $request->pin;

            $participant = Participant::where(([['email', $email],['pin', $pin],['participant_attendance',null]]))->with('bookingRoom.room')->first();

            if ($participant->bookingRoom->status_booking == 'ongoing') {
                $datenow = Carbon::now();
                $participantDate = \Carbon\Carbon::parse($datenow)->format('Y-m-d H:i:s');
                $update = Participant::find($participant->id);
                $update->participant_confirmation = 2;
                $update->participant_attendance = $participantDate;
                $update->save();

                DB::commit();
                return response()->json([
                    'message' => 'Data has been saved',
                    'code' => 200,
                    'ini' => $participant,
                    'error' => false,
                ]);
            } else {
                return response()->json([
                    'message' => 'Data has been seen',
                    'code' => 200,
                    'ini' => $participant,
                    'error' => false,
                ]);
            }
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'User dengan Email dan PIN tersebut tidak dapat ditemukan.',
                'code' => 500,
                'error' => true,
                'errors' => $e,
            ], 500);
        }
    }

    public function qr() {
        $Link = env('APP_URL') . '/' . 'attendance';
        $QrcodeName = 'attendance-qrcode';
        $qrPath = '../public/qrcode/' . $QrcodeName . '.png';
        File::delete($qrPath);
        QrCode::format('png')->size(200)->generate($Link, '../public/qrcode/' . $QrcodeName . '.png');
    }
}
