<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * Get all tasks.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * Find a task by its ID.
     *
     * @param int $id
     * @return Task|null
     */
    public function find($id)
    {
        return Task::find($id);
    }

    /**
     * Store a new task.
     *
     * @param array $data
     * @return Task
     */
    public function store(array $data)
    {
        return Task::create($data);
    }

    /**
     * Update an existing task.
     *
     * @param int $id
     * @param array $data
     * @return Task
     */
    public function update($id, array $data)
    {
        $task = $this->find($id);
        if ($task) {
            $task->update($data);
        }
        return $task;
    }

    /**
     * Delete a task.
     *
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $task = $this->find($id);
        if ($task) {
            return $task->delete();
        }
        return false;
    }

    public function storeComment($taskId, array $data)
    {
        $task = $this->find($taskId);
        if ($task) {
            return $task->comments()->create($data);
        }

        // Handle the case where the task is not found
        // This might involve throwing an exception or returning null
        return null;
    }
}
