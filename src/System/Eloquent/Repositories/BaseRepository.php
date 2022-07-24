<?php declare(strict_types=1);

namespace System\Eloquent\Repositories;

use Illuminate\Container\Container as Application;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    private readonly Model $model;

    public function __construct(
        private readonly Application $app
    ) {
        $this->model = $this->makeModel();
    }

    abstract public function model(): string;

    private function makeModel(): Model
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new \InvalidArgumentException(
                "Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model"
            );
        }

        return $model;
    }

    public function find(int|string $id): Model|null
    {
        return $this->model->newQuery()->find($id);
    }
}
