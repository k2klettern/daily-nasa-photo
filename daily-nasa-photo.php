<?php
/*
Plugin Name: Daily Nasa Photo
Plugin URI: http://zeidan.info/daily-nasa-photo/
Description: Show the daily Nasa Photo on your web
Version: 0.1
Author: Eric Zeidan
Author URI: http://zeidan.info
*/

use Zeidan\DailyNasaPhoto\Controller\IndexController;
use Zeidan\DailyNasaPhoto\Controller\DashboardController;

new IndexController();
new DashboardController();
