<?php
namespace Inanimatt\SiteBuilder;

class TwigRenderer implements RendererInterface
{
    protected $twig;

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function render($data, $template)
    {
        return $this->twig->render($template, $data);
    }

}