<?php

class PlayController extends ControllerBase
{
    /**
     *
     */
    public function initialize()
    {
        parent::initialize();
        $auth = $this->session->get('auth');
        if ($auth) {
        	// JS des enregistrements en BDD
	        // $this->assets
	        // 	->addJs('js/vendor/foundation.js', true)
	        // 	->addJs('js/vendor/foundation.dropdown.js', true)
	        // 	->addCss('css/vendor/foundation.css', true);
        }
        $this->view->setTemplateAfter('app');
    }

    public function indexAction()
    {

    }

}

