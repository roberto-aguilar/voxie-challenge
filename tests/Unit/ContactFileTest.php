<?php

namespace Tests\Unit;

use App\ContactFile;
use Tests\TestCase;

class ContactFileTest extends TestCase
{
    /**
     * @var \App\ContactFile
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

        $this->model = new ContactFile;
    }

    /** @test */
    public function it_allows_the_path_to_be_fillable()
    {
        $this->assertContains('path', $this->model->getFillable());
    }

    /** @test */
    public function it_allows_the_name_to_be_fillable()
    {
        $this->assertContains('name', $this->model->getFillable());
    }

    /** @test */
    public function it_allows_the_fields_mapping_to_be_fillable()
    {
        $this->assertContains('field_mappings', $this->model->getFillable());
    }

    /** @test */
    public function it_casts_the_field_mappings_into_json()
    {
        $this->assertArrayHasKey('field_mappings', $this->model->getCasts());
        $this->assertEquals('json', $this->model->getCasts()['field_mappings']);
    }
}
