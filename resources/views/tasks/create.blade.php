<x-layout>

    <div class="bg-white rounded-xl shadow-lg p-6 max-w-lg mx-auto border border-slate-200">

        <h2 class="text-xl font-semibold text-slate-800 mb-6">Create New Task</h2>

        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf
            <div class="mb-5">
                <label class="block text-sm font-medium text-slate-600 mb-1">Task Name</label>
                <input name="name" required class="w-full border border-slate-300 p-2.5 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
            </div>

            <div class="mb-6 relative">
                <label class="block text-sm font-medium text-slate-600 mb-1">Project</label>
                <button type="button"
                        id="projectDropdownBtn"
                        class="w-full border border-slate-300 p-2.5 rounded-lg bg-white shadow-sm
                               flex justify-between items-center focus:ring-2 focus:ring-indigo-500 transition">
                    <span id="selectedProjectLabel" class="text-slate-700">Choose project</span>
                </button>

                <div id="projectDropdownPanel"
                     class="absolute left-0 right-0 bg-white border border-slate-200 rounded-xl shadow-xl p-3 mt-2 hidden z-50">
                    <div id="projectList" class="max-h-48 overflow-y-auto mb-3">
                        <div class="p-2 hover:bg-slate-100 cursor-pointer rounded"
                             data-id="">
                            None
                        </div>
                        @foreach ($projects as $project)
                            <div class="p-2 hover:bg-slate-100 cursor-pointer rounded"
                                 data-id="{{ $project->id }}">
                                {{ $project->name }}
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t my-2"></div>
                    <div class="flex gap-2 items-center">
                        <input id="newProjectInput"
                               class="flex-1 border border-slate-300 p-2 rounded-lg"
                               placeholder="New project">

                        <button type="button"
                                id="addProjectBtn"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                            Add
                        </button>
                    </div>
                </div>
                <select id="project_id" name="project_id" class="hidden">
                    <option value="">none</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>

                <span id="savingTag" class="text-xs text-slate-500 hidden mt-1 block">Saving...</span>
            </div>

            <button class="px-4 py-2.5 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                Save Task
            </button>

            <a href="{{ route('tasks.index') }}"
               class="ml-3 text-indigo-600 hover:underline">
                Cancel
            </a>
        </form>
    </div>

    @push('scripts')
        <script src="/js/project-dropdown.js"></script>
    @endpush

</x-layout>
