<?php
namespace SimpleMVC\Component\Templating;

class Template
{
    private $twig;
    private $template;
    private $parameters;

    /**
     * Create a template
     *
     * @param string $template Template file
     * @param array $parameters Template parameters
     */
    public function __construct($template, array $parameters = [])
    {
        $twig = new TwigTemplating();
        $this->twig = $twig->get();

        $this->template = $template;
        $this->parameters = $parameters;
    }

    /**
     * Renders a template
     *
     * @return Rendered template
     */
    public function render()
    {
        return $this->twig->display($this->template, $this->parameters);
    }
}