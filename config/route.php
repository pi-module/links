<?php
/**
 * Pi Engine (http://piengine.org)
 *
 * @link            http://code.piengine.org for the Pi Engine source repository
 * @copyright       Copyright (c) Pi Engine http://piengine.org
 * @license         http://piengine.org/license.txt New BSD License
 */

/**
 * @author Hossein Azizabadi <azizabadi@faragostaresh.com>
 */
return [
    // route name
    'guide' => [
        'name'    => 'links',
        'type'    => 'Module\Links\Route\Links',
        'options' => [
            'route'    => '/links',
            'defaults' => [
                'module'     => 'links',
                'controller' => 'index',
                'action'     => 'index',
            ],
        ],
    ],
];
