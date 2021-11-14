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

namespace Module\Links\Api;

use Pi;
use Pi\Application\Api\AbstractApi;

/*
 * Pi::api('inventory', 'links')->getInventory($parameter, $type);
 * Pi::api('inventory', 'links')->canonizeInventory($inventory);
 */

class Inventory extends AbstractApi
{
    public function getInventory($parameter, $type = 'id'): array
    {
        $inventory = Pi::model('inventory', $this->getModule())->find($parameter, $type);
        return $this->canonizeInventory($inventory);
    }

    public function canonizeInventory($inventory): array
    {
        // Check
        if (empty($inventory)) {
            return [];
        }

        // object to array
        if (is_object($inventory)) {
            $inventory = $inventory->toArray();
        }

        // decode url
        $inventory['url'] = urldecode($inventory['url']);

        // Set input url
        $inventory['input'] = Pi::url(
            Pi::service('url')->assemble(
                'links',
                [
                    'controller' => 'index',
                    'action'     => 'index',
                    'id'         => $inventory['id'],
                ]
            )
        );

        // Set status view
        $inventory['status_view'] = $inventory['status'] == 1 ? __('Active') : __('Inactive');

        // return company
        return $inventory;
    }
}