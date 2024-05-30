@extends('layouts.admin')
@section('content')
    <header class="bg-primary text-light py-3">
        <div class="container">
            <h1>Edit project</h1>
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

        <form action="{{ route('admin.projects.update', $project) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" @error('title') is-invalid @enderror name="title"
                    id="title" aria-describedby="titleHelper" placeholder="Project title"
                    value="{{ $project->title }}" />
                <small id="titleHelper" class="form-text text-light">Type a title for this project</small>
                @error('title')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <!-- /title -->

            <div class="d-flex gap-3 mb-3">
                @foreach ($technologies as $technology)
                    @if ($errors->any())
                        <div class="form-check">
                            <input name="technologies[]" class="form-check-input" type="checkbox"
                                value="{{ $technology->id }}" id="technology-{{ $technology->id }}"
                                {{ $project->technologies->contains($technology) ? 'checked' : '' }} />
                            <label class="form-check-label text-light" for="technology-{{ $technology->id }}">
                                {{ $technology->name }} </label>
                        </div>
                    @else
                        <div class="form-check">
                            <input name="technologies[]" class="form-check-input" type="checkbox"
                                value="{{ $technology->id }}" id="technology-{{ $technology->id }}"
                                {{ $project->technologies->contains($technology->id) ? 'checked' : '' }} />
                            <label class="form-check-label text-light" for="technology-{{ $technology->id }}">
                                {{ $technology->name }} </label>
                        </div>
                    @endif
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
                <select class="form-select form-select" name="type_id" id="type_id">
                    <option selected disabled>Select a type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}"
                            {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}>
                            {{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- /type -->

            <div class="mb-3">
                @if (Str::startsWith($project->project_img, 'https://'))
                    <img width="140" src="{{ $project->project_img }}" alt="{{ $project->title }}">
                @else
                    <img width="140" src="{{ asset('storage/' . $project->project_img) }}" alt="{{ $project->title }}">
                @endif
                <br>
                <label for="project_img" class="form-label">Project image</label>
                <input type="file" class="form-control" @error('project_img') is-invalid @enderror name="project_img"
                    id="project_img" aria-describedby="project_imgHelper" placeholder="https://" value="" />
                <small id="project_imgHelper" class="form-text text-light">Put the project image link</small>
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
                    rows="5">{{ $project->description }}</textarea>
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
                <small id="project_linkHelper" class="form-text text-light">Type a link for this project</small>
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
                <small id="project_githubHelper" class="form-text text-light ">Type a link for this
                    project</small>
                @error('project_github')
                    <div class="text-danger py-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <!-- /project link for github-->

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
