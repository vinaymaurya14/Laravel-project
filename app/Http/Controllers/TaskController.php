<?php

namespace App\Http\Controllers;
use App\Http\Requests\Task\StoreRequest;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\Task\UpdateRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::orderBy('is_completed')
            ->orderBy('id')
            ->get();

            return view('task.index')->with(compact('tasks'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('task.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $task = DB::transaction(fn() => Task::create($request->validated()));

        return to_route('tasks.index'); 
        //
    }

    public function show(Task $task)
    {
        return view('task.show')->with(compact('task'));
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        DB::transaction(fn() => $task->delete());
    
        return to_route('tasks.index');
    }
    

    public function edit(Task $task)
    {
        return view('task.edit')->with(compact('task'));
    }

    public function update(UpdateRequest $request, Task $task)
    {
        DB::transaction(fn() => $task->update($request->validated()));
    
        return to_route('tasks.index');
    }
    public function complete(Task $task)
    {
        DB::transaction(fn() => $task->update(['is_completed' => true]));
        dd($task); // Dump and Die to debug

        return to_route('tasks.index');
    }

    public function yetComplete(Task $task)
    {
        DB::transaction(fn() => $task->update(['is_completed' => false]));

        return to_route('tasks.index');
    }

}
