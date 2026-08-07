<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Page tests render the root Blade view, which would otherwise need a
        // built Vite manifest in public/build. The tests are about the response,
        // not the asset pipeline, so stub the directives out.
        $this->withoutVite();
    }
}
