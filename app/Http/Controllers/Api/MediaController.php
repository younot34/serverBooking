<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        return response()->json(Media::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'logo_url' => 'required|string',
            'sub_logo_url' => 'nullable|string',
        ]);

        $media = Media::create($data);

        return response()->json($media, 201);
    }

    public function show($id)
    {
        return response()->json(Media::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $media = Media::findOrFail($id);
        $media->update($request->all());

        return response()->json($media);
    }

    public function destroy($id)
    {
        Media::destroy($id);
        return response()->json(null, 204);
    }
}
