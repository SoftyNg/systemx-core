<?php
/**
 * User: systemx
 * Date: 7/25/2022
 * Time: 11:33 AM
 */

namespace systemx\SystemxCore\middlewares;


use systemx\SystemxCore\Application;
use systemx\SystemxCore\exception\ForbiddenException;

/**
 * Class AuthMiddleware
 *
 * @author  Lawrence John <thelaw111@gmail.com>
 * @package systemx\SystemxCore
 */
class AuthMiddleware extends BaseMiddleware
{
    protected array $actions = [];

    public function __construct($actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (Application::isGuest()) {
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }
}