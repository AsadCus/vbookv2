<?php

namespace App\Http\Controllers\superadmin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanyDevice;
use App\Models\Device;
use App\Models\Division;
use App\Models\Licence;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ManageCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with('company', 'licence')->where('role_id', 2)->get();
        // return $user;
        return view('superadmin.manage-company.index', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $device = Device::all();
        return view('superadmin.manage-company.create', [
            'device' => $device,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $length = 4;
            $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $generateCode1 = substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
            $generateCode2 = substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
            $generateCode3 = substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
            $generateCode4 = substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
            $serial = $generateCode1 . '-' . $generateCode2 . '-' . $generateCode3 . '-' . $generateCode4;

            $newLicence = new Licence();
            $newLicence->code = $serial;
            $newLicence->max_device = $request->licence_max;
            $newLicence->count_device = 0;
            $newLicence->save();

            //create company
            $random = mt_rand(10000000, 99999999);

            // shuffle the result
            $guestAccess = str_shuffle($random);

            $newCompany = new Company();
            $newCompany->name = $request->name;
            $newCompany->licence_id = $newLicence->id;
            $newCompany->guest_access = $guestAccess;
            $newCompany->aplication_name = $request->aplication_name;
            //contoh upload logo
            if ($request->logo != null) {
                $logo = $request->file('logo');
                $nama_logo =  $request->name . "_" . $request->logo_name;
                $logo->move('gambar/company', $nama_logo);
                $newCompany->logo = $nama_logo;
            }
            $newCompany->save();


            $newUser = new User();
            $newUser->company_id = $newCompany->id;
            $newUser->name = $request->name;
            $newUser->email = $request->email;
            $newUser->username = $request->email;
            $newUser->no_telp = $request->no_telp;
            $newUser->role_id = 2;
            $newUser->licence_id = $newLicence->id;
            $newUser->password = Hash::make($request->password);
            $newUser->save();

            $getDevice = json_decode($request->deviceId);

            // return response()->json([
            //     'data' => $getDevice,
            // ]);

            foreach ($getDevice as $newDevices) {
                $newCompanyDevice = new CompanyDevice();
                $newCompanyDevice->company_id = $newCompany->id;
                $newCompanyDevice->device_id = $newDevices;
                $newCompanyDevice->save();
            }




            DB::commit();
            return response()->json([
                'message' => 'Data has been saved',
                'code' => 200,
                'error' => false,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ], 500);
        }
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

        $user = User::with('company', 'licence')->where('id', $id)->first();

        // return $user;
        return view('superadmin.manage-company.edit', [
            'user' => $user,
        ]);
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
        DB::beginTransaction();
        try {
            $user = User::where('id', $id)->first();
            $companyId = $user->company_id;
            $linceseId = $user->licence_id;
            $newCompany = Company::find($companyId);
            $newCompany->name = $request->name;
            $newCompany->aplication_name = $request->aplication_name;
            //contoh upload logo
            if ($request->logo != null) {
                $logo = $request->file('logo');
                $nama_logo =  $request->name . "_" . $request->logo_name;
                $logo->move('gambar/company', $nama_logo);
                $newCompany->logo = $nama_logo;
            }
            $newCompany->save();

            $newLicence =  Licence::find($linceseId);
            $newLicence->max_device = $request->licence_max;
            $newLicence->save();


            $updateUser = User::find($id);
            $updateUser->name = $request->name;
            $updateUser->email = $request->email;
            $updateUser->username = $request->email;
            $updateUser->no_telp = $request->no_telp;
            $updateUser->save();


            DB::commit();
            return response()->json([
                'message' => 'Data has been saved',
                'code' => 200,
                'error' => false,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ], 500);
        }

        try {

            $updateUser = User::find($id);
            $updateUser->name = $request->name;
            $updateUser->email = $request->email;
            $updateUser->role_id = $request->role_id;
            $updateUser->no_telp = $request->no_telp;
            $updateUser->save();

            DB::commit();
            return response()->json([
                'message' => 'Data has been saved',
                'code' => 200,
                'error' => false,
            ]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => 'Internal error',
                'code' => 500,
                'error' => true,
                'errors' => $e,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
    public function destroy($id)
    {
        $user = User::find($id);

        try {
            $user->delete();
            return [
                'message' => 'data has been deleted',
                'error' => false,
                'code' => 200,
            ];
        } catch (Exception $e) {
            return [
                'message' => 'internal error',
                'error' => true,
                'code' => 500,
                'errors' => $e,
            ];
        }
    }

    public function forceDelete($id)
    {
        User::where('id', $id)->withTrashed()->forceDelete();

        return redirect()->route('users.index', ['status' => 'archived']);
    }
}
