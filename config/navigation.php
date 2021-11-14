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
    'front' => false,
    'admin' => [
        'list' => [
            'label'      => _a('Lists'),
            'permission' => [
                'resource' => 'list',
            ],
            'route'      => 'admin',
            'module'     => 'links',
            'controller' => 'list',
            'action'     => 'index',

            'pages'      => [
                'list'   => [
                    'label'      => _a('List'),
                    'route'      => 'admin',
                    'controller' => 'list',
                    'action'     => 'index',
                ],
                'manage' => [
                    'label'      => _a('Add / Manage'),
                    'route'      => 'admin',
                    'controller' => 'list',
                    'action'     => 'update',
                ],
            ],
        ],
    ],
];
