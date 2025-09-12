<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Building;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function index()
    {
        return response()->json(Building::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
        ]);

        $building = Building::create($data);

        return response()->json($building, 201);
    }

    public function show($id)
    {
        return response()->json(Building::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $building = Building::findOrFail($id);
        $building->update($request->all());

        return response()->json($building);
    }

    public function destroy($id)
    {
        Building::destroy($id);
        return response()->json(null, 204);
    }
}
