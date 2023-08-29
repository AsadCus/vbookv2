<?php

namespace App\Http\Controllers\pantry;

use App\Models\Food;
use App\Models\DetailOrder;
use App\Models\FoodOrdering;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FoodOrderingController extends Controller
{
    public function __construct(Food $food, FoodOrdering $foodOrdering)
    {
        $this->food = $food;
        $this->foodOrdering = $foodOrdering;
    }
    public function index()
    {
        $companyId = Auth::user()->company_id;
        $food = $this->food->where('company_id', $companyId)->orderBy('id')->get();
        $order = $this->foodOrdering->with('detailOrders.food')->with('bookingRoom.room')->with('bookingRoom.participant')->with('bookingRoom.division')
        ->where('status', 'inprocess')
        ->whereHas('bookingRoom', function($q)use($companyId){$q->where('company_id',$companyId);})
        ->get();
        // dd($order);
        return view('pantry.manage-food-ordering.index', [
            'food' => $food,
            'order' => $order,
        ]);
    }

    public function store(Request $request)
    {
        try {

            $foodOrder = new FoodOrdering();
            $foodOrder->booking_id = $request->booking_id;
            $foodOrder->status = 'inprocess';
            $foodOrder->save();

            foreach ($request->food as $food) {
                $detailOrder = new DetailOrder();
                $detailOrder->food_ordering_id =  $foodOrder->id;
                $detailOrder->food_id =  $food;
                $detailOrder->pieces = $request->pieces[$food - 1];
                $detailOrder->save();
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

    public function done($id)
    {
        try {
            $order = $this->foodOrdering->find($id);
            $order->status = 'done';
            $order->save();
            
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
}