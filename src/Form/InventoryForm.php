<?php
/**
 * Pi Engine (http://piengine.org)
 *
 * @link            http://code.piengine.org for the Pi Engine source repository
 * @copyright       Copyright (c) Pi Engine http://piengine.org
 * @license         http://piengine.org/license.txt New BSD License
 */

/**
 * @author Hossein Azizabadi <hossein@azizabadi.com>
 */

namespace Module\Links\Form;

use Pi;
use Pi\Form\Form as BaseForm;

class InventoryForm extends BaseForm
{
    public function __construct($name = null, $option = [])
    {
        $this->option = $option;
        parent::__construct($name);
    }

    public function getInputFilter()
    {
        if (!$this->filter) {
            $this->filter = new InventoryFilter($this->option);
        }
        return $this->filter;
    }

    public function init()
    {
        // title
        $this->add(
            [
                'name' => 'title',
                'options' => [
                    'label' => __('Title'),
                ],
                'attributes' => [
                    'type' => 'text',
                    'description' => '',
                    'required' => true,
                ],
            ]
        );

        // url
        $this->add(
            [
                'name' => 'url',
                'options' => [
                    'label' => __('Url'),
                ],
                'attributes' => [
                    'type' => 'url',
                    'description' => __('example: https://mywebsite.com or http://mywebsite.com'),
                    'required' => true,
                ],
            ]
        );

        // status
        $this->add(
            [
                'name' => 'status',
                'options' => [
                    'label' => __('Status'),
                    'value_options' => [
                        1 => __('Activate'),
                        0 => __('Deactivate'),
                    ],
                ],
                'type' => 'radio',
                'attributes' => [
                    'value' => 1,
                ],
            ]
        );

        // Save
        $this->add(
            [
                'name' => 'submit',
                'type' => 'submit',
                'attributes' => [
                    'value' => __('Save'),
                    'class' => 'btn btn-primary',
                ],
            ]
        );
    }
}