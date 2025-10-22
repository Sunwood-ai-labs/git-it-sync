<?php

namespace GitItWrite\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Simple tests for utility functions
 */
class UtilitiesTest extends TestCase
{
    /**
     * Test basic string manipulation
     */
    public function testStringManipulation()
    {
        // Test that basic string functions work
        $str = 'hello world';
        $this->assertEquals('HELLO WORLD', strtoupper($str));
        $this->assertEquals('hello world', strtolower($str));
    }

    /**
     * Test array functions
     */
    public function testArrayFunctions()
    {
        // Test basic array operations
        $arr = ['a', 'b', 'c'];
        $this->assertCount(3, $arr);
        $this->assertContains('b', $arr);
        $this->assertEquals('a,b,c', implode(',', $arr));
    }

    /**
     * Test path manipulation
     */
    public function testPathManipulation()
    {
        // Test basic path operations
        $path = '/some/path/to/file.php';
        $this->assertEquals('/some/path/to', dirname($path));
        $this->assertEquals('file.php', basename($path));
    }

    /**
     * Test URL parsing
     */
    public function testUrlParsing()
    {
        // Test basic URL parsing
        $url = 'https://example.com/path?query=value#fragment';
        $parts = parse_url($url);

        $this->assertArrayHasKey('scheme', $parts);
        $this->assertArrayHasKey('host', $parts);
        $this->assertArrayHasKey('path', $parts);
        $this->assertEquals('https', $parts['scheme']);
        $this->assertEquals('example.com', $parts['host']);
    }

    /**
     * Test date formatting
     */
    public function testDateFormatting()
    {
        // Test basic date operations
        $timestamp = 1609459200; // 2021-01-01 00:00:00 UTC
        $date = date('Y-m-d', $timestamp);

        $this->assertNotEmpty($date);
        $this->assertStringContainsString('-', $date);
    }

    /**
     * Test JSON operations
     */
    public function testJsonOperations()
    {
        // Test JSON encoding/decoding
        $data = ['key' => 'value', 'number' => 123];
        $json = json_encode($data);

        $this->assertIsString($json);
        $this->assertStringContainsString('key', $json);

        $decoded = json_decode($json, true);
        $this->assertEquals($data, $decoded);
    }
}
