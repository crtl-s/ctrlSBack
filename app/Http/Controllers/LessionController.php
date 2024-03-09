<?php

namespace App\Http\Controllers;

use App\Models\Lession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessionController extends Controller
{
    //
    public function index()
    {
        try {
            $lessions = Lession::with('topic')->get();
            return response()->json($lessions, 200);

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:lessions|max:255',
                'description' => 'max:255',
                'topic_id' => 'required|exists:topics,id',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $lession = Lession::create([
                'name' => $request->name,
                'description' => $request->description,
                'topic_id' => $request->topic_id,
            ]);
            return response()->json($lession, 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());

        }
    }

    public function show($id)
    {
        try {
            $lession = Lession::with('topic')->findOrFail($id);
            return response()->json($lession);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());

        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255|unique:lessions,name,' . $id,
                'description' => 'max:255',
                'topic_id' => 'required|exists:topics,id',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $lession = Lession::findOrFail($id);
            $lession->update([
                'name' => $request->name,
                'description' => $request->description,
                'topic_id' => $request->topic_id,
            ]);
            return response()->json($lession, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());

        }
    }

    public function destroy($id)
    {
        try {
            $lession = Lession::findOrFail($id);
            $lession->delete();
            return response()->json('Lession deleted', 204);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());

        }
    }

}
