<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projectId = $request->query('project_id');
        $projects = Project::orderBy('name')->get();

        $query = Task::query();

        if ($projectId){
            $query->where('project_id', $projectId);
        }

        $tasks = $query->orderBy('priority')->get();

        return view('tasks.index', compact('tasks', 'projects', 'projectId'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $projects = Project::orderBy('name')->get();
        return view('tasks.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();

        $maxPriority = Task::max('priority');
        $data['priority'] = $maxPriority? $maxPriority + 1 : 1;

        Task::create($data);

        return redirect()->route('tasks.index');
    }

    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $products = Project::orderBy('name')->get();
        return view('task.edit', compact('task', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreTaskRequest $request, Task $task)
    {
        $task->update($request->validated());
        return redirect()->route('task.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        DB::transaction(function() use ($task){
            $priority = $task->priority;
            $task->delete();
            
            Task::where('priority', '>', $priority)->decrement('priority');
        });

        return redirect()->route('tasks.index');
    }

    //reordering
    public function reorder(Request $request){
        $order = $request->input('order', []);
        if(!is_array($order)){
            return response()->json(['message '=> 'invalid payload'], 400);
        }

        DB::transaction(function() use ($order){
            foreach($order as $index => $id){
                Task::where('id', $id)->update(['priority' => $index+1]);
            }
        });
        return response()->json(['message' => 'ok']);
    }
}
