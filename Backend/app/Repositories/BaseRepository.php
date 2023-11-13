<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class BaseRepository
{
    abstract function model(): Model;


    protected function findOrFail($id): Model
    {
        return $this->model()::findOrFail($id);
    }

    protected function first($id): ?Model
    {
        return $this->model()::first($id);
    }

    protected function firstOrFail($id): Model|ModelNotFoundException
    {
        return $this->model()::firstOrFail($id);
    }



    protected function create(array $modelData): Model
    {
        return $this->model()::create($modelData);
    }

    protected function update(Model $model, array $modelData): bool
    {
        return $model->update($modelData);
    }

    protected function findAndUpdate($id, array $modelData): bool
    {
        return $this->findOrFail($id)->update($modelData);
    }


    public function getAll(): Collection
    {
        return $this->model()::all();
    }

    public function paginate(int $parPage = 20): LengthAwarePaginator
    {
        return $this->model()::paginate($parPage);
    }
}
