<?php

namespace App\Http\Controllers;

use App\Models\TopicUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TopicUserController extends Controller
{
    //
    public function index(){
        if (!Auth::user()){
            return response()->json('Unauthorized', 401);
        }
        try{
            $topic_users = TopicUser::with('topic')->with('user')->get();
            return response()->json($topic_users, 200);

        }catch (\Exception $e){
            return response()->json($e->getMessage());

        }
    }
    public function store(Request $request){
        if (!Auth::user()){
            return response()->json('Unauthorized', 401);
        }
        try
        {
            $validator = Validator::make($request->all(),[
                'topic_id' => 'required|exists:topics,id',
                'user_id' => 'required|exists:users,id',
            ]);

            if($validator->fails()){
                return response()->json($validator->errors(), 400);
            }
            $topic_user = TopicUser::create([
                'topic_id' => $request->topic_id,
                'user_id' => $request->user_id,
            ]);
            return response()->json($topic_user, 201);
        }catch (\Exception $e){
            return response()->json($e->getMessage());

        }
    }
    public function show($id){
        if (!Auth::user()){
            return response()->json('Unauthorized', 401);
        }
        try
        {
            $topic_user = TopicUser::findOrFail($id)->with('topic')->with('user')->get();
            return response()->json($topic_user);
        }catch (\Exception $e){
            return response()->json($e->getMessage());

        }
    }

    public function update(Request $request, $id){
        if (!Auth::user()){
            return response()->json('Unauthorized', 401);
        }
        try
        {
            $validator = Validator::make($request->all(),[
                'topic_id' => 'required|exists:topics,id',
                'user_id' => 'required|exists:users,id',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $topic_user = TopicUser::findOrFail($id);
            $topic_user->update([
                'topic_id' => $request->topic_id,
                'user_id' => $request->user_id,
            ]);
            return response()->json($topic_user, 200);
        }catch (\Exception $e){
            return response()->json($e->getMessage());

        }
    }

    public function destroy($id){
        if (!Auth::user()){
            return response()->json('Unauthorized', 401);
        }
        try
        {
            $topic_user = TopicUser::findOrFail($id);
            $topic_user->delete();
            return response()->json(null, 204);
        }catch (\Exception $e){
            return response()->json($e->getMessage());

        }
    }
}
