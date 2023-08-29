<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session as FacadesSession;

class AuthGoogleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.auth.login');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function handleGoogleCallback(Request $request)
    {
        try {
            $user_google    = Socialite::driver('google')->user();
            $user           = User::where('email', $user_google->getEmail())->first();
            if ($user != null) {

                Auth::login($user, true);
                return redirect()->route('user.dashboard');
                // set session
                $userId = $user->id;
                $newSession = User::find('user_id', $userId);
                $newSession->google_id = $user_google->id;
                $newSession->google_token = $user_google->token;
                $newSession->save();
            } else {
                // $newUser = new User();
                // $newUser->name = $user_google->name;
                // $newUser->email = $user_google->email;
                // $newUser->username = $user_google->email;
                // $newUser->google_id = $user_google->id;
                // $newUser->google_token = $user_google->token;
                // $newUser->role_id = 3;
                // $newUser->password = Hash::make(12345678);
                // $newUser->save();

                // Auth::login($newUser, true);
                // return redirect()->route('user.dashboard');

                FacadesSession::flash('error', 'Email belum terdaftar di system, Harap registrasi melalui admin');
                return redirect()->route('user.login');
            }
        } catch (Exception $e) {
            dd($e);
            return redirect()->route('user.login');
        }
    }


    public function logout()
    {
        Cache::flush();
        Auth::logout();
        return redirect('/login');
    }


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
