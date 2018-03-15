<?php

/**
 * User: Stepan S. Nikiforov (s.nikiforov@innosoft.ru)
 * Date: 14/12/2017
 * Time: 17:24
 */
class IndexController extends BaseController
{
    public function initialize() {
        parent::initialize();
        $this->view->setVar('subtitle', 'This text is from IndexController->initialize()');
    }

    public function indexAction()
    {
        $name = 'Stepan Nikiforov';
        $title = 'Главная страница';

        $this->view->setVar('name', $name);
        $this->view->setVar('title', $title);
//        echo '<h1>Hello from IndexController - indexAction()</h1>';
    }
}
