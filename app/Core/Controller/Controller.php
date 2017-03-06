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

    public function __construct()
    {
        $this->request = new Request();
    }

    /**
     * Render a template using the Template class
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
