@extends('layouts.admin')
@section('content')
    <header class="py-3 bg-primary">
        <div class="container">
            <h1 class="text-white">{{ $type->name }}</h1>
        </div>
    </header>

    <section class="py-5 text-light">
        <div class="container">
            <p>
                Slug: {{ $type->slug }}
            </p>
            <h3>
                Name: {{ $type->name }}
            </h3>
        </div>
        <!-- /.container -->
    </section>
@endsection
