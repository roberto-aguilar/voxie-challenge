<?php

namespace Tests\Feature\Api;

use App\ContactFile;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ContactFileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_can_not_create_contact_files()
    {
        $this->assertGuest();

        $response = $this->postJson('/api/contacts/files');

        $response->assertUnauthorized();
    }

    /** @test */
    public function users_can_create_contact_files()
    {
        $user = factory(User::class)->create();
        $sourceFile = UploadedFile::fake()->create('contacts.csv', 1);

        Passport::actingAs($user);

        $response = $this->postJson('/api/contacts/files', [
            'file' => $sourceFile,
        ]);

        $response->assertStatus(Response::HTTP_CREATED);

        tap(ContactFile::first(), function ($contactFile) use ($sourceFile, $response) {
            $this->assertNotNull($contactFile);
            $response->assertJsonFragment([
                'id' => $contactFile->id,
                'name' => $sourceFile->name,
            ]);
        });
    }
}
