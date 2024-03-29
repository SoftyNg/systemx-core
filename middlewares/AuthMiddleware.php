<?php
/**
 * User: systemx
 * Date: 7/25/2022
 * Time: 11:33 AM
 */

namespace systemx\SystemxCore\middlewares;


use systemx\SystemxCore\Systemx;
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
        if (Systemx::isGuest()) {
            if (empty($this->actions) || in_array(Systemx::$app->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }
}