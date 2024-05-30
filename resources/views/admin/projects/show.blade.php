@extends('layouts.admin')

@section('content')
    <header class="py-3 bg-primary">
        <div class="container">
            <h1 class="text-white">{{ $project->title }}</h1>
        </div>
    </header>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col">

                    @if (Str::startsWith($project->project_img, 'https://'))
                        <img class="img-fluid" loading="lazy" src="{{ $project->project_img }}" alt="{{ $project->title }}">
                    @else
                        <img class="img-fluid" loading="lazy" src="{{ asset('storage/' . $project->project_img) }}"
                            alt="{{ $project->title }}">
                    @endif
                </div>

                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="text-muted">{{ $project->slug }}</h5>
                            <h3 class="card-title">{{ $project->title }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p>{{ $project->project_link }}</p>
                            <p>{{ $project->project_github }}</p>
                            <p>{{ $project->description }}</p>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <p>
                                Type: {{ $project->type ? $project->type->name : 'Undefined' }}
                            </p>
                            @forelse ($project->technologies as $technology)
                                <p class="badge bg-dark p-2">
                                    {{ $technology->name }}
                                </p>
                            @empty
                            @endforelse
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->


                </div>
            </div>
        </div>
        <!-- /.container -->
    </section>
@endsection
