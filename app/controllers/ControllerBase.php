<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    /**
     *
     */
    public function initialize()
    {
        $this->assets
        	->addJs('js/vendor/jquery-2.1.0.min.js', true)
        	->addJs('js/vendor/jquery-ui-1.11.2.custom/jquery-ui.min.js', true)
        	->addJs('js/vendor/jquery.tablesorter.js', true)
        	->addJs('js/concours.js', true)
        	->addJs('js/consolante.js', true)
        	->addJs('js/inter.js', true)
        	->addJs('js/point.js', true)
        	->addJs('js/match.js', true)
        	->addJs('js/teams.js', true)
        	->addJs('js/main.js', true)
        	->addCss('css/main.css', true)
        	->addCss('css/mobile.css', true)
        	->addCss('css/vendor/knacss.css', true)
        	->addCss('css/vendor/buttons-core.css', true)
        	->addCss('css/vendor/buttons.css', true)
        	->addCss('css/vendor/font-awesome/css/font-awesome.min.css', true)
        	->addCss('js/vendor/jquery-ui-1.11.2.custom/jquery-ui.min.css', true);
        	
        // $this->view->setTemplateAfter('main');
    }
}
