<?php
/**
 * User: systemx
 * Date: 7/25/2022
 * Time: 11:43 AM
 */

namespace systemx\SystemxCore\exception;


/**
 * Class NotFoundException
 *
 * @author  Lawrence John <thelaw111@gmail.com>
 * @package systemx\SystemxCore\exception
 */
class NotFoundException extends \Exception
{
    protected $message = 'Page not found';
    protected $code = 404;
}