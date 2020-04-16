<?php

namespace ScheMeZa\SMSPortal\Tests;

use Orchestra\Testbench\TestCase;
use ScheMeZa\SMSPortal\SMSPortalServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [SMSPortalServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
