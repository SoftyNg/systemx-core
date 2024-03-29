<?php
/**
 * User: Systemx
 * Date: 11/11/2022
 * Time: 9:57 AM
 */


namespace systemx\SystemxCore;


/**
 * Class View
 *
 * @author  Lawrence John <thelaw111@gmail.com>
 * @package systemx\SystemxCore
 */

class View
{
    public string $title = '';

    public function renderView($view, array $params)
    {
        $layoutName = Systemx::$app->layout;
        if (Systemx::$app->controller) {
            $layoutName = Systemx::$app->controller->layout;
        }
        $viewContent = $this->_renderViewOnly($view, $params);
        ob_start();
        include_once Systemx::$ROOT_DIR."/views/layouts/$layoutName.php";
        $layoutContent = ob_get_clean();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    private function _renderViewOnly($view, array $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Systemx::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}