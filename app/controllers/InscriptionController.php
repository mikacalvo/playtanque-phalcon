<?php

class InscriptionController extends ControllerBase
{
    private function _registerSession($user)
    {
        $this->session->set('auth', array(
            'id' => $user->id,
            'username' => $user->username
        ));
    }

    public function indexAction()
    {
        if ($this->request->isPost()) {
            $user = new Users;
			$user->username = $this->request->getPost('username', 'string'); 
			$user->email    = $this->request->getPost('email', 'email'); 
			$user->password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
			$user->date_creation = date("Y-m-d");
			$user->is_actif = 1;
            
            if (!$user->save() != false) {
	            $this->flashSession->error(implode(', ', $user->getMessages()));
		        $this->response->redirect("index/");
		        return $this->view->disable();
            }
            
            $this->flashSession->success('Welcome ' . $user->username);
            $this->_registerSession($user);
	        $this->response->redirect("play");
	        return $this->view->disable();
        }
    }

}