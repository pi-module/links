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

namespace Module\Links\Controller\Admin;

use Laminas\Db\Sql\Predicate\Expression;
use Pi;
use Pi\Mvc\Controller\ActionController;
use Pi\Paginator\Paginator;
use Module\Links\Form\InventoryFilter;
use Module\Links\Form\InventoryForm;

class ListController extends ActionController
{
    public function indexAction()
    {
        // Get info from url
        $module = $this->params('module');
        $page   = $this->params('page', 1);

        // Get config
        $config = Pi::service('registry')->config->read($module);

        // Get info
        $list   = [];
        $where  = [];
        $order  = ['id DESC'];
        $limit  = intval($config['admin_perpage']);
        $offset = (int)($page - 1) * $limit;

        // Select
        $select = $this->getModel('inventory')->select()->where($where)->order($order)->offset($offset)->limit($limit);
        $rowSet = $this->getModel('inventory')->selectWith($select);

        // Make list
        foreach ($rowSet as $row) {
            $list[$row->id] = Pi::api('inventory', 'links')->canonizeInventory($row);
        }

        // Set count
        $columnsLink = ['count' => new Expression('count(*)')];
        $select      = $this->getModel('inventory')->select()->where($where)->columns($columnsLink);
        $count       = $this->getModel('inventory')->selectWith($select)->current()->count;

        // Set paginator
        $paginator = Paginator::factory(intval($count));
        $paginator->setItemCountPerPage($limit);
        $paginator->setCurrentPageNumber($page);
        $paginator->setUrlOptions(
            [
                'router' => $this->getEvent()->getRouter(),
                'route' => $this->getEvent()->getRouteMatch()->getMatchedRouteName(),
                'params' => array_filter(
                    [
                        'module' => $this->getModule(),
                        'controller' => 'list',
                        'action' => 'index',
                    ]
                ),
            ]
        );

        // Set view
        $this->view()->setTemplate('list-index');
        $this->view()->assign('config', $config);
        $this->view()->assign('list', $list);
        $this->view()->assign('paginator', $paginator);
    }

    public function updateAction()
    {
        // Get id
        $id     = $this->params('id');
        $module = $this->params('module');

        // Get config
        $config = Pi::service('registry')->config->read($module);

        // Set option
        $option = [];

        // Set form
        $form = new InventoryForm('inventory', $option);
        $form->setAttribute('enctype', 'multipart/form-data');
        if ($this->request->isPost()) {
            $data = $this->request->getPost();
            $form->setInputFilter(new InventoryFilter($option));
            $form->setData($data);
            if ($form->isValid()) {
                $values = $form->getData();

                // encode urls
                $values['url'] = urlencode($values['url']);

                // Save values
                if (!empty($id)) {
                    $row = $this->getModel('inventory')->find($id);
                } else {
                    $row = $this->getModel('inventory')->createRow();
                }
                $row->assign($values);
                $row->save();

                // jump
                $message = __('Link inventory data saved successfully.');
                $this->jump(['action' => 'index'], $message);
            }
        } elseif (!empty($id)) {
            // Get inventory
            $inventory = Pi::api('inventory', 'links')->getInventory($id);
            $form->setData($inventory);
        }

        // Set view
        $this->view()->setTemplate('list-update');
        $this->view()->assign('config', $config);
        $this->view()->assign('form', $form);
        $this->view()->assign('title', __('Add / Edit'));
    }
}
