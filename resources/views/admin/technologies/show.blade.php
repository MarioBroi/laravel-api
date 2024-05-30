@extends('layouts.admin')
@section('content')
    <header class="py-3 bg-primary">
        <div class="container">
            <h1 class="text-white">{{ $technology->name }}</h1>
        </div>
    </header>

    <section class="py-5 text-light">
        <div class="container">
            <p>
                Slug: {{ $technology->slug }}
            </p>
            <h3>
                Name: {{ $technology->name }}
            </h3>
        </div>
        <!-- /.container -->
    </section>
@endsection
