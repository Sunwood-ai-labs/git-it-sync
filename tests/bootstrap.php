<?php
/**
 * PHPUnit bootstrap file for Git It Write plugin tests
 */

// Composer autoload
require_once dirname(__DIR__) . '/vendor/autoload.php';

// Mock WordPress functions before loading plugin files
if (!function_exists('plugin_dir_path')) {
    function plugin_dir_path($file) {
        return dirname($file) . '/';
    }
}

if (!function_exists('plugin_dir_url')) {
    function plugin_dir_url($file) {
        return 'http://example.com/wp-content/plugins/' . basename(dirname($file)) . '/';
    }
}

if (!function_exists('trailingslashit')) {
    function trailingslashit($string) {
        return rtrim($string, '/\\') . '/';
    }
}

if (!function_exists('get_option')) {
    function get_option($option, $default = false) {
        return $default;
    }
}

if (!function_exists('wp_parse_args')) {
    function wp_parse_args($args, $defaults = array()) {
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
    }
}

// Define plugin constants for testing
if (!defined('GIW_VERSION')) {
    define('GIW_VERSION', '2.0');
}

if (!defined('GIW_PATH')) {
    define('GIW_PATH', dirname(__DIR__) . '/');
}

if (!defined('GIW_ADMIN_URL')) {
    define('GIW_ADMIN_URL', 'http://example.com/wp-content/plugins/git-it-write/admin/');
}

if (!defined('ABSPATH')) {
    define('ABSPATH', '/tmp/wordpress/');
}

// Now load the main plugin file
require_once dirname(__DIR__) . '/git-it-write.php';

// Load utility classes that will be tested
require_once dirname(__DIR__) . '/includes/utilities.php';
