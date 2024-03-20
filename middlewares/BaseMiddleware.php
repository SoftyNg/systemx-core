<?php
/**
 * User: Systemx
 * Date: 11/11/2022
 * Time: 9:57 AM
 */


namespace systemx\SystemxCore\middlewares;


/**
 * Class BaseMiddlware
 *
 * @author  Lawrence John <thelaw111@gmail.com>
 * @package systemx\SystemxCore
 */

abstract class BaseMiddleware
{
    abstract public function execute();
}