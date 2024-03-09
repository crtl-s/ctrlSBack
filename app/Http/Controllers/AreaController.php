<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AreaController extends Controller
{
    //
  public function index(){
        try{
            $areas = Area::all();
            return response()->json($areas, 200);

        }catch (\Exception $e){
            return response()->json($e->getMessage());

        }
    }

    //STORE
    public function store(Request $request){
        try
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:areas|max:255',
                'description' => 'max:255',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $area = Area::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return response()->json($area, 201);
        }catch (\Exception $e){
            return response()->json($e->getMessage());

        }

    }

    //SHOW
    public function show($id){
        try
        {
            $area = Area::findOrFail($id);
            return response()->json($area);
        }catch (\Exception $e){
            return response()->json($e->getMessage());

        }

    }

    //UPDATE
    public function update(Request $request, $id){
        try
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255|unique:areas,name,' . $id,
                'description' => 'max:255',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $area = Area::findOrFail($id);
            $area->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return response()->json($area, 200);
        }catch (\Exception $e){
            return response()->json($e->getMessage());

        }

    }

    //DELETE
    public function destroy($id){
        try
        {
            $area = Area::findOrFail($id);
            $area->delete();
            return response()->json('Sucessfully deleted', 200);
        }catch (\Exception $e){
            return response()->json($e->getMessage());

        }

    }


}
