<?php

namespace Zeidan\Controller;

use Zeidan\Controller\IndexController;

class DashboardController
{

    public function __construct()
    {
        add_action('wp_dashboard_setup', [$this, 'addDashboardWidgets']);
    }

    public function dashboardWidgetFunction()
    {
        include_once plugin_dir_path(__FILE__) . '../../Templates/token-show.php';
    }

    public function addDashboardWidgets()
    {
        wp_add_dashboard_widget('dashboard_widget', 'Nasa Daily Photo', [ $this, 'dashboardWidgetFunction' ]);
    }
}
