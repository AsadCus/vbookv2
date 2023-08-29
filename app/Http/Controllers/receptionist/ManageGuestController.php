<?php

namespace App\Http\Controllers\receptionist;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Guest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ManageGuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companyId = Auth::user()->company_id;
        $guest = Guest::with('division')->where('status', 1)->where('company_id', $companyId)->get();
        $guestNonActive = Guest::with('division')->where('status', 2)->where('company_id', $companyId)->withTrashed()->get();
        // return $user;
        return view('receptionist.manage-receptionist.index', [
            'guest' => $guest,
            'guest_non_active' => $guestNonActive,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companyId = Auth::user()->company_id;
        $division = Division::where('company_id', $companyId)->get();
        // return $division;
        return view('receptionist.manage-receptionist.create', [
            'division' => $division,
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

        try {
            $emailGuest = $request->email;
            $checkGuestRegistration = User::where('role_id', 6)->where('email', $emailGuest)->first();
            if ($checkGuestRegistration == null) {
                $newUserGuest = new User();
                $newUserGuest->name = $request->name;
                $newUserGuest->email = $request->email;
                $newUserGuest->username = $request->email;
                $newUserGuest->no_telp = $request->no_telp;
                $newUserGuest->role_id = 6;
                $newUserGuest->division_id = $request->division_id;
                $newUserGuest->password = Hash::make(12345678);
                $newUserGuest->company_id = Auth::user()->company_id;
                $newUserGuest->save();

                $newGuest = new Guest();
                $newGuest->user_id = $newUserGuest->id;
                $newGuest->name = $request->name;
                $newGuest->email = $request->email;
                $newGuest->phone = $request->no_telp;
                $newGuest->company_id = Auth::user()->company_id;
                $newGuest->division_id = $request->division_id;
                $newGuest->floor = $request->floor;

                //contoh upload logo

                if ($request->id_card != null) {
                    $id_card = $request->file('id_card');
                    $nama_id_card =  $request->name . "_" . $request->id_card_name;
                    $id_card->move('gambar/idcard', $nama_id_card);
                    $newGuest->id_card = $nama_id_card;
                }

                $newGuest->save();
            } else {
                return response()->json([
                    'message' => 'Email Sudah Terdaftar, jika user guest ingin booking segera aktifkan di menu management guest',
                    'code' => 500,
                    'error' => true,
                ], 500);
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

    public function aktif(Request $request, $id)
    {
        $guestIds = $request->guestId;
        $upadateAktif = Guest::where('id', $guestIds);
        $upadateAktif->status = 1;
        $upadateAktif->deleted_at = '';
        $upadateAktif->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guest = Guest::find($id);
        $upadateStatus = Guest::find($id);
        $upadateStatus->status = 2;
        $upadateStatus->save();

        try {
            $guest->delete();
            return [
                'message' => 'data has been deleted',
                'error' => false,
                'code' => 200,
            ];
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ], 500);
        }
    }

    public function restore($id)
    {
        $guest = Guest::withTrashed()->find($id);


        try {
            $dateNowUpdate = Carbon::now()->format('Y-m-d h:i:s');
            $guest->restore();
            $guest->status = 1;
            $guest->created_at = $dateNowUpdate;
            $guest->updated_at = $dateNowUpdate;
            $guest->save();
            return [
                'message' => 'data has been restore',
                'error' => false,
                'code' => 200,
            ];
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ], 500);
        }
    }
}
