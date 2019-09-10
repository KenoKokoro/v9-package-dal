<?php

namespace V9\DAL\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface BaseModelInterface
{
    /**
     * @return Builder
     */
    public function newQuery();

    /**
     * @param array $options
     * @return bool
     */
    public function save(array $options = []);
}
