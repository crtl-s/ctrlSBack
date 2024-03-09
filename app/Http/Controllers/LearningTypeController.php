<?php

namespace App\Http\Controllers;

use App\Models\LearningType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LearningTypeController extends Controller
{
    public function index()
    {
        try {
            $learningTypes = LearningType::all();
            return response()->json($learningTypes, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:learning_types|max:255',
                'description' => 'max:255',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $learningType = LearningType::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return response()->json($learningType, 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $learningType = LearningType::findOrFail($id);
            return response()->json($learningType);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:learning_types|max:255',
                'description' => 'max:255',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $learningType = LearningType::findOrFail($id);
            $learningType->upadate([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return response()->json($learningType, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $learningType = LearningType::findOrFail($id);
            $learningType->delete();
            return response()->json('Learning type deleted successfully', 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }


}
