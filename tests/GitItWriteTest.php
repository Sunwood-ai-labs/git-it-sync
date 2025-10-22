<?php

namespace GitItWrite\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Simple basic tests for Git It Sync plugin
 */
class GitItWriteTest extends TestCase
{
    /**
     * Test plugin version constant is defined
     */
    public function testPluginVersionConstant()
    {
        $this->assertTrue(defined('GIW_VERSION'));
        $this->assertEquals('2.0', GIW_VERSION);
    }

    /**
     * Test plugin path constant is defined
     */
    public function testPluginPathConstant()
    {
        $this->assertTrue(defined('GIW_PATH'));
        $this->assertIsString(GIW_PATH);
    }

    /**
     * Test plugin admin URL constant is defined
     */
    public function testPluginAdminUrlConstant()
    {
        $this->assertTrue(defined('GIW_ADMIN_URL'));
        $this->assertIsString(GIW_ADMIN_URL);
    }

    /**
     * Test WordPress ABSPATH constant is defined
     */
    public function testAbspathConstant()
    {
        $this->assertTrue(defined('ABSPATH'));
    }

    /**
     * Test basic PHP functionality
     */
    public function testBasicPhpFunctionality()
    {
        // Test that basic PHP functions work
        $this->assertTrue(function_exists('array_merge'));
        $this->assertTrue(function_exists('json_encode'));
        $this->assertTrue(function_exists('htmlspecialchars'));
    }

    /**
     * Test WordPress mock functions exist
     */
    public function testWordPressMockFunctionsExist()
    {
        $this->assertTrue(function_exists('plugin_dir_path'));
        $this->assertTrue(function_exists('plugin_dir_url'));
        $this->assertTrue(function_exists('get_option'));
        $this->assertTrue(function_exists('add_action'));
        $this->assertTrue(function_exists('add_filter'));
    }
}
