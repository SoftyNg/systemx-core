<?php
/**
 * User: systemx
 * Date: 7/9/2022
 * Time: 7:05 AM
 */

namespace systemx\SystemxCore\form;


use systemx\SystemxCore\Model;

/**
 * Class Form
 *
 * @author  Lawrence John <thelaw111@gmail.com>
 * @package core\form
 */
class Form
{
    public static function begin($action, $method, $options = [])
    {
        $attributes = [];
        foreach ($options as $key => $value) {
            $attributes[] = "$key=\"$value\"";
        }
        echo sprintf('<form action="%s" method="%s" %s>', $action, $method, implode(" ", $attributes));
        return new Form();
    }

    public static function end()
    {
        echo '</form>';
    }

    public function field(Model $model, $attribute)
    {
        return new Field($model, $attribute);
    }

}