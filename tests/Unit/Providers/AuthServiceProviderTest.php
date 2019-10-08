<?php

namespace Tests\Unit\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Carbon;
use Laravel\Passport\Passport;
use Tests\TestCase;

class AuthServiceProviderTest extends TestCase
{
    /** @test */
    public function it_registers_the_access_tokens_passport_routes()
    {
        $route = $this->app[Router::class];

        $this->assertTrue($route->has('passport.token'));
        $this->assertTrue($route->has('passport.tokens.index'));
        $this->assertTrue($route->has('passport.tokens.destroy'));
    }

    /** @test */
    public function it_overrides_the_token_expiration_to_one_hour()
    {
        Carbon::setTestNow('now');

        $this->assertEquals(
            Carbon::getTestNow()->addHour()->timestamp,
            Passport::$tokensExpireAt->timestamp
        );
    }

    /** @test */
    public function it_ignores_the_default_migrations()
    {
        $this->assertFalse(Passport::$runsMigrations);
    }
}
