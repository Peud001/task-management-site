<x-layout>

    <div class="bg-white rounded-xl shadow-lg p-6 max-w-lg mx-auto border border-slate-200">

        <h2 class="text-xl font-semibold text-slate-800 mb-6">Edit Task</h2>

        <form method="POST" action="{{ route('tasks.update', $task) }}">
            @csrf
            @method('put')
            <div class="mb-5">
                <label class="block text-sm font-medium text-slate-600 mb-1">Task Name</label>
                <input name="name"
                       value="{{ $task->name }}"
                       required
                       class="w-full border border-slate-300 p-2.5 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            </div>
            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-600 mb-1">Project</label>

                <select name="project_id"
                        class="w-full border border-slate-300 p-2.5 rounded-lg shadow-sm
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                    <option value="">None</option>

                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}"
                            {{ $task->project_id == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center gap-3">
                <button class="px-4 py-2.5 bg-indigo-600 text-white rounded-lg shadow
                               hover:bg-indigo-700 transition">
                    Save Changes
                </button>

                <a href="{{ route('tasks.index') }}"
                   class="text-indigo-600 hover:underline">
                    Cancel
                </a>
            </div>
        </form>
    </div>

</x-layout>
