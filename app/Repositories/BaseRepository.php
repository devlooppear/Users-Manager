<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;

class BaseRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all models with pagination.
     *
     * @param int $perPage
     * @param string|null $searchColumn
     * @param string|null $searchValue
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage = 15, ?string $searchColumn = null, ?string $searchValue = null): LengthAwarePaginator
    {
        $query = $this->model->newQuery();

        if ($searchColumn && $searchValue) {
            $query->where($searchColumn, 'LIKE', "%{$searchValue}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Get all models.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Find a model by its ID.
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * Create a new model.
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * Update an existing model.
     *
     * @param int $id
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(int $id, array $attributes): ?Model
    {
        $model = $this->find($id);

        if ($model) {
            $model->update($attributes);
            return $model;
        }

        return null;
    }

    /**
     * Delete a model.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $model = $this->find($id);

        if ($model) {
            return $model->delete();
        }

        return false;
    }

    /**
     * Search models by a given column and value.
     *
     * @param string $column
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function search(string $column, string $value)
    {
        if (Schema::hasColumn($this->model->getTable(), $column)) {
            return $this->model->where($column, 'LIKE', "%{$value}%")->get();
        }

        return collect();
    }
}
