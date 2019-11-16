<?php

namespace V9\DAL\Paginate;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

abstract class BasePaginator implements Pagination
{
    private LengthAwarePaginator $paginator;

    protected function __construct(LengthAwarePaginator $paginator)
    {
        $this->paginator = $paginator;
    }

    protected function paginator(): LengthAwarePaginator
    {
        return $this->paginator;
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
