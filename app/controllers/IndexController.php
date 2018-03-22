<?php

use Domain\Deposit;

/**
 * User: Stepan S. Nikiforov (s.nikiforov@innosoft.ru)
 * Date: 14/12/2017
 * Time: 17:24
 */
class IndexController extends BaseController
{
    public function initialize()
    {
        parent::initialize();
        $this->view->setVar('subtitle', 'This text is from IndexController->initialize()');
    }

    public function indexAction()
    {
        $title = 'Accounts';
        $this->view->setVar('title', $title);

        $this->view->setVar('error', false);
        $accounts = Accounts::find();
        $this->view->setVar('accounts', $accounts);
    }

    public function depositAction()
    {
        $error = false;
        try {
            $command = new Deposit(
                $this->request->getPost('number'),
                $this->request->getPost('amount'));
            $command->execute();
        } catch (Exception $e) {
            $error = $e->getMessage();
        }

        $this->view->setVar('error', $error);
        $accounts = Accounts::find();
        $this->view->setVar('accounts', $accounts);
    }
}
