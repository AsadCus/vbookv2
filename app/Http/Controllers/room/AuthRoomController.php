<?php

namespace App\Http\Controllers\room;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session as FacadesSession;

class AuthRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('room.auth.login');
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

    public function authenticate_room(Request $request)
    {
        $pin1 = $request->pin1;
        $pin2 = $request->pin2;
        $pin3 = $request->pin3;
        $pin4 = $request->pin4;
        $pin5 = $request->pin5;
        $pin6 = $request->pin6;

        $arr = array($pin1, $pin2, $pin3, $pin4, $pin5, $pin6);
        $getPin =  implode("", $arr);

        // $getPin = $pin1 + $pin2 + $pin3 + $pin4 + $pin5 + $pin6;
        // dd($getPin);
        $pin = $getPin;
        $user = User::select('id')->where('pin', $pin)->first();

        if ($user != null) {
            Auth::loginUsingId($user->id);
            $request->session()->regenerate();
            return redirect()->route('room.dashboard');
        } else {
            FacadesSession::flash('error', 'PIN yang anda masukan salah');
            return redirect()->route('room.login');
        }

        // $pin = $request->pin;
        // $user = User::where('pin', $pin)->first();
        // if ($user == null) {
        //     FacadesSession::flash('error', 'PIN yang anda masukan salah');
        //     return redirect()->route('room.login');
        // } else {

        //     $password = $user->password;
        //     $email = $user->email;

        //     // dd($password);
        //     Auth::attempt(['email' => $email, 'password' => $password]);

        //     // dd($email, $password);


        //     $request->session()->regenerate();

        //     return redirect()->route('room.dashboard');
        // }


        // if (Auth::check()) {

        //     $request->session()->regenerate();

        //     $user = User::where('pin', $pin)->first();
        //     if ($user == null) {
        //         FacadesSession::flash('error', 'PIN yang anda masukan salah');
        //         return redirect()->route('room.login');
        //     } else {
        //         return redirect()->route('room.dashboard');
        //     }
        // }
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

    public function logout(Request $request)
    {
        $roomId = Auth::user()->id;
        $room = User::find($roomId);
        $room->last_seen = null;
        $room->save();
        Cache::flush();
        Auth::logout(); // menghapus session yang aktif
        return redirect('room/login');
    }
}
