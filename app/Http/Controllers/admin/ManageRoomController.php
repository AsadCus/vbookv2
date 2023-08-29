<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Api;
use App\Models\ApiRoom;
use App\Models\Company;
use App\Models\CompanyDevice;
use App\Models\Device;
use App\Models\Division;
use App\Models\Licence;
use App\Models\MergeRoom;
use App\Models\Room;
use App\Models\RoomRestrict;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ManageRoomController extends Controller
{
    public function index()
    {
        $companyId = Auth::user()->company_id;
        $room = Room::with('user', 'device', 'roomRestrict.division', 'apiRoom.api')->where('company_id', $companyId)->get();
        $user = User::with('room')->where('role_id', 4)->where('company_id', $companyId)->get();
        return view('admin.manage-room.index', [
            'room' => $room,
            'user' => $user,
        ]);
    }

    public function create()
    {
        $companyId = Auth::user()->company_id;
        $device = CompanyDevice::with('device', 'company')->where('company_id', $companyId)->get();
        $division = Division::where('company_id', $companyId)->get();
        $license = Company::with('license')->where('id', $companyId)->first();
        return view('admin.manage-room.create', [
            'device' => $device,
            'division' => $division,
            'license' => $license,
        ]);
    }

    public function store(Request $request)
    {
        // ================= CHECK LICENSE ======================
        $licenseId = Auth::user()->licence_id;
        $license = Licence::where('id', $licenseId)->first();
        $macLicense = $license->max_device;
        $countUsedLicense = $license->count_device;
        if ($countUsedLicense < $macLicense) {
            if ($request->merge_room == true) {
                try {
                    // ================== GENEATE PIN 6 DIGIT =================
                    $random = mt_rand(100000, 999999);
                    $pin1 = str_shuffle($random);
                    $random2 = mt_rand(100000, 999999);
                    $pin2 = str_shuffle($random2);
                    // ================= END GENERATE PIN =====================
                    // ============= USED LICENSE ==============
                    $useLicense = Licence::find($licenseId);
                    $getCountDevice = $useLicense->count_device;
                    $upadateCountDevice = $getCountDevice + 2;
                    $useLicense->count_device = $upadateCountDevice;
                    $useLicense->save();
                    // =============== END USED LICENSE ============
                    // =============== NEW ROOM =================
                    $newRoom = new Room();
                    $newRoom->company_id = Auth::user()->company_id;
                    $newRoom->name = $request->name;
                    $newRoom->base_id = $request->base_id;
                    $newRoom->calendar_id = $request->calendar_id;
                    $newRoom->projector = $request->projector;
                    $newRoom->internet = $request->internet;
                    $newRoom->floor = $request->floor;
                    $newRoom->capacity = $request->capacity;
                    $newRoom->color_code = $request->color_code;
                    $newRoom->ip_address = $request->ip_address;
                    $newRoom->device_id = $request->device_id;
                    $restrict = $request->isRestricionRoom;
                    if ($restrict == 1) {
                        $newRoom->restrict_room = 'yes';
                    }
                    $newRoom->save();
                    $division = $request->divisionId;
                    foreach ($division as $divisions) {
                        $newRoomestrict = new RoomRestrict();
                        $newRoomestrict->room_id = $newRoom->id;
                        $newRoomestrict->company_id = Auth::user()->company_id;
                        $newRoomestrict->division_id = $divisions;
                        $newRoomestrict->save();
                    }
                    // =============== END NEW ROOM =================
                    // =================== DEVICE 1 ===================
                    $newUser = new User();
                    $newUser->name = 'DEVICE 1 - ' . $request->name;
                    $newUser->company_id = Auth::user()->company_id;
                    $newUser->email = str_replace(' ', '-', 'device1' . '_' . $request->name) . '@gmail.com';
                    $newUser->username = str_replace(' ', '-', 'device1' . '_' . $request->name) . '@gmail.com';
                    $newUser->role_id = 4;
                    $newUser->room_id = $newRoom->id;
                    $newUser->pin = $pin1;
                    $newUser->merge_room = 'yes';
                    $newUser->device_merge = 1;
                    $newUser->ip_address_merge_room = $request->ip_address_device1;
                    $newUser->password = Hash::make(12345678);
                    $newUser->save();
                    // ================ END DEVICE 1 =================
                    // =================== DEVICE 2 ===================
                    $newUser2 = new User();
                    $newUser2->name = 'DEVICE 2 - ' . $request->name;
                    $newUser2->company_id = Auth::user()->company_id;
                    $newUser2->email = str_replace(' ', '-', 'device2' . '_' . $request->name) . '@gmail.com';
                    $newUser2->username = str_replace(' ', '-', 'device2' . '_'  . $request->name) . '@gmail.com';
                    $newUser2->role_id = 4;
                    $newUser2->room_id = $newRoom->id;
                    $newUser2->pin = $pin2;
                    $newUser2->merge_room = 'yes';
                    $newUser2->device_merge = 2;
                    $newUser2->ip_address_merge_room = $request->ip_address_device2;
                    $newUser2->password = Hash::make(12345678);
                    $newUser2->save();
                    // ================ END DEVICE 2 =================
                    // ================== NEW MERGE ROOM =====================
                    $newMergeRoom = new MergeRoom();
                    $newMergeRoom->room_id = $newRoom->id;
                    $newMergeRoom->company_id = Auth::user()->company_id;
                    $newMergeRoom->user_device1 = $newUser->id;
                    $newMergeRoom->user_device2 = $newUser2->id;
                    $newMergeRoom->save();
                    // =============== END NEW MERGE ROOM =================
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
            } else {
                try {
                    // ================== GENEATE PIN 6 DIGIT =================
                    $random = mt_rand(100000, 999999);
                    $pin = str_shuffle($random);
                    // ================= END GENERATE PIN =====================
                    // ============= USED LICENSE ==============
                    $useLicense = Licence::find($licenseId);
                    $getCountDevice = $useLicense->count_device;
                    $upadateCountDevice = $getCountDevice + 1;
                    $useLicense->count_device = $upadateCountDevice;
                    $useLicense->save();
                    // =============== END USED LICENSE ============
                    // =============== NEW ROOM =================
                    $newRoom = new Room();
                    $newRoom->company_id = Auth::user()->company_id;
                    $newRoom->name = $request->name;
                    $newRoom->base_id = $request->base_id;
                    $newRoom->calendar_id = $request->calendar_id;
                    $newRoom->projector = $request->projector;
                    $newRoom->internet = $request->internet;
                    $newRoom->floor = $request->floor;
                    $newRoom->capacity = $request->capacity;
                    $newRoom->color_code = $request->color_code;
                    $newRoom->ip_address = $request->ip_address;
                    $newRoom->device_id = $request->device_id;
                    // $newRoom->taphome_on = $request->taphome_on;
                    // $newRoom->taphome_off = $request->taphome_off;
                    $restrict = $request->isRestricionRoom;
                    if ($restrict == 1) {
                        $newRoom->restrict_room = 'yes';
                    }
                    $newRoom->save();
                    $division = $request->divisionId;
                    foreach ($division as $divisions) {
                        $newRoomestrict = new RoomRestrict();
                        $newRoomestrict->room_id = $newRoom->id;
                        $newRoomestrict->company_id = Auth::user()->company_id;
                        $newRoomestrict->division_id = $divisions;
                        $newRoomestrict->save();
                    }
                    // =============== END NEW ROOM =================
                    $newUser = new User();
                    $newUser->name = 'Device' . '-' . $request->name;
                    $newUser->company_id = Auth::user()->company_id;
                    $newUser->email = str_replace(' ', '-', 'device_' . $request->name) . '@gmail.com';
                    $newUser->username = str_replace(' ', '-', $request->name) . '@gmail.com';
                    $newUser->role_id = 4;
                    $newUser->room_id = $newRoom->id;
                    $newUser->merge_room = 'no';
                    $newUser->device_merge = 1;
                    $newUser->pin = $pin;
                    $newUser->ip_address_merge_room = $request->ip_address;
                    $newUser->password = Hash::make(12345678);
                    $newUser->save();
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
        } else {
            return response()->json([
                'message' => 'Sorry, your license is full, please contact VBOOK regarding this license',
                'errors' => [],
                'status' => true,
                'code' => 400,
            ], 400);
        }
    }

    public function edit($id)
    {
        $companyId = Auth::user()->company_id;
        $device = CompanyDevice::with('device', 'company')->where('company_id', $companyId)->get();
        $room = Room::with(['device', 'user'])->where('id', $id)->first();
        return view('admin.manage-room.edit', [
            'device' => $device,
            'room' => $room,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $userId = $request->user_id;
            $updateUser = User::find($userId);
            $updateUser->name = 'Device-' . str_replace(' ', '-', $request->name);
            $updateUser->email = 'device_' . str_replace(' ', '-', $request->name) . '@gmail.com';
            $updateUser->username = str_replace(' ', '-', $request->name) . '@gmail.com';
            $updateUser->ip_address_merge_room = $request->ip_address;
            $updateUser->save();
            $updateRoom = Room::find($id);
            $updateRoom->name = $request->name;
            $updateRoom->projector = $request->projector;
            $updateRoom->floor = $request->floor;
            $updateRoom->capacity = $request->capacity;
            $updateRoom->color_code = $request->color_code;
            $updateRoom->ip_address = $request->ip_address;
            $updateRoom->device_id = $request->device_id;
            // $updateRoom->taphome_on = $request->taphome_on;
            // $updateRoom->taphome_off = $request->taphome_off;
            $updateRoom->save();
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

    public function editApi($id)
    {
        $room = Room::with('apiRoom')->where('id', $id)->first();
        $apis = Api::get();
        $apiRoom = ApiRoom::where('room_id', $id)->get();
        return view('admin.manage-room.edit-api', [
            'room' => $room,
            'apis' => $apis,
            'apiRoom' => $apiRoom,
        ]);
    }

    public function updateApi(Request $request, $id)
    {
        try {
            $apis = Api::get();
            $room_id = $request->room_id;
            $apiRoom = ApiRoom::where('room_id', $room_id)->get();
            if ($apiRoom->count() > 0) {
                foreach ($apiRoom as $keyApi1 => $listApi) {
                    $updateApi = ApiRoom::find($listApi->id);
                    $updateApi->room_id = $room_id;
                    foreach ($request->api as $keyApi2 => $listURL) {
                        if ($listURL == null) {
                            $wow[$keyApi2] = '-';
                        } else {
                            $wow[$keyApi2] = $listURL;
                        }
                    }
                    $updateApi->name = $wow[$keyApi1] ?? '-';
                    $updateApi->save();
                }
            } else {
                foreach ($apis as $keyApi1 => $listApi) {
                    $roomApi = new ApiRoom();
                    $roomApi->room_id = $room_id;
                    $roomApi->api_id = $listApi->id;
                    foreach ($request->api as $keyApi2 => $listURL) {
                        if ($listURL) {
                            $wow[$keyApi2] = $listURL;
                        } else {
                            $wow[$keyApi2] = '-';
                        }
                    }
                    $roomApi->name = $wow[$keyApi1] ?? '-';
                    $roomApi->save();
                }
            }
            
            DB::commit();
            return redirect('/admin/manage-room');
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        $licenseId = Auth::user()->licence_id;

        $useLicense = Licence::find($licenseId);
        $getCountDevice = $useLicense->count_device;
        $upadateCountDevice = $getCountDevice - 1;
        $useLicense->count_device = $upadateCountDevice;
        $useLicense->save();
        $room = Room::find($id);
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
