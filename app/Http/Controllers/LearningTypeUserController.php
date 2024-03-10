<?php

namespace App\Http\Controllers;

use App\Models\LearningTypeUser;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LearningTypeUserController extends Controller
{
    public function index()
    {
        if (!Auth::user()) {
            return response()->json('Unauthorized', 401);
        }
        try {
            $learningTypeUsers = LearningTypeUser::with('learningType')->with('user')->get();
            return response()->json($learningTypeUsers, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        if (!Auth::user()) {
            return response()->json('Unauthorized', 401);
        }
        try {
            $validator = Validator::make($request->all(), [
                'learning_type_id' => 'required|exists:learning_types,id',

                'user_id' => 'required|exists:users,id',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $learningTypeUser = LearningTypeUser::create([
                'learning_type_id' => $request->learning_type_id,
                'user_id' => $request->user_id,
            ]);
            return response()->json($learningTypeUser, 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function show($id)
    {
        if (!Auth::user()) {
            return response()->json('Unauthorized', 401);
        }
        try {
            $learningTypeUser = LearningTypeUser::findOrFail($id);
            return response()->json($learningTypeUser);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        if (!Auth::user()) {
            return response()->json('Unauthorized', 401);
        }
        try {
            $validator = Validator::make($request->all(), [
                'learning_type_id' => 'required|exists:learning_types,id',
                'user_id' => 'required|exists:users,id',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $learningTypeUser = LearningTypeUser::findOrFail($id);
            $learningTypeUser -> update([
                'learning_type_id' => $request->learning_type_id,
                'user_id' => $request->user_id,
            ]);

            return response()->json($learningTypeUser, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function destroy($id)
    {
        if (!Auth::user()) {
            return response()->json('Unauthorized', 401);
        }
        try {
            $learningTypeUser = LearningTypeUser::findOrFail($id);
            $learningTypeUser->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }


}
