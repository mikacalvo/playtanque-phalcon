<?php

class IndexController extends ControllerBase
{
    /**
     *
     */
    public function initialize()
    {
        parent::initialize();
        $this->assets
        	->addJs('js/index.js', true);
    }

    public function indexAction()
    {
        $auth = $this->session->get('auth');
        if (!$auth) {
	        $this->response->redirect("login");
	        return $this->view->disable();
	    } else {
	        $this->response->redirect("logout");
	        return $this->view->disable();
	    }
    }

}

