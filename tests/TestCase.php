<?php

namespace GitItWrite\Tests;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;

/**
 * Base test case for Git It Write plugin
 */
abstract class TestCase extends PHPUnitTestCase
{
    /**
     * Setup test environment
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Teardown test environment
     */
    protected function tearDown(): void
    {
        parent::tearDown();
    }
}
