<?php
namespace SimpleMVC\Core\Controller;

use SimpleMVC\Core\Request;
use SimpleMVC\Component\Templating\Template;

/**
 * Base controller class
 */
abstract class Controller
{
    private $request;

    /*
     * Create a new Request when a Controller is created
     */
    public function __construct()
    {
        $this->request = new Request();
    }

    /**
     * Render a template using the Template class
     *
     * @param string $template Template file
     * @param array $parameters Template parameters
     * @return Rendered template
     * @throws \Exception When trying to render more than once
     */
    protected function render($template, array $parameters = [])
    {
        static $rendered;

        if ($rendered === true) {
            throw new \Exception('Content has already been rendered');
        }

        $rendered = true;

        $tpl = new Template($template, $parameters);

        return $tpl->render();
    }
}
