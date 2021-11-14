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

namespace Module\Links\Controller\Front;

use Pi;
use Pi\Mvc\Controller\ActionController;

class IndexController extends ActionController
{
    public function indexAction()
    {
        // Get info from url
        $id = $this->params('id');

        // Check id
        if (isset($id) && is_numeric($id)) {
            $inventory = Pi::api('inventory', 'links')->getInventory($id);
            if (isset($inventory) && !empty($inventory)) {
                if (isset($inventory['url']) && !empty($inventory['url']) && isset($inventory['status']) && (int)$inventory['status'] == 1) {
                    // Update click
                    $this->getModel('inventory')->increment('click', ['id' => $inventory['id']]);

                    // redirect
                    return $this->redirect()->toUrl($inventory['url']);
                }
            }
        }

        // Set error
        $this->getResponse()->setStatusCode(403);
        $this->terminate(__('Request not true'), '', 'error-denied');
        $this->view()->setLayout('layout-simple');
        return;
    }
}