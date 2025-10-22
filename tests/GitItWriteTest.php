<?php

namespace GitItWrite\Tests;

use Brain\Monkey\Functions;

/**
 * Test case for main Git_It_Write class
 */
class GitItWriteTest extends TestCase
{
    /**
     * Test default config
     */
    public function testDefaultConfig()
    {
        $config = \Git_It_Write::default_config();

        $this->assertIsArray($config);
        $this->assertArrayHasKey('username', $config);
        $this->assertArrayHasKey('repository', $config);
        $this->assertArrayHasKey('folder', $config);
        $this->assertArrayHasKey('branch', $config);
        $this->assertArrayHasKey('post_type', $config);
        $this->assertArrayHasKey('post_author', $config);
        $this->assertArrayHasKey('content_template', $config);
        $this->assertArrayHasKey('last_publish', $config);

        // Test default values
        $this->assertEquals('', $config['username']);
        $this->assertEquals('', $config['repository']);
        $this->assertEquals('', $config['folder']);
        $this->assertEquals('master', $config['branch']);
        $this->assertEquals('', $config['post_type']);
        $this->assertEquals(1, $config['post_author']);
        $this->assertEquals('%%content%%', $config['content_template']);
        $this->assertEquals(0, $config['last_publish']);
    }

    /**
     * Test default general settings
     */
    public function testDefaultGeneralSettings()
    {
        $settings = \Git_It_Write::default_general_settings();

        $this->assertIsArray($settings);
        $this->assertArrayHasKey('webhook_secret', $settings);
        $this->assertArrayHasKey('github_username', $settings);
        $this->assertArrayHasKey('github_access_token', $settings);

        // Test default values
        $this->assertEquals('', $settings['webhook_secret']);
        $this->assertEquals('', $settings['github_username']);
        $this->assertEquals('', $settings['github_access_token']);
    }

    /**
     * Test allowed file types
     */
    public function testAllowedFileTypes()
    {
        $types = \Git_It_Write::allowed_file_types();

        $this->assertIsArray($types);
        $this->assertContains('md', $types);
    }

    /**
     * Test all repositories with empty data
     */
    public function testAllRepositoriesWithEmptyData()
    {
        Functions\expect('get_option')
            ->once()
            ->with('giw_repositories', [[]])
            ->andReturn([[]]);

        $repos = \Git_It_Write::all_repositories();

        $this->assertIsArray($repos);
        $this->assertNotEmpty($repos);
    }

    /**
     * Test general settings retrieval
     */
    public function testGeneralSettingsRetrieval()
    {
        Functions\expect('get_option')
            ->once()
            ->with('giw_general_settings', [])
            ->andReturn([
                'webhook_secret' => 'test_secret',
                'github_username' => 'testuser'
            ]);

        $settings = \Git_It_Write::general_settings();

        $this->assertIsArray($settings);
        $this->assertEquals('test_secret', $settings['webhook_secret']);
        $this->assertEquals('testuser', $settings['github_username']);
    }

    /**
     * Test plugin version constant
     */
    public function testPluginVersionConstant()
    {
        $this->assertTrue(defined('GIW_VERSION'));
        $this->assertEquals('2.0', GIW_VERSION);
    }

    /**
     * Test plugin path constant
     */
    public function testPluginPathConstant()
    {
        $this->assertTrue(defined('GIW_PATH'));
        $this->assertStringContainsString('git-it-sync', GIW_PATH);
    }
}
