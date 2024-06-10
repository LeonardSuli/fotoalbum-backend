@extends('layouts.admin')

@section('content')
    <header class="bg-dark text-white py-3">

        <div class="container d-flex justify-content-between align-items-center">

            <h1>Create Photo info</h1>

            <a class="btn btn-secondary" href="{{ route('admin.photos.index') }}">Back</a>

        </div>

    </header>

    <div class="container mt-4">

        @include('partials.errors')

        <form action="{{ route('admin.photos.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- Title --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelper"
                    placeholder="Add a title for the photo" />
                <small id="titleHelper" class="form-text text-muted">Add photo title here</small>
            </div>

            {{-- Upload Image --}}
            <div class="mb-3">
                <label for="upload_image" class="form-label">Image</label>
                <input type="file" class="form-control" name="upload_image" id="upload_image" placeholder="Image"
                    aria-describedby="ImageHelper" />
                <div id="ImageHelper" class="form-text">Upload a image</div>
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="escription" rows="5"
                    placeholder="Add a description for the photo">{{ old('description') }}</textarea>
            </div>










            <button type="submit" class="btn btn-primary">
                Create
            </button>









        </form>

    </div>
@endsection
