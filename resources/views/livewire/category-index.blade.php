<div>
    <h2>Halaman Category</h2>
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

            </div>
            <div class="col">
                <div class="row g-2 align-items-center">
                    <div class="col-auto">
                        <label for="">Active</label>
                    </div>
                    <div class="col-auto">
                        <select class="form-select" wire:model.live="filterIsActive" aria-label="Default select example">
                            <option value="">All</option>
                            <option value="Active">Yes</option>
                            <option value="inActive">No</option>
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
                <th class="text-center">Nama</th>
                <th class="text-center">Slug</th>
                <th class="text-center">Active</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->slug }}</td>
                    <td class="text-center">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch"
                                {{ $item->is_active == 1 ? 'checked' : '' }} wire:click="toggleComplete({{$item->id}})">
                        </div>
                    </td>
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
                        <h1 class="modal-title fs-5" id="createModalLabel">Create Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            wire:click="closeModal"></button>
                    </div>
                    <form wire:submit="store">
                        <div class="modal-body">
                            <input type="hidden" wire:model="categoryID">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    wire:model="name" placeholder="category name">
                                @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="is_active"
                                        wire:model="is_active" {{ $is_active == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div>
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
