<?php

namespace Tests\Unit\Config;

use Tests\TestCase;
use Illuminate\Config\Repository;

class AuthTest extends TestCase
{
    /** @test */
    public function it_defines_passport_as_api_guard_driver()
    {
        $config = $this->app[Repository::class];

        $this->assertEquals('passport', $config->get('auth.guards.api.driver'));
    }
}
