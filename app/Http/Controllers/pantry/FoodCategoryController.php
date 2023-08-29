<?php

namespace App\Http\Controllers\pantry;

use App\Models\FoodCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FoodCategoryController extends Controller
{
    function __construct(FoodCategory $foodCategory)
    {
        $this->foodCategory = $foodCategory;
    }

    function index()
    {
        $companyId = Auth::user()->company_id;
        $category = $this->foodCategory->where('company_id', $companyId)->orderBy('id')->get();
        return view('admin.food-categories.index', [
            'category' => $category,
        ]);
    }

    function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $category = new FoodCategory();
            $category->name = $request->name;
            if ($request->desc != 'null') {$category->desc = $request->desc;}
            $category->company_id = Auth::user()->company_id;
            $category->save();
            
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

    function update(Request $request, $id)
    {
        try {
            $category = $this->foodCategory->find($id);
            $category->name = $request->name;
            if ($request->desc != 'null') {$category->desc = $request->desc;}
            // $category->desc = $request->desc;
            $category->save();

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

    public function destroy($id)
    {
        $category = $this->foodCategory->find($id);

        try {
            $category->delete();
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
