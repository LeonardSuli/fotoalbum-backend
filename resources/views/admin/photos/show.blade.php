@extends('layouts.admin')

@section('content')
    <header class="bg-dark text-white py-3">

        <div class="container d-flex justify-content-between align-items-center">

            <h1>Photos</h1>

            <a class="btn btn-primary" href="{{ route('admin.photos.index') }}">All photos</a>

        </div>

    </header>

    <div class="container my-3">

        <div class="row">

            <div class="col">

                <td>
                    @if (Str::startsWith($photo->upload_image, 'https://'))
                        <img width="100%" src="{{ $photo->upload_image }}" alt="">
                    @else
                        <img width="100%" src="{{ asset('storage/' . $photo->upload_image) }}" alt="">
                    @endif
                </td>

            </div>

            <div class="col">

                <td>{{ $photo->title }}</td>

            </div>

        </div>

    </div>
@endsection
