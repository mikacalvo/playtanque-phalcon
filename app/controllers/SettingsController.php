<?php

class SettingsController extends ControllerBase
{
    /**
     *
     */
    public function initialize()
    {
        parent::initialize();
        $this->view->setTemplateAfter('app');
    }
    
    public function indexAction()
    {
        $user = Users::findFirstByid($this->session->get('auth')['id']);
		if (!$user) {
            $this->flashSession->error("Vous devez être connecté.");
	        $this->response->redirect("index");
	        return $this->view->disable();
        }
        if ($this->request->isPost()) {
			$user->username = $this->request->getPost("username");
			$user->options  = $this->request->getPost("options");
			if (!empty($this->request->getPost('password'))) {
				if (!password_verify($this->request->getPost('password'), $user->password)) {
					$this->flashSession->error("Mot de passe actuel incorrect.");
				} else if ($this->request->getPost("newpassword") != $this->request->getPost("confirmpassword")) {
					$this->flashSession->error("Les deux mots de passe ne correspondent pas.");
				} else {
					$user->password = password_hash($this->request->getPost('newpassword'), PASSWORD_DEFAULT);
			        $this->tag->setDefault("password", '');
			        $this->tag->setDefault("newpassword", '');
			        $this->tag->setDefault("confirmpassword", '');
				}
			}
			if (!$this->flashSession->has('error')) {
	            if (!$user->save() != false) {
	            	foreach ($user->getMessages() as $message) {
		            	$this->flashSession->error($message);
	            	}
	            } else {
	            	$this->flashSession->success("Changements sauvegardés.");
	            	$this->_registerSession($user);
	            }
			}
        }
        
        $this->view->id = $user->id;

        $this->tag->setDefault("username", $user->username);
        $this->tag->setDefault("date_creation", $user->date_creation);
        $this->tag->setDefault("date_creation", $user->date_creation);
        $this->view->options = $user->options;
    }
    
    public function parameterAction()
    {
    	$user = Users::findFirstByid($this->session->get('auth')['id']);
		if (!$user) {
            $this->flashSession->error("Vous devez être connecté.");
	        $this->response->redirect("index");
	        return $this->view->disable();
        }
        $user->options = $this->request->getPost('options');
        if (!$user->save() != false) {
        	foreach ($user->getMessages() as $message) {
            	$this->flashSession->error($message);
        	}
        } else {
        	$this->flashSession->success("Changements sauvegardés.");
        }
        $this->response->redirect('settings');
		$this->view->disable();
		return;
    }
    
    public function clubAction()
    {
        $user = Users::findFirstByid($this->session->get('auth')['id']);

        $this->view->id = $user->id;

        $this->tag->setDefault("id", $user->id);
        $this->tag->setDefault("username", $user->username);
        $this->tag->setDefault("date_creation", $user->date_creation);
    }
    
    public function editAction()
    {
        if (!$this->request->isPost()) {
            $user = Users::findFirstByid($this->session->get('auth')['id']);
            if (!$user) {
                $this->flashSession->error("user introuvable");

                return $this->dispatcher->forward(array(
                    "controller" => "user",
                    "action" => "index"
                ));
            }

            $this->view->id = $user->id;

            $this->tag->setDefault("id", $user->id);
            $this->tag->setDefault("label", $user->label);
            $this->tag->setDefault("date", $user->date);
            $this->tag->setDefault("options", $user->options);
        }
    }
    
    private function _registerSession($user)
    {
        $this->session->set('auth', array(
			'id'       => $user->id,
			'username' => $user->username,
			'email'    => $user->email
        ));
    }
}