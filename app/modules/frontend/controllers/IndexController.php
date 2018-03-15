<?php

namespace Microtransactions\Modules\Frontend\Controllers;

use Microtransactions\Modules\Frontend\Models\Accounts;
use MongoDB\BSON\ObjectID;
use MongoDB\Collection;

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
//        phpinfo();
//        die();
//        var_dump(Accounts::findById('5aaae55085c1c142723f5374'));
        $mongoId = '5aaae55085c1c142723f5374';
        $objectId = new ObjectID($mongoId);
        $collection = new Collection();
        $collection->find(['_id'=> $objectId);

//        var_dump(Accounts::foo());
        $this->view->setVar('name', $name);
        $this->view->setVar('title', $title);
//        echo '<h1>Hello from IndexController - indexAction()</h1>';
    }
}
