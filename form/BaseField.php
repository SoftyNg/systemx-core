<?php
/**
 * User: Systemx
 * Date: 11/11/2022
 * Time: 9:57 AM
 */


namespace systemx\SystemxCore\form;


use systemx\SystemxCore\Model;


/**
 * Class BaseField
 *
 * @author  Lawrence John <thelaw111@gmail.com>
 * @package systemx\SystemxCore
 */

abstract class BaseField
{

    public Model $model;
    public string $attribute;
    public string $type;
    public string $classstyle;
    public string $id;
    public string $placeholder;

    /**
     * Field constructor.
     *
     * @param \app\engine\Model $model
     * @param string          $attribute
     */
    public function __construct(Model $model, string $attribute, string $type, string $classstyle, string $id, string $placeholder)
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = $type;
        $this->classstyle = $classstyle;
        $this->id = $id;
        $this->placeholder = $placeholder;
    }

    public function __toString()
    {
        return sprintf('<div class="form-group">
                <label>%s</label>
                %s
                <div class="invalid-feedback">
                    %s
                </div>
            </div>',
            $this->model->getLabel($this->attribute),
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)
        );
    }

    abstract public function renderInput();
}
