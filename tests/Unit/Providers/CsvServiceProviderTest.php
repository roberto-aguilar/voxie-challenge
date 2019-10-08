<?php

namespace Tests\Unit\Providers;

use App\Providers\CsvServiceProvider;
use App\Support\CsvFactory;
use App\Support\LeagueCsvFactory;
use Tests\TestCase;

class CsvServiceProviderTest extends TestCase
{
    /**
     * @var \App\Providers\CsvServiceProvider
     */
    protected $serviceProvider;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->serviceProvider = new CsvServiceProvider($this->app);
    }

    /** @test */
    public function it_is_deferrable()
    {
        $this->assertTrue($this->serviceProvider->isDeferred());
    }

    /** @test */
    public function it_provides_an_implementation_for_the_csv_factory()
    {
        $this->assertContains(CsvFactory::class, $this->serviceProvider->provides());
    }

    /** @test */
    public function it_binds_the_league_csv_factory_to_the_csv_factory_interface()
    {
        $this->assertTrue($this->app->bound(CsvFactory::class));
        $this->assertInstanceOf(LeagueCsvFactory::class, $this->app->make(CsvFactory::class));
    }
}
