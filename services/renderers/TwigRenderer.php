<?php
namespace app\services\renderers;


class TwigRenderer implements IRenderer
{
    private $templater;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(ROOT_DIR . 'views/twig');
        $this->templater = new \Twig_Environment($loader);
    }

    public function render($template, $params = [])
    {
        $template = $template . ".twig";
        return $this->templater->render($template, $params);
    }
}
