<?php
/**
 * User: Systemx
 * Date: 11/11/2022
 * Time: 9:57 AM
 */


 namespace systemx\SystemxCore;
 
 
 /**
  * Class UserModel
  *
  * @author  Lawrence John <thelaw111@gmail.com>
  * @package systemx\SystemxCore
  */
 
abstract class UserModel extends DbModel
{
    abstract public function getDisplayName(): string;
}