<?php

namespace App\Repositories;

interface TaskRepositoryInterface
{
    public function index();

    public function find($id);

    public function store(array $data);

    public function update($id, array $data);

    public function delete($id);
}
