<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Company;
use App\Models\SettingWeb;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SettingWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;

        $company = User::with(['licence', 'company'])->where('id', $userId)->first();
        // return $company;
        return view('admin.setting.index', [
            'company' => $company,
        ]);
    }

    // public function page_admin()
    // {
    //     $user = SettingWeb::all();
    //     return view('admin.setting.page-admin.index', [
    //         'user' => $user,
    //     ]);
    // }

    // public function page_user()
    // {
    //     $user = SettingWeb::all();
    //     return view('admin.setting.page-user.index', [
    //         'user' => $user,
    //     ]);
    // }

    // public function page_room()
    // {
    //     $user = SettingWeb::all();
    //     return view('admin.setting.page-room.index', [
    //         'user' => $user,
    //     ]);
    // }

    public function license()
    {
        // $companyId = Auth::user()->company_id;
        // $company = Company::with('license')->where('id', $companyId)->first();

        $userId = Auth::user()->id;
        $company = User::with(['licence', 'company'])->where('id', $userId)->first();
        // return $company;
        return view('admin.setting.license', [
            'company' => $company,
        ]);
    }

    public function edit(Request $request, $id)
    {

        $companyId = Auth::user()->company_id;
        $company = Company::with('license')->where('id', $companyId)->first();
        return view('admin.setting.edit', [
            'company' => $company,
        ]);
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

    public function update(Request $request, $id)
    {
        $updateCompany = Company::find($id);
        $updateCompany->aplication_name = $request->aplication_name;
        
        if ($request->video != null) {
            $video = $request->file('video');
            $nama_video = $updateCompany->name . "_" . $request->video_name;
            $video->move('video/company', $nama_video);
            // $fileName = $request->video->getClientOriginalName()."-".Carbon::now()->format("dmY-his");
            $updateCompany->video = $nama_video;
        }
        //contoh upload logo
        if ($request->logo != null) {
            $logo = $request->file('logo');
            $nama_logo =  $updateCompany->name . "_" . $request->logo_name;
            $logo->move('gambar/company', $nama_logo);
            $updateCompany->logo = $nama_logo;
        }
        $updateCompany->save();
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
