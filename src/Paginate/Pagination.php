<?php

namespace V9\DAL\Paginate;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

interface Pagination extends Jsonable, Arrayable, JsonSerializable
{
}
