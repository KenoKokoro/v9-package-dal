<?php declare(strict_types=1);

namespace V9\DAL\Traits;

use Illuminate\Support\Str;
use V9\DAL\Contracts\BaseModelInterface;

trait UuidModel
{
    protected static function boot(): void
    {
        parent::boot();

        static::creating(static::createdCallback());
    }

    protected static function createdCallback(): callable
    {
        return function(BaseModelInterface $model) {
            /** @var self $model */
            $model->{$model->getKeyName()} = (string)Str::uuid();
        };
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }

    public function getKeyName(): string
    {
        return 'uuid';
    }
}
