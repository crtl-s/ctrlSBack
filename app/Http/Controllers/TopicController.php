<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
    //
    public function index(){
        try{
            $topics = Topic::all();
            return response()->json($topics, 200);

        }catch (\Exception $e){
            return response()->json($e->getMessage());

        }
    }
    public function store(Request $request){
        try
        {
            $validator = Validator::make($request->all(),[
                'name' => 'required|unique:topics|max:255',
                'description' => 'max:255',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors(), 400);
            }
            $topic = Topic::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return response()->json($topic, 201);
        }catch (\Exception $e){
            return response()->json($e->getMessage());

        }
    }
    public function show($id){
        try
        {
            $topic = Topic::findOrFail($id);
            return response()->json($topic);
        }catch (\Exception $e){
            return response()->json($e->getMessage());

        }
    }
    public function update(Request $request, $id){
        try
        {
            $validator = Validator::make($request->all(),[
                'name' => 'required|max:255|unique:topics,name,' . $id,
                'description' => 'max:255',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors(), 400);
            }
            $topic = Topic::findOrFail($id);
            $topic->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return response()->json($topic, 200);
        }catch (\Exception $e){
            return response()->json($e->getMessage());

        }
    }

    public function destroy($id){
        try
        {
            $topic = Topic::findOrFail($id);
            $topic->delete();
            return response()->json('Topic deleted successfully', 200);
        }catch (\Exception $e){
            return response()->json($e->getMessage());

        }
    }

}
