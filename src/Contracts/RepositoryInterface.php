<?php

namespace V9\DAL\Contracts;

use Illuminate\Database\Eloquent\ModelNotFoundException;

interface RepositoryInterface
{
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
}
