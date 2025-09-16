<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\History;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return response()->json(Booking::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'room_name' => 'required|string',
            'date' => 'required|date',
            'time' => ['required', 'regex:/^\d{2}:\d{2}(:\d{2})?$/'],
            'duration' => 'required|string',
            'number_of_people' => 'required|integer',
            'equipment' => 'array',
            'equipment.*' => 'string',
            'host_name' => 'required|string',
            'meeting_title' => 'required|string',
            'is_scan_enabled' => 'boolean',
            'scan_info' => 'nullable|string',
            'status' => 'nullable|string',
            'location' => 'nullable|string',
        ]);

        $booking = Booking::create($data);

        return response()->json($booking, 201);
    }

    public function show($id)
    {
        return response()->json(Booking::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update($request->all());

        return response()->json($booking);
    }

    public function destroy($id)
    {
        Booking::destroy($id);
        return response()->json(null, 204);
    }

    public function endBooking($id)
    {
        $booking = Booking::findOrFail($id);

        // Pindahkan ke history
        $historyData = $booking->toArray();
        History::create($historyData);

        // Hapus dari bookings
        $booking->delete();

        return response()->json(['message' => 'Booking moved to history'], 200);
    }

    public function getByRoom($roomName)
    {
        $bookings = Booking::where('room_name', $roomName)->get();

        return response()->json($bookings);
    }
}
