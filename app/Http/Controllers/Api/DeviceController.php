<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        return response()->json(Device::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'device_name' => 'required|string',
            'room_name' => 'required|string',
            'location' => 'nullable|string',
            'install_date' => 'nullable|date',
            'capacity' => 'nullable|integer',
            'equipment' => 'nullable|string',
            'is_on' => 'boolean',
        ]);

        $device = Device::create($data);

        return response()->json($device, 201);
    }

    public function show($id)
    {
        return response()->json(Device::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $device = Device::findOrFail($id);
        $device->update($request->all());

        return response()->json($device);
    }

    public function destroy($id)
    {
        Device::destroy($id);
        return response()->json(null, 204);
    }

    public function registerOrGet(Request $request)
    {
        $request->validate([
            'device_id' => 'required|string',
            'device_name' => 'required|string',
        ]);

        // cek apakah device sudah ada
        $device = Device::where('device_id', $request->device_id)->first();

        if ($device) {
            return response()->json(['room_name' => $device->room_name]);
        }

        // kalau belum ada, assign room baru
        $roomNumber = Device::count() + 1;
        $roomName = "Room $roomNumber";

        $device = Device::create([
            'device_id' => $request->device_id,
            'device_name' => $request->device_name,
            'room_name' => $roomName,
        ]);

        return response()->json(['room_name' => $device->room_name]);
    }

    public function updateByRoomName(Request $request, $room_name)
    {
        $request->validate([
            'is_on' => 'required|boolean',
        ]);

        $device = Device::where('room_name', $room_name)->firstOrFail();
        $device->update(['is_on' => $request->is_on]);

        return response()->json($device);
    }
}
