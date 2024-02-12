<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface TaskRepositoryInterface
{
    /**
     * Retrieve all tasks.
     *
     * @return Collection|Task[]
     */
    public function index(): Collection;

    /**
     * Find a task by its primary key.
     *
     * @param int $id
     * @throws ModelNotFoundException if no model is found.
     * @return Task
     */
    public function find(int $id): Task;

    /**
     * Store a new task in the database.
     *
     * @param array $data Data to create a new task.
     * @return Task The newly created task model instance.
     */
    public function store(array $data): Task;

    /**
     * Update an existing task.
     *
     * @param int $id The task ID to update.
     * @param array $data Data to update the task.
     * @throws ModelNotFoundException if no model is found.
     * @return Task The updated task model instance.
     */
    public function update(int $id, array $data): Task;

    /**
     * Delete a task by its primary key.
     *
     * @param int $id The task ID to delete.
     * @throws ModelNotFoundException if no model is found.
     * @return bool `true` on success, `false` on failure.
     */
    public function delete(int $id): bool;
}
