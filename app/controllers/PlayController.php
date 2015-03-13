<?php

class PlayController extends ControllerBase
{
    /**
     *
     */
    public function initialize()
    {
        parent::initialize();
        $this->assets
            ->addJs('//code.jquery.com/ui/1.11.3/jquery-ui.js', false)
            ->addJs('js/vendor/jquery.tablesorter.js', true)
            ->addJs('js/consolante.js', true)
            ->addJs('js/inter.js', true)
            ->addJs('js/point.js', true)
            ->addJs('js/match.js', true)
            ->addJs('js/concours.js', true)
            ->addJs('js/teams.js', true);
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

    /**
     * Affiche un concours en mode hors ligne
     *
     */
    public function indexAction()
    {

    }

    /**
     * Affiche un concours
     *
     * @param string $id
     */
    public function concoursAction($id)
    {

    }

}

