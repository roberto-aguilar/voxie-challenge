<?php

namespace Tests\Feature\Api;

use App\Contact;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ContactTests extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_can_not_get_the_contact_index()
    {
        $this->assertGuest();

        $response = $this->getJson('/api/contacts');

        $response->assertUnauthorized();
    }

    /** @test */
    public function users_can_get_the_contact_index()
    {
        $user = factory(User::class)->create();
        $contacts = factory(Contact::class)->times(5)->create();

        Passport::actingAs($user);
        $response = $this->getJson('/api/contacts');

        $response->assertOk();

        $contacts->each(function ($contact) use ($response) {
            $response->assertJsonFragment([
                'id' => $contact->id,
                'first_name' => $contact->first_name,
                'last_name' => $contact->last_name,
                'email' => $contact->email,
                'custom_attributes' => [],
            ]);
        });
    }
}
