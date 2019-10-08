<?php

namespace Tests\Feature\Api;

use App\Contact;
use App\ContactFile;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ContactFileMappingsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_can_not_update_contact_file_field_mappings()
    {
        $file = factory(Contact::class)->create();

        $this->assertGuest();

        $response = $this->patchJson("/api/contacts/files/{$file->id}/mappings");

        $response->assertUnauthorized();
    }

    /** @test */
    public function users_can_update_contact_file_field_mappings()
    {
        $user = factory(User::class)->create();
        $file = factory(ContactFile::class)->create();

        $this->assertNull($file->field_mappings);

        Passport::actingAs($user);
        $response = $this->patchJson("/api/contacts/files/{$file->id}/mappings", [
            'field_mappings' => $fieldMappings = [
                'first_name' => 'first_name',
                'last_name' => 'last_name',
                'foo' => 'custom-attribute',
            ]
        ]);

        $response->assertOk()
            ->assertJsonFragment([
                'id' => $file->id,
                'field_mappings' => $fieldMappings,
            ]);
    }
}
