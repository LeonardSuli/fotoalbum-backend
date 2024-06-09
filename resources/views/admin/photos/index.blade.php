@extends('layouts.admin')

@section('content')
    <header class="bg-dark text-white py-3">

        <div class="container d-flex justify-content-between align-items-center">

            <h1>Photos</h1>

            <a class="btn btn-primary" href="{{ route('admin.photos.create') }}">Create</a>

        </div>

    </header>

    <div class="container my-3 py-auto">

        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr class="">
                        <th scope="col">ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($photos as $photo)
                        <tr class="">

                            <td class="align-middle" scope="row">{{ $photo->id }}</td>

                            <td class="align-middle">
                                @if (Str::startsWith($photo->upload_image, 'https://'))
                                    <img width="140px" src="{{ $photo->upload_image }}" alt="">
                                @else
                                    <img width="140px" src="{{ asset('storage/' . $photo->upload_image) }}" alt="">
                                @endif
                            </td>

                            <td class="align-middle">{{ $photo->title }}</td>

                            <td class="align-middle">{{ $photo->slug }}</td>

                            <td class="align-middle">

                                <a class="btn btn-primary btn-sm" href="{{ route('admin.photos.show', $photo) }}">
                                    <i class="fas fa-eye fa-xs fa-fw"></i> View
                                </a>

                                <a class="btn btn-secondary btn-sm" href="{{ route('admin.photos.edit', $photo) }}">
                                    <i class="fas fa-pencil fa-xs fa-fw"></i> Edit
                                </a>

                                Delete

                            </td>

                        </tr>

                    @empty

                        <tr class="">
                            <td scope="row" colspan="5">No record to show.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        {{ $photos->links('pagination::bootstrap-5') }}

    </div>
@endsection
