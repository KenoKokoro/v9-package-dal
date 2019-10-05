<?php declare(strict_types=1);

namespace V9\Tests\DAL\Unit\Traits;

use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use V9\Tests\DAL\Stub\ModelStub;

class UuidModelTest extends TestCase
{
    private ModelStub $fixture;

    protected function setUp(): void
    {
        parent::setUp();
        $this->fixture = new ModelStub;
    }

    /** @test */
    public function should_return_the_incrementing_setting_from_uuid_model_trait(): void
    {
        self::assertFalse($this->fixture->getIncrementing());
    }

    /** @test */
    public function should_return_the_key_type_setting_from_uuid_model_trait(): void
    {
        self::assertEquals('string', $this->fixture->getKeyType());
    }

    /** @test */
    public function should_return_the_key_name_setting_from_uuid_model_trait(): void
    {
        self::assertEquals('uuid', $this->fixture->getKeyName());
    }

    /** @test */
    public function should_set_the_uuid_on_creating_new_model_from_uuid_model_trait(): void
    {
        $callback = (new ModelStub)->callbackStub();
        $model = new ModelStub;
        $callback($model);

        self::assertTrue(Uuid::isValid($model->getKey()));
    }
}
