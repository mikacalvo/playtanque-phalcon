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
        	->addJs('https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js', false)
        	->addJs('js/vendor/noty/packaged/jquery.noty.packaged.min.js', true)
        	->addJs('js/main.js', true)
        	->addCss('css/main.css', true)
        	->addCss('css/mobile.css', true)
        	->addCss('css/vendor/knacss.css', true)
        	->addCss('css/vendor/buttons-core.css', true)
        	->addCss('css/vendor/buttons.css', true)
        	->addCss('css/vendor/font-awesome/css/font-awesome.min.css', true);

        $this->tag->setTitle("Playtanque : organisez vos tournois de pétanque en un clic !");
    }
}
