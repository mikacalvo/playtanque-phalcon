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

        $this->view->id = $user->id;

        $this->tag->setDefault("id", $user->id);
        $this->tag->setDefault("username", $user->username);
        $this->tag->setDefault("date_creation", $user->date_creation);
    }
    
    public function parameterAction()
    {
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
}