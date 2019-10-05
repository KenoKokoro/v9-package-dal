<?php

namespace V9\Tests\DAL\Stub;

use Illuminate\Database\Eloquent\Model;
use V9\DAL\Contracts\BaseModelInterface;
use V9\DAL\Traits\UuidModel;

class ModelStub extends Model implements BaseModelInterface
{
    use UuidModel;

    public function callbackStub(): callable
    {
        return static::createdCallback();
    }
}
