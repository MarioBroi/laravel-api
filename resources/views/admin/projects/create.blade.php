@extends('layouts.admin')
@section('content')
    <header class="bg-primary text-white py-3">
        <div class="container">
            <h1>New project</h1>
        </div>
    </header>
    <div class="container py-3 text-white">

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

        <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" @error('title') is-invalid @enderror name="title"
                    id="title" aria-describedby="titleHelper" placeholder="Project title" value="{{ old('title') }}" />
                <small id="titleHelper" class="form-text text-white ">Type a title for this project</small>
                @error('title')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <!-- /title -->

            <div class="d-flex gap-3 mb-3">
                @foreach ($technologies as $technology)
                    <div class="form-check">
                        <input name="technologies[]" class="form-check-input" type="checkbox" value="{{ $technology->id }}"
                            id="technology-{{ $technology->id }}"
                            {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }} />
                        <label class="form-check-label text-light" for="technology-{{ $technology->id }}">
                            {{ $technology->name }} </label>
                    </div>
                @endforeach
            </div>
            @error('technologies')
                <div class="text-danger py-2">
                    {{ message }}
                </div>
            @enderror
            <!-- /technologies -->

            <div class="mb-3">
                <label for="type_id" class="form-label">Type</label>
                <select class="form-select form-select-lg" name="type_id" id="type_id">
                    <option selected disabled>Select a type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == old('type_id') ? 'selected' : '' }}>
                            {{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- /type -->

            <div class="mb-3">
                <label for="project_img" class="form-label">Project image</label>
                <input type="file" class="form-control" @error('project_img') is-invalid @enderror name="project_img"
                    id="project_img" aria-describedby="project_imgHelper" placeholder="https://" />
                <small id="project_imgHelper" class="form-text text-white ">Select the project image</small>
                @error('project_img')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <!-- /project image -->

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" @error('description') is-invalid @enderror name="description" id="description"
                    rows="5">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <!-- /description -->

            <div class="mb-3">
                <label for="project_link" class="form-label">Project link</label>
                <input type="text" class="form-control" @error('project_link') is-invalid @enderror name="project_link"
                    id="project_link" aria-describedby="project_linkHelper" placeholder="Project project_link"
                    value="{{ old('project_link') }}" />
                <small id="project_linkHelper" class="form-text text-white ">Type a link for this project</small>
                @error('project_link')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <!-- /project link -->

            <div class="mb-3">
                <label for="project_github" class="form-label">Project GitHub</label>
                <input type="text" class="form-control" @error('project_github') is-invalid @enderror
                    name="project_github" id="project_github" aria-describedby="project_githubHelper"
                    placeholder="Project project_github" value="{{ old('project_github') }}" />
                <small id="project_githubHelper" class="form-text text-white ">Type a link for this
                    project</small>
                @error('project_github')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <!-- /project link for github-->

            <button type="submit" class="btn btn-primary">Create</button>
            <!-- /create button -->

        </form>
    </div>
@endsection
