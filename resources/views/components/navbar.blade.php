<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" wire:navigate href="{{route('home.index')}}">{{config('app.name')}}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent"> --}}
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a wire:navigate class="nav-link {{ (request()->is('home.index')) ? 'active' : '' }}" aria-current="page" href="{{route('home.index')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a wire:navigate class="nav-link {{ (request()->is('category.index')) ? 'active' : '' }}" href="{{route('category.index')}}">Category</a>
                </li>
                <li class="nav-item">
                    <a wire:navigate class="nav-link {{ (request()->is('posts.index')) ? 'active' : '' }}" href="{{route('posts.index')}}">Post</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        {{-- </div> --}}
    </div>
</nav>
