<?php

namespace App\Http\Controllers;

use App\Models\EducationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EducationTypeController extends Controller
{
    public function index()
    {
        if(!Auth::user()){
            return response()->json('Unauthorized', 401);
        }
        try {
            $educationTypes = EducationType::all();
            return response()->json($educationTypes, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        if(!Auth::user()){
            return response()->json('Unauthorized', 401);
        }
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:education_types|max:255',
                'description' => 'max:255',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $educationType = EducationType::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return response()->json($educationType, 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function show($id)
    {
        if(!Auth::user()){
            return response()->json('Unauthorized', 401);
        }
        try {
            $educationType = EducationType::findOrFail($id);
            return response()->json($educationType);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        if(!Auth::user()){
            return response()->json('Unauthorized', 401);
        }
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:education_types|max:255',
                'description' => 'max:255',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $educationType = EducationType::findOrFail($id);
            $educationType->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return response()->json($educationType, 200);
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
            $educationType = EducationType::findOrFail($id);
            $educationType->delete();
            return response()->json('Education type deleted successfully', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }


}
