<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\MergeRoom;
use App\Models\Room;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MergeRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mergeRoom = MergeRoom::with(['room', 'device1', 'device2'])->get();
        // return $mergeRoom;
        return view('admin.merge-room.index', [
            'merge_room' => $mergeRoom,
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
        $room = Room::where('company_id', $companyId)->get();
        $device = User::where('role_id', 4)->where('company_id', $companyId)->get();
        // return $device;
        return view('admin.merge-room.create', [
            'room' => $room,
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

            // ================== NEW MERGE ROOM =====================
            $newMergeRoom = new MergeRoom();
            $newMergeRoom->room_id = $request->room_id;
            $newMergeRoom->company_id = Auth::user()->company_id;
            $newMergeRoom->user_device1 = $request->account_device1;
            $newMergeRoom->user_device2 = $request->account_device2;

            $newMergeRoom->save();
            // =============== END NEW MERGE ROOM =================


            // ========= AKUN DEVICE 1 ===========
            $device1 = $request->account_device1;
            $accountDevice1 = User::find($device1);
            $accountDevice1->merge_room = 'yes';
            $accountDevice1->device_merge = 1;
            $accountDevice1->ip_address_merge_room = $request->ip_address_device1;
            $accountDevice1->merge_room_id = $newMergeRoom->id;
            $accountDevice1->save();
            // ======== END AKUN DEVICE 1 ==========


            // ========= AKUN DEVICE 2 ===========
            $device2 = $request->account_device2;
            $accountDevice2 = User::find($device2);
            $accountDevice2->merge_room = 'yes';
            $accountDevice2->device_merge = 2;
            $accountDevice2->ip_address_merge_room = $request->ip_address_device2;
            $accountDevice2->merge_room_id = $newMergeRoom->id;
            $accountDevice2->save();
            // ======== END AKUN DEVICE 2 ==========



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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = MergeRoom::find($id);

        try {
            $room->delete();
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
}
