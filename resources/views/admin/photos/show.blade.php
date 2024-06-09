@extends('layouts.admin')

@section('content')
    <header class="bg-dark text-white py-3">

        <div class="container d-flex justify-content-between align-items-center">

            <h1>Photos</h1>

            <a class="btn btn-primary" href="{{ route('admin.photos.index') }}">All photos</a>

        </div>

    </header>

    <div class="container my-3">

        <row>

            <col>
            <td>
                @if (Str::startsWith($photo->upload_image, 'https://'))
                    <img width="140px" src="{{ $photo->upload_image }}" alt="">
                @else
                    <img width="140px" src="{{ asset('storage/' . $photo->upload_image) }}" alt="">
                @endif
            </td>
            </col>





            <col>
            <td>{{ $photo->title }}</td>
            </col>

        </row>

    </div>
@endsection
