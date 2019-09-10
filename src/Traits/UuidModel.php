<?php

namespace V9\DAL\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait UuidModel
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function(Model $model) {
            $model->{$model->getKeyName()} = (string)Str::uuid();
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public function getKeyName()
    {
        return 'uuid';
    }
}
