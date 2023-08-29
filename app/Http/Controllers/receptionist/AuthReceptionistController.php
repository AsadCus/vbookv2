<?php

namespace App\Http\Controllers\receptionist;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;

class AuthReceptionistController extends Controller
{
    public function login()
    {
        return view('receptionist.auth.login');
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
        $password = $request->password;

        Auth::attempt(['email' => $email, 'password' => $password]);

        if (Auth::check()) {

            $request->session()->regenerate();

            return redirect()->route('receptionist.dashboard');
        }

        FacadesSession::flash('error', 'Email atau password salah');
        return redirect()->route('receptionist.login');
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
                return redirect()->route('receptionist.login');
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
        return redirect('receptionist/login');
    }
}
