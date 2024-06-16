@extends('layouts.admin')

@section('content')
    <header class="bg-dark text-white py-3">

        <div class="container d-flex justify-content-between align-items-center">

            <h1>{{ $photo->title }}</h1>

            <a class="btn btn-primary" href="{{ route('admin.photos.index') }}">All photos</a>

        </div>

    </header>

    <div class="container my-3">

        <div class="row">

            <div class="col">

                <div>
                    @if (Str::startsWith($photo->upload_image, 'https://'))
                        <img loading='lazy' width="100%" src="{{ $photo->upload_image }}" alt="">
                    @else
                        <img loading='lazy' width="100%" src="{{ asset('storage/' . $photo->upload_image) }}"
                            alt="">
                    @endif
                </div>

            </div>

            <div class="col">

                <h2>{{ $photo->title }}</h2>

                {{-- <div>{{ $photo->in_evidence }}</div> --}}

                <div><strong>Category: </strong> {{ $photo->category ? $photo->category->name : 'Uncategorized' }}</div>

                <div class="my-3">{{ $photo->description }}</div>


            </div>

        </div>

    </div>
@endsection
