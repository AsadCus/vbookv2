<?php

namespace App\Http\Controllers\room;

use App\Http\Controllers\Controller;
use App\Models\BookingRoom;
use App\Models\CompanyDevice;
use App\Models\Device;
use App\Models\Participant;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Dotenv\Store\File\Paths;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class RoomDashboardController extends Controller
{
    public function index()
    {
        $roomId = Auth::user()->room_id;
        $userId = Auth::user()->id;
        $companyId = Auth::user()->company_id;
        $today = Carbon::today()->toDateString();
        $rooms = User::with('room.apiRoom.api')->where('id', $userId)->first();
        $now = \Carbon\Carbon::now()->toDateString();
        $roomsIp = Auth::user()->ip_address_merge_room;
        // return $rooms;
        $device = CompanyDevice::where('company_id', $companyId)->with('device')->first();
        // $roomsIp = Room::with('user')->where('user_id', $userId)->first();
        $bookingToday = BookingRoom::where('room_id', $roomId)->where('status_booking', 'waiting')->whereDate('start_date', $now)->orderBy('start_date', 'asc')->get();
        $bookingOngoing = BookingRoom::where('room_id', $roomId)->where('status_booking', 'ongoing')->get();

        $getBookingToday = collect($bookingToday)->map(function ($to) {
            return [
                'title' => $to->title,
                'start' => \Carbon\Carbon::parse($to->start_date)->toFormattedDateString(),
                'for_human' => \Carbon\Carbon::parse($to->start_date)->diffForHumans(),
            ];
        });

        $QrCode = '';
        $Link = '';
        $lineColor = '';

        if ($bookingOngoing->where('status_booking', 'ongoing')->values()->count() > 0) {
            $QrCodeData = $bookingOngoing->where('status_booking', 'ongoing')->values()[0];
            $bookingId = $QrCodeData->id;
            $title = $QrCodeData->title;
            $Link = env('APP_URL') . '/' . 'participants-attended' . '/' . $bookingId . '/' . 'presence';
            $QrCode = QrCode::size(100)->generate($Link);
        }
        if ($bookingOngoing->where('status_booking', 'ongoing')->values()->count() > 0) {
            $lineColor = '#F31111';
        } else {
            $lineColor = '#22df41';
        }

        $start_date = $bookingOngoing[0]->start_date ?? '-';
        $end_date = $bookingOngoing[0]->end_date ?? '-';
        $apiSystemOn = $rooms->room->apiRoom[0]->name ?? '';
        $apiSystemOff = $rooms->room->apiRoom[1]->name ?? '';
        $apiAlertOn = $rooms->room->apiRoom[2]->name ?? '';
        $apiAlertOff = $rooms->room->apiRoom[3]->name ?? '';
        $apiDoorLockOn = $rooms->room->apiRoom[4]->name ?? '';
        $apiDoorLockOff = $rooms->room->apiRoom[5]->name ?? '';
        // $apiArray = [
        //     '1' => $apiSystemOn,
        //     '2' => $apiSystemOff,
        //     '3' => $apiAlertOn,
        //     '4' => $apiAlertOff,
        //     '5' => $apiDoorLockOn,
        //     '6' => $apiDoorLockOff,
        // ];
        // dd($apiArray);
        // $taphomeOn = $bookingOngoing[0]->room->taphome_on ?? '';
        // $taphomeOff = $bookingOngoing[0]->room->taphome_off ?? '';

        //CHEK ROOM VIEW
        $checkRoom = User::with('room.device')->where('id', $userId)->where('company_id', $companyId)->first();
        $view = $checkRoom->room->device->view;

        $useCame = $checkRoom->room->device->use_came;
        // return $useCame;

        //CHEK ROOM VIEW
        if ($view == 'PRO' || $view == 'NON-PRO' || $view == 'SLIM') {
            return view('room.dashboard.index', [
                'rooms' => $rooms,
                'today' => $today,
                'booking_today' => $bookingToday,
                'QrCode' => (string) $QrCode,
                'linkQr' => $Link,
                'start_date' => $start_date,
                'bookingOngoing' => $bookingOngoing,
                'end_date' => $end_date,
                'lineColor' => $lineColor,
                'ip_address' => $roomsIp,
                'getBookingToday' => $getBookingToday,
                'device' => $device,
                'useCame' => $useCame,
                'apiSystemOn' => $apiSystemOn,
                'apiSystemOff' => $apiSystemOff,
                'apiAlertOn' => $apiAlertOn,
                'apiAlertOff' => $apiAlertOff,
                'apiDoorLockOn' => $apiDoorLockOn,
                'apiDoorLockOff' => $apiDoorLockOff,
                // 'taphome_on' => $taphomeOn,
                // 'taphome_off' => $taphomeOff,
            ]);
        }
        if ($view == 'SAMSUNG') {
            return view('room.dashboard.index2', [
                'rooms' => $rooms,
                'today' => $today,
                'booking_today' => $bookingToday,
                'QrCode' => (string) $QrCode,
                'linkQr' => $Link,
                'start_date' => $start_date,
                'bookingOngoing' => $bookingOngoing,
                'end_date' => $end_date,
                'lineColor' => $lineColor,
                'ip_address' => $roomsIp,
                'getBookingToday' => $getBookingToday,
                'device' => $device,
                'useCame' => $useCame,
                'apiSystemOn' => $apiSystemOn,
                'apiSystemOff' => $apiSystemOff,
                'apiAlertOn' => $apiAlertOn,
                'apiAlertOff' => $apiAlertOff,
                'apiDoorLockOn' => $apiDoorLockOn,
                'apiDoorLockOff' => $apiDoorLockOff,
                // 'taphome_on' => $taphomeOn,
                // 'taphome_off' => $taphomeOff,
            ]);
        }
        if ($view == 'SLIM') {
            return view('room.dashboard.index-slim', [
                'rooms' => $rooms,
                'today' => $today,
                'booking_today' => $bookingToday,
                'QrCode' => (string) $QrCode,
                'linkQr' => $Link,
                'start_date' => $start_date,
                'bookingOngoing' => $bookingOngoing,
                'end_date' => $end_date,
                'lineColor' => $lineColor,
                'ip_address' => $roomsIp,
                'getBookingToday' => $getBookingToday,
                'device' => $device,
                'useCame' => $useCame,
                'apiSystemOn' => $apiSystemOn,
                'apiSystemOff' => $apiSystemOff,
                'apiAlertOn' => $apiAlertOn,
                'apiAlertOff' => $apiAlertOff,
                'apiDoorLockOn' => $apiDoorLockOn,
                'apiDoorLockOff' => $apiDoorLockOff,
                // 'taphome_on' => $taphomeOn,
                // 'taphome_off' => $taphomeOff,
            ]);
        }
    }

    public function apiOngoing() {
        $roomId = Auth::user()->room->id;
        $bookingOngoing = BookingRoom::where('room_id', $roomId)->where('status_booking', 'ongoing')->get();

        return response()->json([
            'bookingOngoing' => $bookingOngoing,
        ]);
    }

    public function apiDisplay()
    {
        $roomId = Auth::user()->room->id;
        $userId = Auth::user()->id;
        $today = Carbon::today()->toDateString();
        $rooms = User::with('room.apiRoom.api')->where('id', $userId)->first();
        $device = Auth::user()->device_merge;
        // $device = User::with(['room' => function ($q) use ($roomId){
        //     $q->where('id', $roomId);
        // }])->where('id', $userId)->first();

        $now = \Carbon\Carbon::now()->toDateString();

        $bookingToday = BookingRoom::where('room_id', $roomId)->where('status_booking', 'waiting')->whereDate('start_date', $now)->orderBy('start_date', 'asc')->get();

        $bookingOngoing = BookingRoom::where('room_id', $roomId)->where('status_booking', 'ongoing')->get();

        $getBookingToday = collect($bookingToday)->map(function ($to) {
            return [
                'title' => $to->title,
                'start' => \Carbon\Carbon::parse($to->start_date)->format('d F, Y'),
                'for_human' => \Carbon\Carbon::parse($to->start_date)->diffForHumans(),
            ];
        });

        // $taphomeOn = $bookingOngoing[0]->room->taphome_on ?? '';
        // $taphomeOff = $bookingOngoing[0]->room->taphome_off ?? '';
        $apiSystemOn = $rooms->room->apiRoom[0]->name ?? '';
        $apiSystemOff = $rooms->room->apiRoom[1]->name ?? '';
        $apiAlertOn = $rooms->room->apiRoom[2]->name ?? '';
        $apiAlertOff = $rooms->room->apiRoom[3]->name ?? '';
        $apiDoorLockOn = $rooms->room->apiRoom[4]->name ?? '';
        $apiDoorLockOff = $rooms->room->apiRoom[5]->name ?? '';

        $QrCode = '';
        $Link = '';

        $lineColor = '';

        if ($bookingOngoing->where('status_booking', 'ongoing')->values()->count() > 0) {
            $QrCodeData = $bookingOngoing->where('status_booking', 'ongoing')->values()[0];
            $bookingId = $QrCodeData->id;
            $title = $QrCodeData->title;
            $Link = env('APP_URL') . '/' . 'participants-attended' . '/' . $bookingId . '/' . 'display-presence';
            $QrCode = QrCode::size(100)->generate($Link);
        }
        if ($bookingOngoing->where('status_booking', 'ongoing')->values()->count() > 0) {
            $lineColor = '#F31111';
        } else {
            $lineColor = '#22df41';
        }

        $start_date = $bookingOngoing[0]->start_date ?? '-';
        $end_date = $bookingOngoing[0]->end_date ?? '-';
        $clientIP = request()->ip();

        // return $bookingOngoing;
        return response()->json([
            'rooms' => $rooms,
            'today' => $today,
            'booking_today' => $bookingToday,
            'QrCode' => (string) $QrCode,
            'linkQr' => $Link,
            'start_date' => $start_date,
            'bookingOngoing' => $bookingOngoing,
            'end_date' => $end_date,
            'lineColor' => $lineColor,
            'ip' => $clientIP,
            'getBookingToday' => $getBookingToday,
            'device' => $device,
            'apiSystemOn' => $apiSystemOn,
            'apiSystemOff' => $apiSystemOff,
            'apiAlertOn' => $apiAlertOn,
            'apiAlertOff' => $apiAlertOff,
            'apiDoorLockOn' => $apiDoorLockOn,
            'apiDoorLockOff' => $apiDoorLockOff,
            // 'taphome_on' => $taphomeOn,
            // 'taphome_off' => $taphomeOff,
        ]);
    }

    public function reload(Request $request)
    {
        $device = Auth::user()->device_merge;

        if ($device == 1) {
            $bookingId = $request->booking_id;
            $updateReload = BookingRoom::find($bookingId);
            $updateReload->reload = 2;
            $updateReload->save();
        } elseif ($device == 2) {
            $bookingId = $request->booking_id;
            $updateReload = BookingRoom::find($bookingId);
            $updateReload->reload_device2 = 2;
            $updateReload->save();
        } else {
            $bookingId = $request->booking_id;
            $updateReload = BookingRoom::find($bookingId);
            $updateReload->reload = 2;
            $updateReload->save();
        }
    }
}
