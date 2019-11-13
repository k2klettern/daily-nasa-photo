<?php

namespace Zeidan\Controller;

use Zeidan\Controller\DashboardController;

class IndexController
{
    const NASA_TRANSIENT_NAME = "nasa-picture-data";
    const OPTION_NASA_FIELD = "nasa-api-token";
    const HAFTDAY_IN_SECONDS     = 43600;
    protected $token;
    protected $url;

    public function __construct()
    {
        //$this->setToken('qPhOVdaSbuSl29sTrQ41Osv2D0VOLwmkbUuJd8zN');
        $this->setToken(get_option(self::OPTION_NASA_FIELD) ? get_option(self::OPTION_NASA_FIELD) : 'DEMO_KEY');
        $this->setUrl('https://api.nasa.gov/planetary/apod?api_key=');
        $this->initHooks();
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl(string $url)
    {
        $this->url = $url;
    }


    public function initHooks() {
        add_action('init', [$this, 'getPicture']);
    }

    public function getPicture(): \stdClass {
        //delete_transient(self::NASA_TRANSIENT_NAME);
        $picture = get_transient(self::NASA_TRANSIENT_NAME) ? get_transient(self::NASA_TRANSIENT_NAME) : false;
        if(!$picture) {
            $response = wp_remote_get($this->getUrl() . $this->getToken());
            if (is_array($response)) {
                $picture = json_decode($response['body']);
                if (!isset($picture->code)) {
                    set_transient(self::NASA_TRANSIENT_NAME, $picture, self::HAFTDAY_IN_SECONDS);
                }
            }
        }

        return $picture;
    }
}