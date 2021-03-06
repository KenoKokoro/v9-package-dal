<?php

namespace V9\DAL\Paginate;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use JsonSerializable;

interface Pagination extends Jsonable, Arrayable, JsonSerializable
{
    /**
     * Get the items in the pagination
     * @return Collection
     */
    public function items(): Collection;
}
