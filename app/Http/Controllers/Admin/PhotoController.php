<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Photo::orderByDesc('id')->paginate());

        return view('admin.photos.index', ['photos' => Photo::where('user_id', auth()->id())->orderByDesc('id')->paginate(10)]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.photos.create', compact('categories'));
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePhotoRequest $request)
    {
        // dd($request->all());

        // Validate from StorePhotoRequest
        $val_data = $request->validated();

        // Validate slug with laravel function
        $val_data['slug'] = Str::slug($request->title, '-');


        if ($request->has('upload_image')) {

            $image_path = Storage::put('uploads', $request->upload_image);
            // dd($image_path);

            // Validate image
            $val_data['upload_image'] = $image_path;
            // dd($val_data);

        }

        $val_data['user_id'] = auth()->id();

        // Create
        Photo::create($val_data);


        // Redirect
        return to_route('admin.photos.index')->with('message', 'Photo info created successfully!');
    }




    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        return view('admin.photos.show', compact('photo'));
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        // Insert this condition if someone tries to hack your photos
        if ($photo->user_id == auth()->id()) {

            $categories = Category::all();

            return view('admin.photos.edit', compact('photo', 'categories'));
        }
        abort(403, 'You cannnot edit photos of others users!');
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
        // Insert this condition if someone tries to hack your photos
        if (auth()->id() != $photo->user_id) {

            abort(403, 'You cannnot update photos of others users!');
        }

        // dd($request->all());

        // Validate from UpdatePhotoRequest
        $val_data = $request->validated();

        // Validate slug with laravel function 
        $val_data['slug'] = Str::slug($request->title, '-');

        // dd($val_data);

        // condition if there is the image
        if ($request->has('upload_image')) {

            // check if there is a image
            if ($photo->upload_image) {

                // if so, delete it
                Storage::delete($photo->upload_image);
            }

            // upload the new image
            $image_path = Storage::put('uploads', $request->upload_image);
            // dd($image_path);
            $val_data['upload_image'] = $image_path;
            // dd($val_data);

        };

        // Update
        $photo->update($val_data);

        // Redirect
        return to_route('admin.photos.index')->with('message', 'Photo info updated successfully!');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {

        // Insert this condition if someone tries to hack your photos
        if (auth()->id() != $photo->user_id) {

            abort(403, 'You cannnot delete photos of others users!');
        }


        // check if there is a image
        if ($photo->upload_image) {

            // if so, delete it
            Storage::delete($photo->upload_image);
        }

        // delete the resource
        $photo->delete();

        // redirect
        return to_route('admin.photos.index')->with('message', 'Photo info deleted successfully!');
    }
}
