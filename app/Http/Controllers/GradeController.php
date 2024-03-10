<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GradeController extends Controller
{
    public function index()
    {
        if (!Auth::user()) {
            return response()->json('Unauthorized', 401);
        }
        try {
            $grades = Grade::all();
            return response()->json($grades, 200);
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
                'name' => 'required|unique:grades|max:255',
                'description' => 'max:255',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $grade = Grade::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return response()->json($grade, 201);
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
            $grade = Grade::findOrFail($id);
            return response()->json($grade);
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
                'name' => 'required|unique:grades|max:255',
                'description' => 'max:255',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $grade = Grade::findOrFail($id);
            $grade->upate([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return response()->json($grade, 200);
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
            $grade = Grade::findOrFail($id);
            $grade->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }


}
