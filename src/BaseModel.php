<?php

namespace V9\DAL;

use Illuminate\Database\Eloquent\Model;
use V9\DAL\Contracts\BaseModelInterface;
use V9\DAL\Traits\UuidModel;

/**
 * @property string uuid
 */
abstract class BaseModel extends Model implements BaseModelInterface
{
    use UuidModel;

    const DB_TRUE = true;
    const DB_FALSE = false;
}
