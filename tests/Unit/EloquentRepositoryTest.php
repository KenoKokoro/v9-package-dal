<?php declare(strict_types=1);

namespace V9\Tests\DAL\Unit;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mockery as m;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;
use V9\DAL\Contracts\BaseModelInterface;
use V9\DAL\Contracts\RepositoryInterface;
use V9\DAL\EloquentRepository;
use V9\Tests\DAL\Stub\ModelStub;

class EloquentRepositoryTest extends TestCase
{
    private MockInterface $model;

    private MockInterface $builder;

    private EloquentRepository $fixture;

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = m::mock(ModelStub::class);
        $this->builder = m::mock(Builder::class);
        $this->fixture = new EloquentRepository($this->model);
    }

    /** @test */
    public function should_create_eloquent_repository_instance(): void
    {
        self::assertInstanceOf(RepositoryInterface::class, $this->fixture);
    }

    /** @test */
    public function should_find_record_by_id_from_eloquent_repository(): void
    {
        $this->builder
            ->shouldReceive('select')
            ->once()
            ->with(['uuid', 'name'])
            ->andReturnSelf();
        $this->builder
            ->shouldReceive('with')
            ->once()
            ->with(['relation1', 'relation2'])
            ->andReturnSelf();
        $this->builder
            ->shouldReceive('with')
            ->once()
            ->with(['relation1', 'relation2'])
            ->andReturnSelf();
        $this->builder
            ->shouldReceive('findOrFail')
            ->once()
            ->with(1)
            ->andReturn(m::mock(ModelStub::class));
        $this->model
            ->shouldReceive('newQuery')
            ->once()
            ->andReturn($this->builder);

        $actual = $this->fixture->findById(1, ['uuid', 'name'], ['relation1', 'relation2']);
        self::assertInstanceOf(BaseModelInterface::class, $actual);
    }

    /** @test */
    public function should_throw_exception_when_finding_by_id_if_record_does_not_exists(): void
    {
        self::expectException(ModelNotFoundException::class);

        $this->builder
            ->shouldReceive('select')
            ->once()
            ->andReturnSelf();
        $this->builder
            ->shouldReceive('with')
            ->once()
            ->andReturnSelf();
        $this->builder
            ->shouldReceive('findOrFail')
            ->once()
            ->with(1)
            ->andThrow(new ModelNotFoundException);
        $this->model
            ->shouldReceive('newQuery')
            ->once()
            ->andReturn($this->builder);

        $this->fixture->findById(1, ['uuid', 'name'], ['relation1', 'relation2']);
    }

    /** @test */
    public function should_find_record_by_uuid_from_eloquent_repository(): void
    {
        $this->builder
            ->shouldReceive('select')
            ->once()
            ->with(['uuid', 'name'])
            ->andReturnSelf();
        $this->builder
            ->shouldReceive('with')
            ->once()
            ->with(['relation1', 'relation2'])
            ->andReturnSelf();
        $this->builder
            ->shouldReceive('with')
            ->once()
            ->with(['relation1', 'relation2'])
            ->andReturnSelf();
        $this->builder
            ->shouldReceive('findOrFail')
            ->once()
            ->with('uuid-value')
            ->andReturn(m::mock(ModelStub::class));
        $this->model
            ->shouldReceive('newQuery')
            ->once()
            ->andReturn($this->builder);

        $actual = $this->fixture->findByUuid('uuid-value', ['uuid', 'name'], ['relation1', 'relation2']);
        self::assertInstanceOf(BaseModelInterface::class, $actual);
    }

    /** @test */
    public function should_throw_exception_when_finding_by_uuid_if_record_does_not_exists(): void
    {
        self::expectException(ModelNotFoundException::class);

        $this->builder
            ->shouldReceive('select')
            ->once()
            ->andReturnSelf();
        $this->builder
            ->shouldReceive('with')
            ->once()
            ->andReturnSelf();
        $this->builder
            ->shouldReceive('findOrFail')
            ->once()
            ->with('uuid-value')
            ->andThrow(new ModelNotFoundException);
        $this->model
            ->shouldReceive('newQuery')
            ->once()
            ->andReturn($this->builder);

        $this->fixture->findByUuid('uuid-value', ['uuid', 'name'], ['relation1', 'relation2']);
    }

    /** @test */
    public function should_find_record_by_the_given_criteria_from_eloquent_repository(): void
    {
        $this->builder
            ->shouldReceive('select')
            ->once()
            ->with(['uuid', 'name'])
            ->andReturnSelf();
        $this->builder
            ->shouldReceive('with')
            ->once()
            ->with(['relation1', 'relation2'])
            ->andReturnSelf();
        $this->builder
            ->shouldReceive('where')
            ->once()
            ->with(['column1' => 'value', 'column2' => 2])
            ->andReturnSelf();
        $this->builder
            ->shouldReceive('firstOrFail')
            ->once()
            ->andReturn(m::mock(ModelStub::class));
        $this->model
            ->shouldReceive('newQuery')
            ->once()
            ->andReturn($this->builder);

        $actual = $this->fixture->findByCriteria(
            ['column1' => 'value', 'column2' => 2],
            ['uuid', 'name'],
            ['relation1', 'relation2']
        );
        self::assertInstanceOf(BaseModelInterface::class, $actual);
    }

    /** @test */
    public function should_throw_exception_when_finding_by_the_given_criteria_if_record_does_not_exists(): void
    {
        self::expectException(ModelNotFoundException::class);

        $this->builder
            ->shouldReceive('select')
            ->once()
            ->andReturnSelf();
        $this->builder
            ->shouldReceive('with')
            ->once()
            ->andReturnSelf();
        $this->builder
            ->shouldReceive('where')
            ->once()
            ->with(['column1' => 'value1'])
            ->andReturnSelf();
        $this->builder
            ->shouldReceive('firstOrFail')
            ->once()
            ->andThrow(new ModelNotFoundException);
        $this->model
            ->shouldReceive('newQuery')
            ->once()
            ->andReturn($this->builder);

        $this->fixture->findByCriteria(['column1' => 'value1'], ['uuid', 'name'], ['relation1', 'relation2']);
    }

    /** @test */
    public function should_create_new_record_on_eloquent_repository(): void
    {
        $this->builder
            ->shouldReceive('create')
            ->once()
            ->with(['column1' => 'value1', 'column2' => 'value2'])
            ->andReturn(m::mock(ModelStub::class));
        $this->model
            ->shouldReceive('newQuery')
            ->once()
            ->andReturn($this->builder);

        $actual = $this->fixture->create(['column1' => 'value1', 'column2' => 'value2']);
        self::assertInstanceOf(BaseModelInterface::class, $actual);
    }

    /** @test */
    public function should_update_the_given_record_on_eloquent_repository(): void
    {
        $this->model
            ->shouldReceive('setAttribute')
            ->once()
            ->with('column1', 'value1');
        $this->model
            ->shouldReceive('setAttribute')
            ->once()
            ->with('column2', 'value2');
        $this->model
            ->shouldReceive('save')
            ->once();

        $this->fixture->update($this->model, ['column1' => 'value1', 'column2' => 'value2']);
        self::assertTrue(true);
    }

    /** @test */
    public function should_create_new_query_on_eloquent_repository(): void
    {
        $this->model
            ->shouldReceive('newQuery')
            ->once()
            ->andReturn($this->builder);

        $actual = $this->fixture->newQuery();
        self::assertInstanceOf(Builder::class, $actual);
    }
}
