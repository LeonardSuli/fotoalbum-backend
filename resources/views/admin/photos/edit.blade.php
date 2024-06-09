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

            {{-- Description --}}
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="escription" rows="5"
                    placeholder="Add a description for the photo">{{ old('description', $photo->description) }}</textarea>
            </div>










            <button type="submit" class="btn btn-primary">
                Update
            </button>









        </form>

    </div>
@endsection
