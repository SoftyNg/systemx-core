<?php
/**
 * User: systemx
 * Date: 7/25/2022
 * Time: 11:35 AM
 */

namespace systemx\SystemxCore\exception;


use systemx\SystemxCore\Application;

/**
 * Class ForbiddenException
 *
 * @author  Lawrence John <thelaw111@gmail.com>
 * @package systemx\SystemxCore\exception
 */
class ForbiddenException extends \Exception
{
    protected $message = 'You don\'t have permission to access this page';
    protected $code = 403;
}