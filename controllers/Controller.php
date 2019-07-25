<?php
namespace App\controllers;

use App\services\renders\IRenderService;

abstract class Controller
{
    protected $defaultAction = 'index';
    protected $action;
    protected $renderer;

    public function __construct(IRenderService $renderer)
    {
        $this->renderer = $renderer;
    }

    public function run($action)
    {
        $this->action = $action ?: $this->defaultAction;
        $method = $this->action . 'Action';
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            echo '404';
        }
    }

    public function render($template, $params = [])
    {
        $content = $this->renderTmpl($template, $params);
        return $this->renderTmpl('layouts/main', [
            'content' => $content
        ]);
    }

    public function renderTmpl($template, $params = [])
    {
        return $this->renderer->renderTmpl($template, $params);
    }
}
