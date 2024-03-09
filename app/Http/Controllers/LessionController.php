<?php

namespace App\Http\Controllers;

use App\Models\Lession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LessionController extends Controller
{
    //
    public function index()
    {
        if (!Auth::user()) {
            return response()->json('Unauthorized', 401);
        }
        try {
            $lessions = Lession::with('topic')->get();
            return response()->json($lessions, 200);

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
                'name' => 'required|unique:lessions|max:255',
                'topic_id' => 'required|exists:topics,id',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $lession = Lession::create([
                'name' => $request->name,
                'topic_id' => $request->topic_id,
            ]);
            return response()->json($lession, 201);
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
            $lession = Lession::with('topic')->findOrFail($id);
            return response()->json($lession);
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
                'name' => 'required|max:255|unique:lessions,name,' . $id,
                'topic_id' => 'required|exists:topics,id',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $lession = Lession::findOrFail($id);
            $lession->update([
                'name' => $request->name,
                'topic_id' => $request->topic_id,
            ]);
            return response()->json($lession, 200);
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
            $lession = Lession::findOrFail($id);
            $lession->delete();
            return response()->json('Lession deleted', 200  );
        } catch (\Exception $e) {
            return response()->json($e->getMessage());

        }
    }

}
