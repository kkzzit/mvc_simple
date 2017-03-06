<?php
namespace SimpleMVC\Component\Templating;

class Template
{
    private $twig;
    private $template;
    private $parameters;

    public function __construct($template, array $parameters = [])
    {
        $twig = new TwigTemplating();
        $this->twig = $twig->get();

        $this->template = $template;
        $this->parameters = $parameters;
    }

    public function render()
    {
        return $this->twig->display($this->template, $this->parameters);
    }
}