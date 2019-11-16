<?php

namespace V9\Tests\DAL\Unit\Paginate;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Mockery as m;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use V9\DAL\Paginate\PageCountPaginator;
use V9\DAL\Paginate\Pagination;

class PageCountPaginatorTest extends TestCase
{
    private const EXPECTED_ARRAY = [
        'current_page' => 2,
        'data' => ['item1'],
        'from' => 10,
        'last_page' => 4,
        'per_page' => 10,
        'to' => 20,
        'total' => 35,
    ];

    /**
     * @var MockInterface|LengthAwarePaginator
     */
    private MockInterface $paginator;

    private Pagination $fixture;

    protected function setUp(): void
    {
        parent::setUp();
        $this->paginator = m::mock(LengthAwarePaginator::class);
        $this->fixture = PageCountPaginator::fromLengthAwarePaginator($this->paginator);
    }

    /** @test */
    public function page_count_paginator_should_return_array_response(): void
    {
        $this->generalMock();
        $actual = $this->fixture->toArray();
        self::assertEquals(self::EXPECTED_ARRAY, $actual);
    }

    /** @test */
    public function page_count_paginator_should_return_json_serialize_attributes(): void
    {
        $this->generalMock();
        $actual = $this->fixture->jsonSerialize();
        self::assertEquals(self::EXPECTED_ARRAY, $actual);
    }

    /** @test */
    public function page_count_paginator_should_return_json_encoded_results(): void
    {
        $this->generalMock();
        $actual = $this->fixture->toJson();
        self::assertEquals(json_encode(self::EXPECTED_ARRAY), $actual);
    }

    private function generalMock(): void
    {
        $this->paginator
            ->shouldReceive('currentPage')
            ->once()
            ->andReturn(2);
        $this->paginator
            ->shouldReceive('items')
            ->once()
            ->andReturn(['item1']);
        $this->paginator
            ->shouldReceive('firstItem')
            ->once()
            ->andReturn(10);
        $this->paginator
            ->shouldReceive('lastPage')
            ->once()
            ->andReturn(4);
        $this->paginator
            ->shouldReceive('perPage')
            ->once()
            ->andReturn(10);
        $this->paginator
            ->shouldReceive('lastItem')
            ->once()
            ->andReturn(20);
        $this->paginator
            ->shouldReceive('total')
            ->once()
            ->andReturn(35);

    }
}
