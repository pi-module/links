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
use Module\System\Validator\UserEmail as UserEmailValidator;
use Laminas\InputFilter\InputFilter;

class InventoryFilter extends InputFilter
{
    public function __construct($option = [])
    {
        // title
        $this->add(
            [
                'name' => 'title',
                'required' => true,
                'filters' => [
                    [
                        'name' => 'StringTrim',
                    ],
                ],
            ]
        );

        // url
        $this->add(
            [
                'name' => 'url',
                'required' => true,
                'filters' => [
                    [
                        'name' => 'StringTrim',
                    ],
                ],
            ]
        );

        // status
        $this->add(
            [
                'name' => 'status',
                'required' => false,
                'filters' => [
                    [
                        'name' => 'StringTrim',
                    ],
                ],
            ]
        );
    }
}