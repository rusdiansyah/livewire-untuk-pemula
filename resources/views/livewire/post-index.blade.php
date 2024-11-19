<div>
    <h2>Halaman Post</h2>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col text-left">
                <button type="button" class="btn btn-primary mb-2" wire:click="create">
                    Create
                </button>
            </div>
            <div class="col">
                <div class="row g-2 align-items-center">
                    <div class="col-auto">
                        <label for="">Search</label>
                    </div>
                    <div class="col-auto">
                        <input type="text" wire:model.live="search" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row g-2 align-items-center">
                    <div class="col-auto">
                        <label for="">Category</label>
                    </div>
                    <div class="col-auto">
                        <select class="form-select" wire:model.live="filterCategory"
                            aria-label="Default select example">
                            <option value="">All</option>
                            @foreach ($listCategory as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Title</th>
                <th class="text-center">Slug</th>
                <th class="text-center">Image</th>
                <th class="text-center">Category</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->slug }}</td>
                    <td class="text-center">
                        <img src="{{asset('storage/public/posts/'.$item->image)}}" alt="{{$item->title}}" width="100">
                    </td>
                    <td>{{$item->category->name}}</td>
                    <td class="text-center">
                        <button type="button" wire:click="edit({{ $item->id }})" class="btn btn-info">Edit</button>
                        <button type="button" wire:click="delete({{ $item->id }})"
                            class="btn btn-danger">Delete</button>
                    </td>
                </tr>

            @empty
            @endforelse
        </tbody>
    </table>

    <!-- Modal -->
    @if ($isModalOpen)
        <div class="modal fade show" id="createModal" tabindex="-1" aria-hidden="true" style="display: block">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createModalLabel">Create Post</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="closeModal"></button>
                    </div>
                    <form wire:submit="store" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" wire:model="postID">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    wire:model="title" placeholder="Title">
                                @error('title')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select class="form-select" wire:model="category_id">
                                    <option value="">-</option>
                                    @foreach ($listCategory as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    wire:model="image">
                                @error('image')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea wire:model="content" class="form-control" rows="3"></textarea>
                                @error('content')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button wire:click="closeModal" type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal-backdrop fade show"></div>
    @endif
</div>
