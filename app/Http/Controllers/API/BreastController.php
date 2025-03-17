<?php

namespace App\Http\Controllers\API;

use App\Models\Breast;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class BreastController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $breasts = Breast::where('user_id', '=', $user_id)->get();
        return response()->json($breasts);
    }

    public function show($id)
    {
        $breast = Breast::with('user')->find($id);
        if (!$breast) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        return response()->json($breast);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'side' => 'nullable|string',
            'temprature' => 'required|integer',
            'volume' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $breast = Breast::create([
            'user_id' => Auth::id(),
            'side' => $request->side,
            'temprature' => $request->temprature,
            'volume' => $request->volume,
        ]);

        return response()->json([
            'message' => 'Data created successfully',
            'data' => $breast
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $breast = Breast::find($id);
        if (!$breast) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'side' => 'nullable|string',
            'temprature' => 'integer',
            'volume' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $breast->update($request->all());
        return response()->json(['message' => 'Data updated successfully', 'data' => $breast]);
    }

    public function destroy($id)
    {
        $breast = Breast::find($id);
        if (!$breast) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $breast->delete();
        return response()->json(['message' => 'Data deleted successfully']);
    }
}
