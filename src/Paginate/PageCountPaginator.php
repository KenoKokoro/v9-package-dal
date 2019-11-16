<?php

namespace V9\DAL\Paginate;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PageCountPaginator extends BasePaginator
{
    /**
     * @param LengthAwarePaginator $paginator
     * @return Pagination
     * @codeCoverageIgnore
     */
    public static function fromLengthAwarePaginator(LengthAwarePaginator $paginator): Pagination
    {
        return new self($paginator);
    }

    public function toArray(): array
    {
        return [
            'current_page' => $this->paginator()->currentPage(),
            'data' => $this->paginator()->items(),
            'from' => $this->paginator()->firstItem(),
            'last_page' => $this->paginator()->lastPage(),
            'per_page' => $this->paginator()->perPage(),
            'to' => $this->paginator()->lastItem(),
            'total' => $this->paginator()->total(),
        ];
    }
}
