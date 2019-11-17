<?php

namespace V9\DAL\Paginate;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

abstract class BasePaginator implements Pagination
{
    /**
     * @var LengthAwarePaginator|\Illuminate\Pagination\LengthAwarePaginator
     */
    private LengthAwarePaginator $paginator;

    protected function __construct(LengthAwarePaginator $paginator)
    {
        $this->paginator = $paginator;
    }

    protected function paginator(): LengthAwarePaginator
    {
        return $this->paginator;
    }

    public function items(): Collection
    {
        return $this->paginator->getCollection();
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    public function toJson($options = 0): string
    {
        return json_encode($this->jsonSerialize(), $options);
    }
}
