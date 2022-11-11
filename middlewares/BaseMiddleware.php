<?php
/**
 * User: systemx
 * Date: 7/25/2022
 * Time: 11:33 AM
 */

namespace systemx\SystemxCore\middlewares;


/**
 * Class BaseMiddleware
 *
 * @author  Lawrence John <thelaw111@gmail.com>
 * @package systemx\SystemxCore
 */
abstract class BaseMiddleware
{
    abstract public function execute();
}