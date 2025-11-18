@extends('layouts.app')

@section('content')
<div class="bg-white rounded shadow p-4 max-w-md">
    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf
        <div class="mb-3">
            <label class="block tex-sm">Name</label>
            <input name="name" required class="w-full border p-2 rounded">
        </div>

        <div class="mb-3">
            <label class="block text-sm">Project</label>
            <select name="project_id" class="w-full border p-2 rounded">
                <option value="">none</option>
                @foreach ($projects as $project)
                <option value="{{ $project->id }}">{{$project->name}}
                </option>
                @endforeach
            </select>
        </div>
        <button class="px-3 py-2 bg-green-600 text-white rounded">Save</button>
        <a href="{{ route('tasks.index') }}">Cancel</a>
    </form>
</div>
@endsection