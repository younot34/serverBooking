<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return User::where('email', '!=', 'admin@gmail.com')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // 🔹 Cegah delete admin@gmail.com
        if ($user->email === 'admin@gmail.com') {
            return response()->json([
                'message' => '❌ User admin tidak boleh dihapus'
            ], 403);
        }

        $user->delete();

        return response()->json([
            'message' => '✅ User berhasil dihapus'
        ], 200);
    }
}
