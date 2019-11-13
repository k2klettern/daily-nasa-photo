<?php

namespace Zeidan\Controller;

use Zeidan\Controller\IndexController;

class DashboardController
{

    public function __construct()
    {
        add_action('wp_dashboard_setup', [$this, 'addDashboardWidgets']);
        add_action('admin_post_token_form', [$this, 'formSubmitProcessing']);
    }

    public function dashboardWidgetFunction() {
        include_once DAILY_NASA_PLUGINS_PATH . '/Templates/token-form.php';
    }

    public function addDashboardWidgets() {
        wp_add_dashboard_widget('dashboard_widget', 'Nasa Daily Photo', [$this, 'dashboardWidgetFunction']);
    }

    public function formSubmitProcessing() {
        $return = "El Campo no puede estar vacio";
        if (isset($_POST['token'])) {
                add_option(IndexController::OPTION_NASA_FIELD, $_POST['token']);
                $return = "Token Guardado";
        }
        wp_redirect(admin_url('?message='  . urlencode($return)));
        die;
    }
}