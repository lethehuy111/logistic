<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractRepository
 *
 * @package Kenini\Repository
 */
class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * AbstractRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritdoc
     */
    public function find(array $conditions = [])
    {
        return $this->model->where($conditions)->get();
    }

    /**
     * @inheritdoc
     */
    public function findOne(array $conditions)
    {
        return $this->model->where($conditions)->first();
    }

    /**
     * @inheritdoc
     */
    public function findById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @inheritdoc
     */
    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * @inheritdoc
     */
    public function update(Model $model, array $attributes = []): bool
    {
        return $model->update($attributes);
    }

    /**
     * @inheritdoc
     */
    public function save(Model $model): bool
    {
        return $model->save();
    }

    /**
     * @inheritdoc
     */
    public function delete(Model $model): ?bool
    {
        return $model->delete();
    }
}
