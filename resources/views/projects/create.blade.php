@extends('layouts.app')

@section('content')
    <div class="bg-white p-8 rounded w-1/2 shadow mx-auto">
        <h1 class="text-center font-bold text-lg mb-8">Let's start something new</h1>
        <form method="POST" action="/projects">
            @include('projects.form', ['project' => new App\Models\Project, 'buttonText' => 'Create Project'])
        </form>
    </div>

@endsection
