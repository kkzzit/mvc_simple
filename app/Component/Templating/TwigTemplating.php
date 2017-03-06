<?php
namespace SimpleMVC\Component\Templating;

class TwigTemplating
{
    private $twig;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(DIR_VIEWS);
        $this->twig = new \Twig_Environment($loader, [
            'debug' => DEV,
            'strict_variables' => DEV,
            'autoescape' => false,
            'cache' => DIR_CACHE
        ]);
    }

    public function get()
    {
        return $this->twig;
    }
}