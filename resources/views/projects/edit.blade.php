@extends('layouts.app')

@section('content')
    <div class="bg-white p-8 rounded w-1/2 shadow mx-auto">
        <h1 class="text-center font-bold text-lg mb-8">Edit Your Project</h1>

        <form method="POST" action="{{ $project->path() }}">
            @method('PATCH')
            @include ('projects.form', ['buttonText' => 'Edit Project'])
        </form>
    </div>
@endsection
