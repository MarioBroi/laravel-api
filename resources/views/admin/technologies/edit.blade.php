@extends('layouts.admin')
@section('content')
    <header class="bg-primary text-white py-3">
        <div class="container">
            <h1>Edit technology</h1>
        </div>
    </header>
    <div class="container py-3 text-light">

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

        <form action="{{ route('admin.technologies.update', $technology) }}" method="post">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" @error('name') is-invalid @enderror name="name" id="name"
                    aria-describedby="nameHelper" placeholder="Technology name" value="{{ $technology->name }}" />
                <small id="nameHelper" class="form-text text-light">Change the technology name</small>
                @error('name')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <!-- /name -->

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
