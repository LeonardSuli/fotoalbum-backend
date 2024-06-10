<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
use App\Http\Requests\StorePhotoRequest;
use App\Http\Requests\UpdatePhotoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd(Photo::orderByDesc('id')->paginate());

        return view('admin.photos.index', ['photos' => Photo::orderByDesc('id')->paginate(10)]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.photos.create');
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


        $image_path = Storage::put('uploads', $request->upload_image);
        // dd($image_path);

        // Validate image
        $val_data['upload_image'] = $image_path;
        // dd($val_data);


        // Create
        Photo::create($val_data);


        // Redirect
        return to_route('admin.photos.index')->with('message', 'Photo info created successfully');
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
        return view('admin.photos.edit', compact('photo'));
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePhotoRequest $request, Photo $photo)
    {
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

        // Create
        $photo->update($val_data);

        // Redirect
        return to_route('admin.photos.index')->with('message', 'Photo info updated successfully');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        // check if there is a image
        if ($photo->upload_image) {

            // if so, delete it
            Storage::delete($photo->upload_image);
        }

        // delete the resource
        $photo->delete();

        // redirect
        return to_route('admin.photos.index')->with('message', 'Photo info deleted successfully');
    }
}
