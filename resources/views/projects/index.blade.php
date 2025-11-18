@extends('layouts.app')

@section('content')
<div class="bg-white p-4 rounded shadow max-w-md mx-auto">
    <h1 class="tex-xl font-bold mb-4">Projects</h1>

    <form action="{{ route('projects.store') }}" method="POST" class="mb-4">
        @csrf
        <input name="name" class="border p-2 rounded w-full mb-2" placeholder="New project name" required>
        <button class="bg-blue-600 text-white px-3 rounded">Add Project</button>
    </form>

    <ul class="space-y-2">
        @foreach ($projects as $project)
        <li class="p-2 border rounded">
            {{ $project->name }}
        </li>
        @endforeach
    </ul>
</div>