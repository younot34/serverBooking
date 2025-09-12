<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Space;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    public function index()
    {
        return response()->json(Space::with('building')->get());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'building_id' => 'required|exists:buildings,id',
            'floor' => 'required|string',
            'capacity' => 'required|integer',
            'equipment' => 'nullable|string',
        ]);

        $space = Space::create($data);

        return response()->json($space, 201);
    }

    public function show($id)
    {
        return response()->json(Space::with('building')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $space = Space::findOrFail($id);
        $space->update($request->all());

        return response()->json($space);
    }

    public function destroy($id)
    {
        Space::destroy($id);
        return response()->json(null, 204);
    }
}
