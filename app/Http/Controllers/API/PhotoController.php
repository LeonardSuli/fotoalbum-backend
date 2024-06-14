<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;

class PhotoController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => 'true',
            'results' => Photo::with(['category', 'user'])->orderByDesc('id')->paginate()
        ]);
    }

    public function show($id)
    {

        $photo = Photo::with(['category', 'user'])->where('id', $id)->first();

        if ($photo) {

            return response()->json([
                'success' => 'true',
                'results' => $photo
            ]);
        } else {

            return response()->json([
                'success' => 'false',
                'results' => '404 Not Found'
            ]);
        }
    }
}
