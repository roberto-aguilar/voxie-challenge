<?php

namespace Tests\Unit\Http;

use App\Http\Kernel;
use App\Http\Middleware\EncryptCookies;
use Laravel\Passport\Http\Middleware\CreateFreshApiToken;
use Tests\TestCase;

class KernelTest extends TestCase
{
    /** @test */
    public function it_registers_a_create_fresh_api_token_middleware()
    {
        $groups = $this->app[Kernel::class]->getMiddlewareGroups();

        $this->assertArrayHasKey('web', $groups);
        $this->assertContains(CreateFreshApiToken::class, $groups['web']);
        $this->assertGreaterThan(
            array_search(EncryptCookies::class, $groups['web']),
            array_search(CreateFreshApiToken::class, $groups['web']),
            'The [EncryptCookies::class] middleware must be declared before the [CreateFreshApiToken::class] one.'
        );
    }
}
