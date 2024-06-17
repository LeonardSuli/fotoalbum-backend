<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {

            return response()->json([

                'success' => 'true',
                'results' => Category::all()->orderByDesc('id')->where('name', 'LIKE', '%' . $request->search . '%')->paginate()

            ]);
        }


        return response()->json([
            'success' => 'true',
            'results' => Category::all()->orderByDesc('id')->paginate()
        ]);
    }

    public function show($id)
    {

        $category = Category::where('id', $id)->first();

        if ($category) {

            return response()->json([
                'success' => 'true',
                'results' => $category
            ]);
        } else {

            return response()->json([
                'success' => 'false',
                'results' => '404 Not Found'
            ]);
        }
    }
}
