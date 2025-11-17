@extends('layouts.app')

@section('content')
<div class="mb-4 flex items-center justify-between">

    <a href="{{ route('tasks.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">Create Task</a>

    <form method="GET" action="{{ route('tasks.index') }}" class="flex items-center">
        <select name="project_id" onchange="this.form.submit()" class="border p-2 rounded">
            <option value="">All projects</option>
            @foreach ($projects as $project)
            <option value="{{ $project->id }}"
                {{ (string) $projectId === (string) $project->id? 'selected' : '' }}>
                {{ $project->name }}
            </option>
            @endforeach
            </select> 
    </form>
</div>

<div class="bg-white rounded shadow p-4">
    <ul id="task-list" class="space-y-2">
        @foreach ($tasks as $task)
        <li data-id="(($task->id))" class="p-3 border rounded flex  justify-between items-center">
            <div>
                <div class="text-sm text-gray-500">
                    #{{ $task->priority }}
                </div>
                <div class="font-medium">
                    {{ $task->name }}
                </div>

                @if ($task->product)
                <div class="text-xs text-gray-400">
                    {{ $task->product->name }}
                </div>
                @endif
            </div>
            <div class="space-x-2">
                <a href="{{ route('tasks.edit', $task)}}" class="px-2 py-1 bg-yellow-200 rounded">
                    Edit
                </a>
            </div>
            <form method="POST" action="{{ route('task.destroy', task) }}" class="inline" onsubmit="return confirm('Delete task?')">
                @csrf
                @method('DELETE')
                <button class="px-2 py-1 bg-red-200 rounded">
                    Delete
                </button>
            </form>
        </li>
        @endforeach
    </ul>
</div>

@endsection

@push('scripts')
<script src="/js/tasks.js"></script>
@endpush