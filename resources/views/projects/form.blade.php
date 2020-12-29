@csrf

<div class="mb-4">
    <label class="font-medium" for="title">Title</label>

    <div class="mt-2">
        <input type="text" class="p-1 border rounded border-gray-400 w-full" name="title"
               placeholder="My next awesome project" required value="{{ $project->title }}">
    </div>
</div>

<div class="mb-4">
    <label class="font-medium" for="description">Description</label>

    <div class="mt-2">
                    <textarea name="description" class="p-1 border rounded border-gray-400 w-full"
                              rows="6"
                              required
                              placeholder="I should start learning piano">{{ $project->description }}</textarea>
    </div>
</div>

<div class="field">
    <div class="control">
        <button type="submit" class="button mr-4">{{ $buttonText }}</button>
        <a href="{{ $project->path() }}">Cancel</a>
    </div>
</div>

@if ($errors->any())
    <div class="field mt-6">
        @foreach ($errors->all() as $error)
            <li class="text-sm text-red-600">{{ $error }}</li>
        @endforeach
    </div>
@endif
