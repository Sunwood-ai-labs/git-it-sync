<?php

namespace GitItWrite\Tests;

use Brain\Monkey;
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
        Monkey\setUp();

        // Mock common WordPress functions
        Monkey\Functions\stubs([
            'plugin_dir_path' => function($file) {
                return dirname($file) . '/';
            },
            'plugin_dir_url' => function($file) {
                return 'http://example.com/wp-content/plugins/' . basename(dirname($file)) . '/';
            },
            'trailingslashit' => function($string) {
                return rtrim($string, '/\\') . '/';
            },
            'get_option' => function($option, $default = false) {
                return $default;
            },
            'wp_parse_args' => function($args, $defaults = array()) {
                if (is_object($args)) {
                    $parsed_args = get_object_vars($args);
                } elseif (is_array($args)) {
                    $parsed_args =& $args;
                } else {
                    parse_str($args, $parsed_args);
                }

                if (is_array($defaults)) {
                    return array_merge($defaults, $parsed_args);
                }
                return $parsed_args;
            },
            'esc_html' => function($text) {
                return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
            },
            'esc_attr' => function($text) {
                return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
            },
            'esc_url' => function($url) {
                return htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
            },
        ]);
    }

    /**
     * Teardown test environment
     */
    protected function tearDown(): void
    {
        Monkey\tearDown();
        parent::tearDown();
    }
}
