<?php
class App
{
    private $url_controller = null;
    private $url_action = null;
    private $url_params = [];

    /**
     * Main application constructor
     * Method based on MINI: https://github.com/panique/mini
     *
     * Issue #1: index site (BundleNameController->index()) can't take arguments (they are considered a subsite every time)
     *
     * @throws \Exception When PHP version is lower than 7.0.0
     */
    function __construct()
    {
        if (PHP_VERSION_ID < 70000) {
            throw new \Exception('This application requires PHP version 7.0.0 or higher to work');
        }

        // Split up the URL
        $this->splitURL();

        // Set the Controllers name
        $controller = 'App\\Controller\\' . ucwords($this->url_controller ?: 'Home') . 'Controller';

        // Check if Controller exists
        if (class_exists($controller)) {
            $this->url_controller = new $controller();

            if (method_exists($this->url_controller, $this->url_action)) {
                return call_user_func_array([$this->url_controller, $this->url_action], $this->url_params);
            } else {
                return $this->url_controller->index();
            }
        } else {
            return $this->errorPage();
        }
    }

    /**
     * URL handler
     * USAGE: page/subpage/val/ue/s/... -> class pagecontroller function index/subpage($values...)
     * Based on MINI: https://github.com/panique/mini
     */
    private function splitURL()
    {
        if (isset($_GET['page'])) {
            $url = trim($_GET['page'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = filter_var($url, FILTER_SANITIZE_SPECIAL_CHARS);
            $url = explode('/', $url);

            $this->url_controller = $url[0] ?? null;
            $this->url_action = $url[1] ?? null;

            unset($url[0], $url[1]);

            $this->url_params = array_values($url);
        }
    }

    /**
     * Controller not found error page
     *
     * For now just a simple error message
     */
    protected function errorPage()
    {
        print 'invalid path';
    }
}
