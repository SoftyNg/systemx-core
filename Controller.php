<?php
/**
 * User: systemx
 * Date: 7/8/2022
 * Time: 8:43 AM
 */

namespace systemx\SystemxCore;

use systemx\SystemxCore\middlewares\BaseMiddleware;
/**
 * Class Controller
 *
 * @author  Lawrence John <thelaw111@gmail.com>
 * @package systemx\SystemxCore
 */
class Controller
{
    public string $layout = 'main';
    public string $action = '';

    /**
     * @var \systemx\SystemxCore\BaseMiddleware[]
     */
    protected array $middlewares = [];

    public function setLayout($layout): void
    {
        $this->layout = $layout;
    }

    public function render($view, $params = []): string
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @return \systemx\SystemxCore\middlewares\BaseMiddleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}