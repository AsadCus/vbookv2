<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Dcblogdev\MsGraph\Facades\MsGraph;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;

class AuthMicrosoftController extends Controller
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

    public function redirectToMicrosoft()
    {
        return MsGraph::connect();
    }

    public function handleMicrosoftCallback()
    {
        $user_microsoft   = MsGraph::get('me');
        $user           = User::where('email', $user_microsoft['userPrincipalName'])->first();
        // $name           = $user_microsoft['userPrincipalName'];

        if ($user != null) {

            Auth::login($user, true);
            return redirect()->route('user.dashboard');
            // set session
            $userId = $user->id;
            $newSession = User::find('user_id', $userId);
            $newSession->google_id = $user_microsoft->id;
            $newSession->google_token = $user_microsoft->token;
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

        // return response()->json([
        //     'data' => $user_microsoft,
        //     'user' => $user,
        //     'name' => $name
        // ]);
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
