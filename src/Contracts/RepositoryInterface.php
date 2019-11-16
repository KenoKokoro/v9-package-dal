<?php declare(strict_types=1);

namespace V9\DAL\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface RepositoryInterface
{
    /**
     * @param int   $id
     * @param array $columns
     * @param array $relations
     * @return BaseModelInterface
     * @throws ModelNotFoundException
     */
    public function findById(int $id, array $columns = ['*'], array $relations = []): BaseModelInterface;

    /**
     * @param string $uuid
     * @param array  $columns
     * @param array  $relations
     * @return BaseModelInterface
     * @throws ModelNotFoundException
     */
    public function findByUuid(string $uuid, array $columns = ['*'], array $relations = []): BaseModelInterface;

    /**
     * @param array $criteria
     * @param array $columns
     * @param array $relations
     * @return BaseModelInterface
     * @throws ModelNotFoundException
     */
    public function findByCriteria(array $criteria, array $columns = ['*'], array $relations = []): BaseModelInterface;

    /**
     * @param array $criteria
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function getByCriteria(array $criteria, array $columns = ['*'], array $relations = []): Collection;

    /**
     * @param array $attributes
     * @return BaseModelInterface
     */
    public function create(array $attributes): BaseModelInterface;

    /**
     * @param BaseModelInterface $model
     * @param array              $attributes
     * @return void
     */
    public function update(BaseModelInterface $model, array $attributes): void;

    /**
     * @return Builder
     */
    public function newQuery(): Builder;
}
