@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-default text-sm">
                <a href="/projects">My Projects</a> / {{ $project->title }}
            </p>

            <div class="flex items-center">
                @foreach ($project->members as $member)
                    <img src="{{ gravatar_url($member->email) }}"
                         alt="{{ $member->name }}'s avatar" class="rounded-full w-8 mr-2">
                @endforeach

                <img src="{{ gravatar_url($project->owner->email) }}"
                     alt="{{ $project->owner->name }}'s avatar" class="rounded-full w-8 mr-2">

                <a href="{{ $project->path().'/edit' }}" class="button ml-4">Edit Project</a>
            </div>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3">
                <div class="mb-8">
                    <h2 class="text-lg text-default font-normal mb-3">Tasks</h2>

                    @foreach($project->tasks as $task)
                        <div class="card mb-3">
                            <form method="POST" action="{{ $task->path() }}">
                                @method('PATCH')
                                @csrf

                                <div class="flex">
                                    <input name="body" value="{{ $task->body }}"
                                           class="bg-card w-full {{ $task->completed ? "text-default" : "" }}">
                                    <input name="completed" type="checkbox"
                                           onChange="this.form.submit()" {{ $task->completed ? "checked" : '' }}>
                                </div>
                            </form>
                        </div>
                    @endforeach
                    <div class="card mb-3">
                        <form action="{{ $project->path() . '/tasks' }}" method="POST">
                            @csrf

                            <input class="bg-card w-full" placeholder="Add a new task..." name="body">
                        </form>
                    </div>
                </div>

                <div class="mb-8">
                    <h2 class="text-lg text-default font-normal mb-3">General Notes</h2>

                    <form method="POST" action="{{ $project->path() }}">
                        @method('PATCH')
                        @csrf

                        <textarea name="notes" class="card w-full mb-4" style="min-height: 200px"
                                  placeholder="Write the notes you want">{{ $project->notes }}</textarea>

                        <button type="submit" class="button">Submit</button>
                    </form>


                    @include('errors')

                </div>
            </div>
            <div class="lg:w-1/4 px-3">
                @include('projects.card')

                @include('projects.activity.card')

                @can ('manage', $project)
                    @include('projects.invite')
                @endcan
            </div>
        </div>
    </main>

@endsection
