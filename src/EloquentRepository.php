<?php declare(strict_types=1);

namespace V9\DAL;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use V9\DAL\Contracts\BaseModelInterface;
use V9\DAL\Contracts\RepositoryInterface;

class EloquentRepository implements RepositoryInterface
{
    /**
     * @var BaseModelInterface
     */
    private BaseModelInterface $model;

    public function __construct(BaseModelInterface $model)
    {
        $this->model = $model;
    }

    /**
     * @param int   $uuid
     * @param array $columns
     * @param array $relations
     * @return BaseModelInterface|Model
     * @throws ModelNotFoundException
     */
    public function findById(int $uuid, array $columns = ['*'], array $relations = []): BaseModelInterface
    {
        return $this->newQuery()->select($columns)->with($relations)->findOrFail($uuid);
    }

    /**
     * @param string $uuid
     * @param array  $columns
     * @param array  $relations
     * @return BaseModelInterface|Model
     * @throws ModelNotFoundException
     */
    public function findByUuid(string $uuid, array $columns = ['*'], array $relations = []): BaseModelInterface
    {
        return $this->newQuery()->select($columns)->with($relations)->findOrFail($uuid);
    }

    /**
     * @param array $criteria
     * @param array $columns
     * @param array $relations
     * @return BaseModelInterface|Model
     * @throws ModelNotFoundException
     */
    public function findByCriteria(array $criteria, array $columns = ['*'], array $relations = []): BaseModelInterface
    {
        return $this->newQuery()->select($columns)->with($relations)->where($criteria)->firstOrFail();
    }

    /**
     * @param array $attributes
     * @return BaseModelInterface|Model
     */
    public function create(array $attributes): BaseModelInterface
    {
        return $this->newQuery()->create($attributes);
    }

    public function update(BaseModelInterface $model, array $attributes): void
    {
        foreach ($attributes as $column => $value) {
            $model->{$column} = $value;
        }

        $model->save();
    }

    public function newQuery(): Builder
    {
        return $this->model->newQuery();
    }
}
