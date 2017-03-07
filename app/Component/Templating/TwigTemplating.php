<?php
namespace SimpleMVC\Component\Templating;

class TwigTemplating
{
    private $twig;

    /**
     * Load twig
     */
    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(DIR_VIEWS);
        $this->twig = new \Twig_Environment($loader, [
            'debug' => DEV,
            'strict_variables' => DEV,
            'autoescape' => true,
            'cache' => DIR_CACHE
        ]);
    }

    /**
     * Get Twig object
     *
     * @return Twig_Environment
     */
    public function get()
    {
        return $this->twig;
    }
}