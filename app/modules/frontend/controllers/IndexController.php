<?php

namespace Microtransactions\Modules\Frontend\Controllers;

use Microtransactions\Modules\Frontend\Models\Accounts;

class IndexController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
        $this->view->setVar('subtitle', 'This text is from IndexController->initialize()');
    }

    public function indexAction()
    {
        $name = 'Stepan Nikiforov';
        $title = 'Главная страница';
        $name = Accounts::findById('5aaae0b014e98429d6926822');
        $this->view->setVar('name', $name);
        $this->view->setVar('title', $title);
//        echo '<h1>Hello from IndexController - indexAction()</h1>';
    }
}
