<?php

namespace Tests\Unit;


use App\CustomAttribute;
use Tests\TestCase;

class CustomAttributeTest extends TestCase
{
    /**
     * @var \App\Contact
     */
    protected $model;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->model = new CustomAttribute;
    }

    /** @test */
    public function it_allows_the_key_to_be_fillable()
    {
        $this->assertContains('key', $this->model->getFillable());
    }

    /** @test */
    public function it_allows_the_value_field_to_be_fillable()
    {
        $this->assertContains('value', $this->model->getFillable());
    }

    /** @test */
    public function it_makes_the_key_field_visible_in_serialization()
    {
        $this->assertContains('key', $this->model->getVisible());
    }

    /** @test */
    public function it_makes_the_value_field_visible_in_serialization()
    {
        $this->assertContains('value', $this->model->getVisible());
    }
}
