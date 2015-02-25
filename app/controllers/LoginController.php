<?php

class LoginController extends ControllerBase
{
    private function _registerSession($user)
    {
        $this->session->set('auth', array(
			'id'       => $user->id,
			'username' => $user->username,
			'email'    => $user->email
        ));
    }

    public function indexAction()
    {
        if ($this->request->isPost()) {
            //Receiving the variables sent by POST
			$email    = $this->request->getPost('email', 'email');
			$password = $this->request->getPost('password');
			$hash     = password_hash($password, PASSWORD_DEFAULT);

            //Find for the user in the database
            $user = Users::findFirst(array(
                "email = :email: AND is_actif = 1",
                "bind" => array('email' => $email)
            ));
            if ($user != false && password_verify($password, $user->password)) {
                $this->_registerSession($user);
		        $this->response->redirect("concours");
		        return $this->view->disable();
            }
            $this->flashSession->error('Mauvaise combinaison email/password.');
        }
    }
}