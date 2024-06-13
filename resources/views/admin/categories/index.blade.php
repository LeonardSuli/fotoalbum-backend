@extends('layouts.admin')

@section('content')
    <header class="bg-dark text-white py-3">

        <div class="container">

            <h1>Categories</h1>

        </div>

    </header>

    {{-- Flash redirect --}}
    <div class="container my-3">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="row row-cols-1 row-cols-md-2 g-4">

            <div class="col">
                <form action="{{ route('admin.categories.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name"
                            aria-describedby="nameHelper" placeholder="Insert new Categories..." />
                        <small id="nameHelper" class="form-text text-muted">Type a categoy name</small>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus fa-sm fa-fw"></i> Add
                    </button>

                </form>
            </div>

            <div class="col">
                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Tot. Photos</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($categories as $category)
                                <tr class="">

                                    <td scope="row">{{ $category->id }}</td>

                                    <td>
                                        <form action="{{ route('admin.categories.update', $category) }}" method="post">
                                            @csrf
                                            @method('PATCH')

                                            <div class="mb-3">
                                                <input type="text" class="form-control" name="name" id="name"
                                                    aria-describedby="helpId" placeholder=""
                                                    value="{{ $category->name }}" />
                                            </div>

                                        </form>
                                    </td>

                                    <td>{{ $category->slug }}</td>

                                    <td>
                                        <span class="badge bg-primary">
                                            {{-- {{ count($category->photos) }} --}}
                                            {{ $category->photos->count() }}
                                        </span>
                                    </td>

                                    <td>

                                        <!-- Modal trigger button -->
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#modalId-{{ $category->id }}">
                                            <i class="fas fa-trash fa-xs fa-fw"></i> Delete
                                        </button>

                                        <!-- Modal Body -->
                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                        <div class="modal fade" id="modalId-{{ $category->id }}" tabindex="-1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                            aria-labelledby="modalTitle-{{ $category->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                role="document">
                                                <div class="modal-content bg-white">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitle-{{ $category->id }}">
                                                            Delete category
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        You are about to destroy this category:
                                                        <strong>{{ $category->name }}</strong>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">
                                                            Close
                                                        </button>

                                                        <form action="{{ route('admin.categories.destroy', $category) }}"
                                                            method="post">
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
            </div>

        </div>



        {{-- {{ $categories->links('pagination::bootstrap-5') }} --}}

    </div>
@endsection
