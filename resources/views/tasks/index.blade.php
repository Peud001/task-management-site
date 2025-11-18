<x-layout>
    <div class="mb-8 flex items-center justify-between">
        <div></div>
        <div class="flex items-center gap-4">
            <form method="GET" action="{{ route('tasks.index') }}">
                <select name="project_id"
                        onchange="this.form.submit()"
                        class="border border-slate-300 bg-white/80 backdrop-blur-sm p-2.5 rounded-xl shadow-sm text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                    <option value="">All Projects</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}"
                            {{ (string) $projectId === (string) $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
            </form>
            <a href="{{ route('tasks.create') }}"
               class="px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-500 text-white rounded-xl shadow-md hover:shadow-lg hover:from-indigo-500 hover:to-indigo-600 transition font-medium">
                + Add Task
            </a>
        </div>
    </div>
    <div class="bg-white rounded-2xl shadow-xl border border-slate-200 p-6">
        @if ($tasks->isEmpty())
            <div class="text-center py-20 text-slate-500">
                <div
                    class="w-20 h-20 bg-gradient-to-br from-slate-100 to-slate-200 rounded-2xl mx-auto flex items-center justify-center mb-6 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-400" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M9 12h6m-6 4h6m2 5H7a3 3 0 01-3-3V6a3 
                              3 0 013-3h5.5a1 1 0 01.7.3l5.5 5.5a1 
                              1 0 01.3.7V18a3 3 0 01-3 3z" />
                    </svg>
                </div>

                <p class="text-xl font-semibold text-slate-700">No tasks available</p>
                <p class="text-sm text-slate-500 mt-1 mb-8">Start organizing your workflow by creating your first task.</p>
                <a href="{{ route('tasks.create') }}"
                   class="px-4 py-2.5 bg-indigo-600 text-white rounded-xl shadow hover:bg-indigo-700 transition font-medium">
                    + Create Task
                </a>
            </div>
        @else
            <ul id="task-list" class="space-y-4">
                @foreach ($tasks as $task)
                    <li data-id="{{ $task->id }}"
                        class="p-5 border border-slate-200 bg-white rounded-xl shadow-sm hover:shadow-md hover:border-indigo-300 transition flex justify-between items-start">
                        <div class="flex flex-col gap-1">
                            <span class="inline-block w-fit text-xs font-medium bg-slate-900 text-white px-2 py-1 rounded-lg tracking-wide priority">
                                Priority: {{ $task->priority }}
                            </span>
                            <div class="text-slate-800 font-semibold text-base leading-tight">
                                {{ $task->name }}
                            </div>
                            @if ($task->project)
                                <div class="text-xs text-slate-500 mt-1">
                                    Project:
                                    <span class="font-medium text-slate-700">
                                        {{ $task->project->name }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('tasks.edit', $task) }}"
                               class="px-3 py-1.5 bg-amber-100 text-amber-900 rounded-lg hover:bg-amber-200 transition text-sm font-medium">
                                Edit
                            </a>
                            <form method="POST"
                                  action="{{ route('tasks.destroy', $task) }}"
                                  onsubmit="return confirm('Are you sure you want to delete this task?')">
                                @csrf
                                @method('DELETE')
                                <button
                                    class="px-3 py-1.5 bg-rose-100 text-rose-900 rounded-lg hover:bg-rose-200 
                                           transition text-sm font-medium">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    @push('scripts')
        <script src="/js/tasks.js"></script>
    @endpush

</x-layout>
