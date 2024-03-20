<?php
/**
 * User: Systemx
 * Date: 11/11/2022
 * Time: 9:57 AM
 */


namespace systemx\SystemxCore;



/**
 * Class Response
 *
 * @author  Lawrence John <thelaw111@gmail.com>
 * @package systemx\SystemxCore
 */
 class Response 
{
    public function statusCode(int $code)
    {
        http_response_code($code);
    }

    public function redirect($url)
    {
        header("Location: $url");
    }
}