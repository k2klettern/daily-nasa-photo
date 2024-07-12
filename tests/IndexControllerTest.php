<?php

use PHPUnit\Framework\TestCase;
use Zeidan\DailyNasaPhoto\Controller\IndexController;

class IndexControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        // Mocking functions
        if (!function_exists('get_option')) {
            function get_option($option)
            {
                return 'test_token';
            }
        }

        if (!function_exists('add_action')) {
            function add_action($hook, $callback)
            {
                // Do nothing
            }
        }

        if (!function_exists('wp_remote_get')) {
            function wp_remote_get($url)
            {
                return [
                    'body' => json_encode([
                                              'url' => 'https://example.com/image.jpg',
                                              'title' => 'Test Title',
                                              'explanation' => 'Test Explanation',
                                              'hdurl' => 'https://example.com/hdimage.jpg',
                                              'copyright' => 'Test Copyright'
                                          ])
                ];
            }
        }

        if (!function_exists('get_transient')) {
            function get_transient($name)
            {
                return false;
            }
        }

        if (!function_exists('set_transient')) {
            function set_transient($name, $value, $expiration)
            {
                // Do nothing
            }
        }
    }

    public function testCanGetToken()
    {
        $controller = new IndexController();
        $this->assertEquals('test_token', $controller->getToken());
    }

    public function testCanSetToken()
    {
        $controller = new IndexController();
        $controller->setToken('new_token');
        $this->assertEquals('new_token', $controller->getToken());
    }

    public function testCanGetUrl()
    {
        $controller = new IndexController();
        $this->assertEquals('https://api.nasa.gov/planetary/apod?api_key=', $controller->getUrl());
    }

    public function testCanSetUrl()
    {
        $controller = new IndexController();
        $controller->setUrl('https://new-url.com/api');
        $this->assertEquals('https://new-url.com/api', $controller->getUrl());
    }

    public function testGetPicture()
    {
        $controller = new IndexController();
        $picture = $controller->getPicture();
        $this->assertInstanceOf(\stdClass::class, $picture);
        $this->assertEquals('https://example.com/image.jpg', $picture->url);
        $this->assertEquals('Test Title', $picture->title);
        $this->assertEquals('Test Explanation', $picture->explanation);
        $this->assertEquals('https://example.com/hdimage.jpg', $picture->hdurl);
        $this->assertEquals('Test Copyright', $picture->copyright);
    }
}
