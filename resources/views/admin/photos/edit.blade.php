@extends('layouts.admin')

@section('content')
    <header class="bg-dark text-white py-3">

        <div class="container d-flex justify-content-between align-items-center">

            <h1>Editing Photo: {{ $photo->title }}</h1>

            <a class="btn btn-secondary" href="{{ route('admin.photos.index') }}">Back</a>

        </div>

    </header>

    <div class="container mt-4">

        @include('partials.errors')

        <form action="{{ route('admin.photos.update', $photo) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="titleHelper"
                    placeholder="Add a title for the photo" value="{{ old('title', $photo->title) }}" />
                <small id="titleHelper" class="form-text text-muted">Add photo title here</small>
            </div>

            {{-- Category --}}
            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select" name="category_id" id="category_id">
                    <option selected disabled>Select one</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{-- {{ $category->id == old('category_id', $photo->category->id) ? 'selected' : '' }}>
                            {{ $category->name }} --}}
                            {{ $category->id == old('category_id', optional($photo->category)->id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- Upload Image --}}
            <div class="d-flex align-items-center gap-3 my-3">

                @if (Str::startsWith($photo->upload_image, 'https://'))
                    <img width="200px" src="{{ $photo->upload_image }}" alt="">
                @else
                    <img width="200px" src="{{ asset('storage/' . $photo->upload_image) }}" alt="">
                @endif

                <div class="mb-3">
                    <label for="upload_image" class="form-label">Upload another image</label>
                    <input type="file" class="form-control" name="upload_image" id="upload_image" placeholder="Image"
                        aria-describedby="ImageHelper" />
                    <div id="ImageHelper" class="form-text">Upload a image</div>
                </div>

            </div>

            {{-- Description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="escription" rows="5"
                    placeholder="Add a description for the photo">{{ old('description', $photo->description) }}</textarea>
            </div>










            <button type="submit" class="btn btn-primary mb-4">
                Update
            </button>









        </form>

    </div>
@endsection
