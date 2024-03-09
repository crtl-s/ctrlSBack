<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KnowledgeLevelController extends Controller
{
    public function index()
    {
        try {
            $knowledgeLevels = KnowledgeLevel::all();
            return response()->json($knowledgeLevels, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:knowledge_levels|max:255',
                'description' => 'max:255',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $knowledgeLevel = KnowledgeLevel::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
            return response()->json($knowledgeLevel, 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $knowledgeLevel = KnowledgeLevel::findOrFail($id);
            return response()->json($knowledgeLevel);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:knowledge_levels|max:255',
                'description' => 'max:255',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $knowledgeLevel = KnowledgeLevel::findOrFail($id);
            $knowledgeLevel->name = $request->name;
            $knowledgeLevel->description = $request->description;
            $knowledgeLevel->save();
            return response()->json($knowledgeLevel, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $knowledgeLevel = KnowledgeLevel::findOrFail($id);
            $knowledgeLevel->delete();
            return response()->json($knowledgeLevel, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

}
