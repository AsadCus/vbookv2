<?php

namespace App\Http\Controllers\pantry;

use Exception;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\FoodCategory;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    function __construct(Food $food, FoodCategory $foodCategory)
    {
        $this->food = $food;
        $this->foodCategory = $foodCategory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companyId = Auth::user()->company_id;
        $food = $this->food->with('foodCategory')->where('company_id', $companyId)->orderBy('id')->get();
        $category = $this->foodCategory->where('company_id', $companyId)->get();
        return view('admin.food.index', [
            'food' => $food,
            'category' => $category,
        ]);
    }

    public function create()
    {
        $makanan = $this->food->all();
        return view('admin.food-menu.create', compact('makanan'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'foto_menu' => 'required|mimes:png,jpg,jpeg,csv,txt,xlx,xls,xlsx,pdf,doc,docx,ppt,pptx',
            'files.*' => 'mimes:png,jpg,jpeg,csv,txt,xlx,xls,xlsx,pdf,doc,docx,ppt,pptx',
        ]);

        DB::beginTransaction();
        try {
            $makanan = new Food();

            //contoh upload foto makanan
            
            if ($request->foto_menu != null) {
                $image = $request->file('foto_menu');
                $nama_foto =  $request->name . "_" . $request->foto_menu_name;
                $image->move('gambar/makanan', $nama_foto);
                $makanan->foto_menu = $nama_foto;
            }
            $makanan->food_menu = $request->name;
            $makanan->food_categories_id = $request->food_categories_id;
            $makanan->company_id = Auth::user()->company_id;
            $makanan->save();
        
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

    public function edit($id)
    {
        $food = $this->food->find($id);
        $companyId = Auth::user()->company_id;
        $category = $this->foodCategory->where('company_id', $companyId)->get();
        return view('admin.food.edit', [
            'food' => $food,
            'category' => $category,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $food = $this->food->find($id);
            if ($request->foto_menu != null) {
                $image = $request->file('foto_menu');
                $nama_foto =  $request->food_menu . "_" . $request->foto_menu_name;
                $image->move('gambar/makanan', $nama_foto);
                $food->foto_menu = $nama_foto;
            }
            $food->food_menu = $request->food_menu;
            $food->food_categories_id = $request->food_categories_id;
            $food->company_id = Auth::user()->company_id;
            $food->save();

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
        $food = $this->food->find($id);

        try {
            $food->delete();
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
        $this->food->where('id', $id)->withTrashed()->forceDelete();
        return redirect()->route('users.index', ['status' => 'archived']);
    }
    
}

