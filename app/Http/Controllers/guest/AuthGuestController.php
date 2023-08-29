<?php

namespace App\Http\Controllers\guest;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use App\Models\GuestActivity;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;

class AuthGuestController extends Controller
{
    public function login()
    {
        return view('guest.auth.login');
    }


    public function showFormRegister()
    {
        $users = User::all();
        return view('auth.register', [
            'users' => $users
        ]);
    }



    public function authenticate(Request $request)
    {

        $email = $request->email;
        $user = User::select('id')->where('email', $email)->first();



        if ($user != null) {
            $userId = $user->id;
            $checkGuestStatus = Guest::where('user_id',  $userId)->where('status', 1)->first();
            $checkGuestAcitivity = GuestActivity::select('date')->where('user_id',  $userId)->first();
            if ($checkGuestStatus != null) {
                $guestId = $checkGuestStatus->id;
                $companyId = $checkGuestStatus->company_id;
            } else {
                FacadesSession::flash('error', 'Akun dengan Email yang anda masukan sudah Expired , silahkan aktifkan di resepsionis');
                return redirect()->route('guest-booking.login');
            }

            $dateNow = Carbon::now()->format('Y-m-d');
            $checkGuestAcitivity = GuestActivity::select('date')->where('user_id',  $userId)->where('date', $dateNow)->first();
            if ($checkGuestAcitivity == null) {


                $dateNowActivity = Carbon::now()->format('Y-m-d');
                $newActivity = new GuestActivity();
                $newActivity->user_id = $userId;
                $newActivity->guest_id = $guestId;
                $newActivity->company_id = $companyId;
                $newActivity->date = $dateNowActivity;
                $newActivity->save();
            }

            $getDateUser = \Carbon\Carbon::parse($checkGuestStatus->created_at)->format('Y-m-d');
            // return response()->json([
            //     'data' => $dateNow,
            //     'data2' => $getDateUser,
            // ]);

            if ($dateNow >  $getDateUser) {
                $dateNowUpdate = Carbon::now()->format('Y-m-d h:i:s');
                $updateActiveUser = Guest::find($guestId);
                $updateActiveUser->status = 2;
                $updateActiveUser->deleted_at = $dateNowUpdate;
                $updateActiveUser->save();

                FacadesSession::flash('error', 'Akun dengan Email yang anda masukan sudah Expired , silahkan aktifkan di resepsionis');
                return redirect()->route('guest-booking.login');
            } else {
                Auth::loginUsingId($user->id);
                $request->session()->regenerate();
                return redirect()->route('guest.dashboard');
            }
        } else {
            FacadesSession::flash('error', 'Email yang anda masukan salah');
            return redirect()->route('guest-booking.login');
        }

        // if ($user != null) {
        //     Auth::loginUsingId($user->id);
        //     $request->session()->regenerate();
        //     return redirect()->route('guest.dashboard');
        // } else {
        //     FacadesSession::flash('error', 'Email yang anda masukan salah');
        //     return redirect()->route('guest.login');
        // }
    }




    public function store(Request $request)
    {
        $new_nik = $request->nik;
        $users = User::where('nik', $new_nik)->first();
        request()->validate([
            'email' => 'required|email|unique:users',
        ]);

        if ($users == null) {
            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->email = $request->email;
            $user->status = 1;
            $user->level = 3;
            try {
                $user->save();
                return redirect()->route('guest-booking.login');
            } catch (\Throwable $e) {
                DB::rollBack();
                return response()->json([
                    'message' => $e->getMessage(),
                    'line' => $e->getLine(),
                ], 500);
            }
        }
    }

    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect('guest-booking/login');
    }
}
