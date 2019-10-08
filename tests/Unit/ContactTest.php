<?php

namespace Tests\Unit;

use App\Contact;
use App\CustomAttribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;

class ContactTest extends TestCase
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

        $this->model = new Contact;
    }

    /** @test */
    public function it_allows_the_team_id_to_be_fillable()
    {
        $this->assertContains('team_id', $this->model->getFillable());
    }

    /** @test */
    public function it_allows_the_unsubscribed_status_field_to_be_fillable()
    {
        $this->assertContains('unsubscribed_status', $this->model->getFillable());
    }

    /** @test */
    public function it_allows_the_first_name_field_to_be_fillable()
    {
        $this->assertContains('first_name', $this->model->getFillable());
    }

    /** @test */
    public function it_allows_the_last_name_field_to_be_fillable()
    {
        $this->assertContains('last_name', $this->model->getFillable());
    }

    /** @test */
    public function it_allows_the_phone_field_to_be_fillable()
    {
        $this->assertContains('phone', $this->model->getFillable());
    }

    /** @test */
    public function it_allows_the_email_field_to_be_fillable()
    {
        $this->assertContains('email', $this->model->getFillable());
    }

    /** @test */
    public function it_allows_the_sticky_phone_number_id_field_to_be_fillable()
    {
        $this->assertContains('sticky_phone_number_id', $this->model->getFillable());
    }

    /** @test */
    public function it_allows_the_twitter_id_field_to_be_fillable()
    {
        $this->assertContains('twitter_id', $this->model->getFillable());
    }

    /** @test */
    public function it_allows_the_fb_messenger_id_field_to_be_fillable()
    {
        $this->assertContains('fb_messenger_id', $this->model->getFillable());
    }

    /** @test */
    public function it_allows_the_time_zone_field_to_be_fillable()
    {
        $this->assertContains('time_zone', $this->model->getFillable());
    }

    /** @test */
    public function it_has_many_custom_attributes()
    {
        $relation = $this->model->customAttributes();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertInstanceOf(CustomAttribute::class, $relation->getRelated());
    }
}
