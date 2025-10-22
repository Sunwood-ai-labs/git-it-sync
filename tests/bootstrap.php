<?php
/**
 * PHPUnit bootstrap file for Git It Write plugin tests
 */

// Composer autoload
require_once dirname(__DIR__) . '/vendor/autoload.php';

// Define plugin constants for testing
define('GIW_VERSION', '2.0');
define('GIW_PATH', dirname(__DIR__) . '/');
define('GIW_ADMIN_URL', 'http://example.com/wp-content/plugins/git-it-write/admin/');
define('ABSPATH', '/tmp/wordpress/');

// Mock WordPress functions
function plugin_dir_path($file) {
    return dirname($file) . '/';
}

function plugin_dir_url($file) {
    return 'http://example.com/wp-content/plugins/' . basename(dirname($file)) . '/';
}

function trailingslashit($string) {
    return rtrim($string, '/\\') . '/';
}

function get_option($option, $default = false) {
    return $default;
}

function update_option($option, $value) {
    return true;
}

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

function esc_html($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function esc_attr($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function esc_url($url) {
    return htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
}

function selected($selected, $current, $echo = true) {
    $result = $selected == $current ? ' selected="selected"' : '';
    if ($echo) {
        echo $result;
    }
    return $result;
}

function add_action($hook, $callback, $priority = 10, $args = 1) {
    // Mock - do nothing
    return true;
}

function add_filter($hook, $callback, $priority = 10, $args = 1) {
    // Mock - do nothing
    return true;
}

function wp_upload_dir() {
    return array(
        'basedir' => '/tmp/wordpress/wp-content/uploads',
        'baseurl' => 'http://example.com/wp-content/uploads',
    );
}

function wp_mkdir_p($target) {
    return true;
}

function get_post_types($args = array(), $output = 'names') {
    return array();
}
