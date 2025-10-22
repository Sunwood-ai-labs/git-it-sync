<?php
/**
 * PHPUnit bootstrap file for Git It Write plugin tests
 */

// Composer autoload
require_once dirname(__DIR__) . '/vendor/autoload.php';

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
