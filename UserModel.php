<?php
/**
 * User: systemx
 * Date: 7/25/2022
 * Time: 10:13 AM
 */

namespace systemx\SystemxCore;

use systemx\SystemxCore\db\DbModel;

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