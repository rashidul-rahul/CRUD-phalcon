<?php

class UserController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $this->view->users = Users::find();
    }

    public function showAction($userId){
      $this->view->user = Users::findFirstById($userId);
    }

    public function newAction()
    {

    }

    public function createAction()
    {

      if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "user",
                'action' => 'index'
            ]);

            return;
        }

      $user = new Users();
      $user->username = $this->request->getPost("username");
      $user->email = $this->request->getPost("email");
      $user->password = $this->request->getPost("password");

     $user->save();

     $this->dispatcher->forward([
       'controller' => 'user',
       'action' => 'index'
     ]);
    }
    public function reviewAction($userId)
    {
      $this->view->user = Users::findFirstById($userId);
    }

    public function editAction($userId)
    {

      $user = Users::findFirstById($userId);
      $user->username = $this->request->getPost("username");
      $user->email = $this->request->getPost("email");
      $user->password = $this->request->getPost("password");
      $user->save();
      $this->dispatcher->forward([
        'controller' => 'user',
        'action'    =>'index'
      ]);

    }
    public function deleteAction($Id)
    {
      $user = Users::findFirstById($Id);
      $user->delete();
      $this->dispatcher->forward([
        'controller' => 'user',
        'action'    =>'index'
      ]);
    }


}
