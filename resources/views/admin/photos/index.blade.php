@extends('layouts.admin')

@section('content')
    <header class="bg-dark text-white py-3">

        <div class="container d-flex justify-content-between align-items-center">

            <h1>Photos</h1>

            <a class="btn btn-primary" href="{{ route('admin.photos.create') }}">Create</a>

        </div>

    </header>

    <div class="container my-3 py-auto">

        {{-- Flash redirect --}}
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

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

                                {{-- <img width="140px" src="{{ asset('storage/' . $photo->upload_image) }}" alt=""> --}}

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

                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalId-{{ $photo->id }}">
                                    <i class="fas fa-trash fa-xs fa-fw"></i> Delete
                                </button>

                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId-{{ $photo->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitle-{{ $photo->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content bg-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitle-{{ $photo->id }}">
                                                    Delete photo
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                You are about to destroy this photo: <strong>{{ $photo->title }}</strong>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>

                                                <form action="{{ route('admin.photos.destroy', $photo) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger">
                                                        Confirm
                                                    </button>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

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
