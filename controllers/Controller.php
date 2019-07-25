<?php
namespace App\controllers;

use App\services\renders\IRenderService;
use App\services\Request;

abstract class Controller
{
    protected $defaultAction = 'index';
    protected $action;
    protected $renderer;
    protected $request;

    public function __construct(IRenderService $renderer, Request $request)
    {
        $this->renderer = $renderer;
        $this->request = $request;
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

    protected function getId()
    {
        return $this->request->getId();
    }
}
