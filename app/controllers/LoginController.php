<?php

class LoginController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {

    }

    public function loginAction()
    {
      if($this->request->isPost()){
      $user = Users::findFirst(array(
        'username = :username: and password = :password:', 'bind' => array(
          'username' => $this->request->getPost('username'),
          'password' => $this->request->getPost('password')
        )
      ));
      if($user == false){
        $this->flash->error("wrong id or password");
        return $this->dispatcher->forward([
          'controller' => 'login',
          'action'  => 'index'
        ]);
      }
        $this->session->set("username", $user->username);
        $this->flash->success('you have successfully login');
        return $this->dispatcher->forward([
          'controller' => 'user',
          'action'  => 'index'
        ]);

      }
    }
    public function logoutAction()
    {
      $this->session->destroy();
      $this->flash->success("You are successfully logout");
      return $this->dispatcher->forward([
        'controller' => 'login',
        'action'    =>'index'
      ]);
    }

}
