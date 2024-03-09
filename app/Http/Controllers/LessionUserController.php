<?php

namespace App\Http\Controllers;

use App\Models\LessionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessionUserController extends Controller
{
    //
    public function index(){
        try{
            $lession_users = LessionUser::with('lession')->with('user')->get();
            return response()->json($lession_users, 200);

        }catch (\Exception $e){
            return response()->json($e->getMessage());

        }
    }
    public function store(Request $request){
        try
        {
            $validator = Validator::make($request->all(),[
                'lession_id' => 'required|exists:lessions,id',
                'user_id' => 'required|exists:users,id',
            ]);
            if ($validator->fails()){
                return response()->json($validator->errors(), 400);
            }
            $lession_user = LessionUser::create([
                'lession_id' => $request->lession_id,
                'user_id' => $request->user_id,
            ]);
            return response()->json($lession_user, 201);
        }catch (\Exception $e){
            return response()->json($e->getMessage());

        }
    }
    public function show($id){
        try
        {
            $lession_user = LessionUser::findOrFail($id);
            return response()->json($lession_user);
        }catch (\Exception $e){
            return response()->json($e->getMessage());

        }
    }

    public function update(Request $request, $id){
        try
        {
            $validator = Validator::make($request->all(),[
                'lession_id' => 'required|exists:lessions,id',
                'user_id' => 'required|exists:users,id',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors(), 400);
            }
            $lession_user = LessionUser::findOrFail($id);
            $lession_user->update([
                'lession_id' => $request->lession_id,
                'user_id' => $request->user_id,
            ]);

            return response()->json($lession_user, 200);
        }catch (\Exception $e){
            return response()->json($e->getMessage());

        }
    }
    public function destroy($id){
        try
        {
            $lession_user = LessionUser::findOrFail($id);
            $lession_user->delete();
            return response()->json('Deleted successfully', 200);
        }catch (\Exception $e){
            return response()->json($e->getMessage());

        }
    }
}
