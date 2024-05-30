@extends('layouts.admin')

@section('content')
    <header class="bg-primary text-white py-3">
        <div class="container">
            <h1>New type</h1>
        </div>
    </header>
    <div class="container text-white py-3">

        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.types.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" @error('name') is-invalid @enderror name="name" id="name"
                    aria-describedby="nameHelper" placeholder="Type name" value="{{ old('name') }}" />
                <small id="nameHelper" class="form-text text-muted">Type a name for this project</small>
                @error('title')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <!-- /name -->

            <button type="submit" class="btn btn-primary">Create</button>
            <!-- /create button -->

        </form>
    </div>
@endsection
