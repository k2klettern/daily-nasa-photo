<?php
/*
Plugin Name: Daily Nasa Photo
Plugin URI: http://zeidan.info/daily-nasa-photo/
Description: Show the daily Nasa Photo on your web
Version: 0.1
Author: Eric Zeidan
Author URI: http://zeidan.info
*/
require_once __DIR__ . '/vendor/autoload.php';

use Zeidan\Controller\IndexController;
use Zeidan\Controller\DashboardController;

define('DAILY_NASA_PLUGINS_PATH', __DIR__);

new IndexController();
new DashboardController();

//require_once __DIR__ . '/blocks/picture.php';