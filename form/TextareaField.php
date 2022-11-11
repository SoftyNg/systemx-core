<?php
/**
 * User: systemx
 * Date: 7/26/2022
 * Time: 3:49 PM
 */

namespace systemx\SystemxCore\form;


/**
 * Class TextareaField
 *
 * @author  Lawrence John <thelaw111@gmail.com>
 * @package systemx\SystemxCore\form
 */
class TextareaField extends BaseField
{
    public function renderInput()
    {
        return sprintf('<textarea class="form-control%s" name="%s">%s</textarea>',
             $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->attribute,
            $this->model->{$this->attribute},
        );
    }
}