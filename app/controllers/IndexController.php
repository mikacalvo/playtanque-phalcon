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

    }

}

