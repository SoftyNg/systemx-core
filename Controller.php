<?php
/**
 * User: Systemx
 * Date: 11/11/2022
 * Time: 8:43 AM
 */

namespace systemx\SystemxCore;

use systemx\SystemxCore\middlewares\BaseMiddleware;
/**
 * Class Controller
 *
 * @author  Lawrence John<thelaw111@gmail.com>
 * @package app\engine
 */
class Controller
{
    public string $layout = 'main';
    public string $action = '';

    /**
     * @var systemx\SystemxCore\BaseMiddleware[]
     */
    protected array $middlewares = [];

    public function setLayout($layout): void
    {
        $this->layout = $layout;
    }

    public function render($view, $params = []): string
    {
        return Systemx::$app->router->renderView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @return \app\engine\middlewares\BaseMiddleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}
