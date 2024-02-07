<?php

namespace App\Http\Controllers;
use App\Http\Requests\Task\StoreRequest;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\Task\UpdateRequest;
use App\Repositories\TaskRepositoryInterface;

class TaskController extends Controller
{
    protected $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = $this->taskRepository->index();

        return view('task.index', compact('tasks'));
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
        $this->taskRepository->store($request->validated());

        return to_route('tasks.index');
        //
    }

    public function show($id)
    {
        $task = $this->taskRepository->find($id);
        if ($task) {
            $task->load('comments');
        }
    
        return view('task.show', compact('task'));
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->taskRepository->delete($id);

        return to_route('tasks.index');
    }
    

    public function edit($id)
    {
        $task = $this->taskRepository->find($id);

        return view('task.edit', compact('task'));
    }

    public function update(UpdateRequest $request, $id)
    {
        $this->taskRepository->update($id, $request->validated());

        return to_route('tasks.index');
    }
    public function complete($id)
    {
        $this->taskRepository->update($id, ['is_completed' => true]);

        return to_route('tasks.index');
    
    }

    public function yetComplete($id)
    {
        $this->taskRepository->update($id, ['is_completed' => false]);

        return to_route('tasks.index');
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate(['comment' => 'required|string']);

        $this->taskRepository->storeComment($id, ['comment' => $request->input('comment')]);
    
        return redirect()->route('tasks.show', $id);
    }
    

}
