<?php
/**
 * User: Systemx
 * Date: 11/11/2022
 * Time: 9:57 AM
 */


namespace systemx\SystemxCore\form;


use systemx\SystemxCore\Model;


/**
 * Class Fields
 *
 * @author  Lawrence John <thelaw111@gmail.com>
 * @package systemx\SystemxCore
 */

class Fields extends BaseField
{
    const TYPE_TEXT = 'text';


    /**
     * Field constructor.
     *
     * @param \app\engine\Model $model
     * @param string          $attribute
     *  @param string          $classstyle
     * @param string          $type
     */
    public function __construct(Model $model, string $attribute, string $type, string $classstyle, string $id)
    {
        
        parent::__construct($model, $attribute, $type, $classstyle, $id);
    }

    public function renderInput()
    {
        return sprintf('<input type="%s" class="%s" name="%s" value="%s" id="%s">',
            $this->type,
            $this->model->hasError($this->attribute) ? 'form-control is-invalid' : $this->classstyle,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->id,
        );
    }

   

    public function textAreaField()
    {
        return sprintf('<textarea class="form-control%s" name="%s">%s</textarea>',
             $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->attribute,
            $this->model->{$this->attribute},
        );
    }
}