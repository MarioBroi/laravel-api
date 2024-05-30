@extends('layouts.admin')

@section('content')
    <header class="py-3 bg-primary">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="text-white">Projects</h1>
        </div>
    </header>

    <section class="text-light py-5">
        <div class="container">

            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{ session('message') }}
                </div>
            @endif

            <div class="row row-cols-2">
                <div class="col pr-1">
                    <h3 class="text-center py-2">Create a projects</h3>

                    <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" @error('title') is-invalid @enderror name="title"
                                id="title" aria-describedby="titleHelper" placeholder="Project title"
                                value="{{ old('title') }}" />
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
                                    <input name="technologies[]" class="form-check-input" type="checkbox"
                                        value="{{ $technology->id }}" id="technology-{{ $technology->id }}"
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
                                    <option value="{{ $type->id }}"
                                        {{ $type->id == old('type_id') ? 'selected' : '' }}>
                                        {{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- /type -->

                        <div class="mb-3">
                            <label for="project_img" class="form-label">Project image</label>
                            <input type="file" class="form-control" @error('project_img') is-invalid @enderror
                                name="project_img" id="project_img" aria-describedby="project_imgHelper"
                                placeholder="https://" />
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
                            <input type="text" class="form-control" @error('project_link') is-invalid @enderror
                                name="project_link" id="project_link" aria-describedby="project_linkHelper"
                                placeholder="Project project_link" value="{{ old('project_link') }}" />
                            <small id="project_linkHelper" class="form-text text-white ">Type a link for this
                                project</small>
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
                <!-- /.col -->
                <div class="col pl-1">
                    <h3 class="text-center py-2">All projects</h3>
                    <div class="table-responsive">
                        <table class="table table-light">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">ID</th>
                                    <th scope="col" class="text-center">Project Image</th>
                                    <th scope="col" class="text-center">Title</th>
                                    <th scope="col" class="text-center">Slug</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($projects as $project)
                                    <tr class="">
                                        <td scope="row" class="text-center">{{ $project->id }}</td>
                                        <td class="text-center">
                                            @if (Str::startsWith($project->project_img, 'https://'))
                                                <img src="{{ $project->project_img }}" alt="{{ $project->title }}"
                                                    width="100">
                                            @else
                                                <img src="{{ asset('storage/' . $project->project_img) }}"
                                                    alt="{{ $project->title }}" width="100">
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $project->title }}</td>
                                        <td class="text-center">{{ $project->slug }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.projects.show', $project) }}"
                                                class="btn btn-primary m-1">Show <i class="fa fa-eye"
                                                    aria-hidden="true"></i></a>

                                            <a href="{{ route('admin.projects.edit', $project) }}"
                                                class="btn btn-primary m-1">Edit <i
                                                    class="fa-solid fa-pen-to-square"></i></a>

                                            <!-- Modal trigger button -->
                                            <button type="button" class="btn btn-danger m-1" data-bs-toggle="modal"
                                                data-bs-target="#modalId-{{ $project->id }}">
                                                Delete <i class="fa-solid fa-gavel"></i>
                                            </button>

                                            <!-- Modal Body -->
                                            <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                            <div class="modal fade" id="modalId-{{ $project->id }}" tabindex="-1"
                                                data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                                aria-labelledby="modalTitleId-{{ $project->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="modalTitleId-{{ $project->id }}">
                                                                ATTENTION! Deleting : {{ $project->title }}
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            ❌ Attention!! You are aboute to delete this record!
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">
                                                                Close
                                                            </button>
                                                            <form action="{{ route('admin.projects.destroy', $project) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">
                                                                    Confirm
                                                                    <i class="fa-solid fa-rectangle-xmark"></i>
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
                                        <td scope="row" colspan="5">Nothing to display</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $projects->links('pagination::bootstrap-5') }}
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->
    </section>
@endsection
