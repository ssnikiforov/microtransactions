<?php
use Phalcon\Mvc\Controller;

/**
 * User: Stepan S. Nikiforov (s.nikiforov@innosoft.ru)
 * Date: 14/12/2017
 * Time: 17:50
 */
class SignupController extends Controller
{
    public function indexAction()
    {

    }

    public function registerAction()
    {
        print_r($this->di->getService('sys'));

//        $user = new Users();
//
//        // Store and check for errors
//        $success = $user->save(
//            $this->request->getPost(),
//            [
//                "name",
//                "email",
//            ]
//        );
//
//        if ($success) {
//            echo "Thanks for registering!";
//        } else {
//            echo "Sorry, the following problems were generated: ";
//
//            $messages = $user->getMessages();
//
//            foreach ($messages as $message) {
//                echo $message->getMessage(), "<br/>";
//            }
//        }
//
//        $this->view->disable();
    }
}
