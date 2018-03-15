<?php
namespace Microtransactions\Modules\Frontend\Controllers;

class IndexController extends ControllerBase
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
