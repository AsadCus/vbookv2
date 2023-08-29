<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;


class AuthController extends Controller
{
    public function loginAdmin()
    {
        return view('admin.auth.login');
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

            return redirect()->route('admin.dashboard');
        }

        FacadesSession::flash('error', 'Email atau password salah');
        return redirect()->route('admin.login');
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
                return redirect()->route('login');
            } catch (Exception $e) {
                return response()->json([
                    'message' => 'Internal error',
                    'code' => 500,
                    'error' => true,
                    'errors' => $e,
                ], 500);
            }
        }
    }

    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect('admin/login');
    }
}
