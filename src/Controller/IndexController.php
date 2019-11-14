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
        add_action( 'init', [$this, 'blockEditorAssets']);
    }

    public function getPicture(): \stdClass {
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

    public function blockEditorAssets() {

        if ( ! function_exists( 'register_block_type' ) ) {
            return;
        }
        $dir = dirname( __FILE__ );

        $index_js = '../../blocks/picture/index.js';
        wp_register_script(
            'picture-block-editor',
            plugins_url( $index_js, __FILE__ ),
            array(
                'wp-blocks',
                'wp-i18n',
                'wp-element',
            ),
            filemtime( "$dir/$index_js" )
        );
        wp_localize_script('picture-block-editor', 'pictureobject', (array)$this->getPicture());

        $editor_css = '../../blocks/picture/editor.css';
        wp_register_style(
            'picture-block-editor',
            plugins_url( $editor_css, __FILE__ ),
            array(),
            filemtime( "$dir/$editor_css" )
        );

        $style_css = '../../blocks/picture/style.css';
        wp_register_style(
            'picture-block',
            plugins_url( $style_css, __FILE__ ),
            array(),
            filemtime( "$dir/$style_css" )
        );

        register_block_type( 'daily-nasa-photo/picture', array(
            'editor_script' => 'picture-block-editor',
            'editor_style'  => 'picture-block-editor',
            'style'         => 'picture-block'
        ) );

    }

}