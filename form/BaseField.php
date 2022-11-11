<?php
/**
 * User: systemx
 * Date: 7/26/2022
 * Time: 3:49 PM
 */

namespace systemx\SystemxCore\form;


use systemx\SystemxCore\Model;

/**
 * Class BaseField
 *
 * @author  Lawrence John <thelaw111@gmail.com>
 * @package systemx\SystemxCore\form
 */
abstract class BaseField
{

    public Model $model;
    public string $attribute;
    public string $type;

    /**
     * Field constructor.
     *
     * @param \systemx\SystemxCore\Model $model
     * @param string          $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
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