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
                    placeholder="Add a title for the photo" value="{{ old('title') }}" />
                <small id="titleHelper" class="form-text text-muted">Add photo title here</small>

                {{-- Error --}}
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Category --}}
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" name="category_id" id="category_id">
                    <option selected disabled>Select one</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id === old('category_id') ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-check my-3">
                <input class="form-check-input" type="checkbox"
                    value="
                {{-- {{ $photo->in_evidence }} --}}
                 " id="in_evidence" name="in_evidence"
                    value="{{ old('in_evidence') }}" />
                <label class="form-check-label" for="in_evidence"> Best photos </label>
            </div>


            {{-- Upload Image --}}
            <div class="mb-3">
                <label for="upload_image" class="form-label">Image</label>
                <input type="file" class="form-control" name="upload_image" id="upload_image" placeholder="Image"
                    aria-describedby="ImageHelper" value="{{ old('upload_image') }}" />
                <div id="ImageHelper" class="form-text">Upload a image</div>

                {{-- Error --}}
                @error('upload_image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="escription" rows="5"
                    placeholder="Add a description for the photo">{{ old('description') }}
                </textarea>

                {{-- Error --}}
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mb-3">
                Create
            </button>

        </form>

    </div>
@endsection
