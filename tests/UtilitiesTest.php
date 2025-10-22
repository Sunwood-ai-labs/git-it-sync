<?php

namespace GitItWrite\Tests;

use Brain\Monkey\Functions;

/**
 * Test case for GIW_Utils class
 */
class UtilitiesTest extends TestCase
{
    /**
     * Test remove extension from relative URL
     */
    public function testRemoveExtensionRelativeUrl()
    {
        require_once dirname(__DIR__) . '/git-it-write.php';
        require_once dirname(__DIR__) . '/includes/utilities.php';

        // Test basic markdown file
        $result = \GIW_Utils::remove_extension_relative_url('./hello/abcd.md');
        $this->assertEquals('./hello/abcd/', $result);

        // Test with query parameters
        $result = \GIW_Utils::remove_extension_relative_url('./hello/abcd.md?param=value');
        $this->assertEquals('./hello/abcd/?param=value', $result);

        // Test with hash
        $result = \GIW_Utils::remove_extension_relative_url('./hello/abcd.md#heading');
        $this->assertEquals('./hello/abcd/#heading', $result);

        // Test with both query and hash
        $result = \GIW_Utils::remove_extension_relative_url('./hello/abcd.md?param=value#heading');
        $this->assertEquals('./hello/abcd/?param=value#heading', $result);

        // Test non-markdown file (should not be modified)
        $result = \GIW_Utils::remove_extension_relative_url('./hello/abcd.txt');
        $this->assertEquals('./hello/abcd.txt', $result);

        // Test URL without extension
        $result = \GIW_Utils::remove_extension_relative_url('./hello/abcd');
        $this->assertEquals('./hello/abcd', $result);
    }

    /**
     * Test process content template
     */
    public function testProcessContentTemplate()
    {
        require_once dirname(__DIR__) . '/includes/utilities.php';

        $template = '<div class="content">%%content%%</div>';
        $content = '<p>Hello World</p>';

        $result = \GIW_Utils::process_content_template($template, $content);

        $this->assertEquals('<div class="content"><p>Hello World</p></div>', $result);
    }

    /**
     * Test process content template with multiple placeholders
     */
    public function testProcessContentTemplateMultiplePlaceholders()
    {
        require_once dirname(__DIR__) . '/includes/utilities.php';

        $template = '<div>%%content%%</div><footer>%%content%%</footer>';
        $content = 'Test content';

        $result = \GIW_Utils::process_content_template($template, $content);

        $this->assertEquals('<div>Test content</div><footer>Test content</footer>', $result);
    }

    /**
     * Test process date with timestamp
     */
    public function testProcessDateWithTimestamp()
    {
        require_once dirname(__DIR__) . '/includes/utilities.php';

        $timestamp = 1609459200; // 2021-01-01 00:00:00 UTC
        $result = \GIW_Utils::process_date($timestamp);

        $this->assertNotEmpty($result);
        $this->assertStringContainsString('-', $result); // Should contain date separators
    }

    /**
     * Test process date with formatted date
     */
    public function testProcessDateWithFormattedDate()
    {
        require_once dirname(__DIR__) . '/includes/utilities.php';

        $date = '2021-01-01 12:00:00';
        $result = \GIW_Utils::process_date($date);

        $this->assertEquals($date, $result);
    }

    /**
     * Test process date with empty string
     */
    public function testProcessDateWithEmptyString()
    {
        require_once dirname(__DIR__) . '/includes/utilities.php';

        $result = \GIW_Utils::process_date('');

        $this->assertEquals('', $result);
    }

    /**
     * Test get repo config by full name with valid format
     */
    public function testGetRepoConfigByFullNameInvalidFormat()
    {
        require_once dirname(__DIR__) . '/git-it-write.php';
        require_once dirname(__DIR__) . '/includes/utilities.php';

        Functions\expect('get_option')
            ->once()
            ->with('giw_repositories', [[]])
            ->andReturn([[]]);

        // Invalid format (not username/repo)
        $result = \GIW_Utils::get_repo_config_by_full_name('invalid-format');

        $this->assertFalse($result);
    }

    /**
     * Test get uploaded images
     */
    public function testGetUploadedImages()
    {
        require_once dirname(__DIR__) . '/includes/utilities.php';

        Functions\expect('get_option')
            ->once()
            ->with('giw_metadata', [])
            ->andReturn(['fix_uploaded_images_key' => 'root_dir']);

        Functions\expect('get_option')
            ->once()
            ->with('giw_uploaded_images', [])
            ->andReturn([
                '_images/test.png' => [
                    'url' => 'http://example.com/test.png',
                    'id' => 123
                ]
            ]);

        $result = \GIW_Utils::get_uploaded_images();

        $this->assertIsArray($result);
    }
}
