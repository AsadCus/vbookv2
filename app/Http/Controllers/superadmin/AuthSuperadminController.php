<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session as FacadesSession;

class AuthSuperadminController extends Controller
{
    public function loginAdmin()
    {
        return view('superadmin.auth.login');
    }




    public function authenticate(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        Auth::attempt(['email' => $email, 'password' => $password]);

        if (Auth::check()) {

            $request->session()->regenerate();

            return redirect()->route('suadmin.dashboard');
        }

        FacadesSession::flash('error', 'Email atau password salah');
        return redirect()->route('suadmin.login');
    }


    public function logout()
    {
        Auth::logout(); // menghapus session yang aktif
        return redirect('suadmin/login');
    }
}
