<?php

namespace Tests\Unit;

use App\ContactUpload;
use App\ContactFile;
use App\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Passport\HasApiTokens;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * @var \App\User
     */
    protected $model;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->model = new User;
    }

    /** @test */
    public function it_allows_the_name_to_be_fillable()
    {
        $this->assertContains('name', $this->model->getFillable());
    }

    /** @test */
    public function it_allows_the_email_to_be_fillable()
    {
        $this->assertContains('email', $this->model->getFillable());
    }

    /** @test */
    public function it_allows_the_password_to_be_fillable()
    {
        $this->assertContains('password', $this->model->getFillable());
    }

    /** @test */
    public function it_hides_the_password_field_from_serialization()
    {
        $this->assertContains('password', $this->model->getHidden());
    }

    /** @test */
    public function it_hides_the_remember_token_field_from_serialization()
    {
        $this->assertContains('remember_token', $this->model->getHidden());
    }

    /** @test */
    public function it_has_passport_api_tokens()
    {
        $traits = class_uses($this->model);

        $this->assertContains(HasApiTokens::class, $traits);
    }

    /** @test */
    public function it_has_many_file_uploads()
    {
        $relation = $this->model->files();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertInstanceOf(ContactFile::class, $relation->getRelated());
    }
}
