<?php
/**
 * Created by PhpStorm.
 * User: anatol
 * Date: 22.07.2019
 * Time: 22:00
 */

namespace App\services\renders;


class TmplRenderServices implements IRenderService
{
    public function renderTmpl($template, $params = [])
    {
        ob_start();
        extract($params);
        include '../views/' . $template . '.php';
        return ob_get_clean();
    }
}