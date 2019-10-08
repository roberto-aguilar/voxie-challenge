<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewContactIndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_can_not_browse_to_the_contacts_index_view()
    {
        $this->assertGuest();

        $response = $this->get('/contacts');

        $response->assertRedirect('/login');
    }

    /** @test */
    public function users_can_browse_to_the_contacts_index_view()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/contacts');

        $response->assertOk()
                ->assertViewIs('contacts.index');
    }
}
