<?php
namespace App\services\renders;

use Twig\Loader\FilesystemLoader;

class TwigRenderServices implements IRenderService
{
    /**
     * @param $template
     * @param array $params
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function renderTmpl($template, $params = [])
    {

        $loader = new FilesystemLoader([
            '../views/twig',
            '../views/',
        ]);

        $twig = new \Twig\Environment($loader);
        $template .= '.twig';
        return $twig->render($template, $params);

    }
}