<?php

class HistoriqueController extends ControllerBase
{
    /**
     *
     */
    public function initialize()
    {
        parent::initialize();
        $this->view->setTemplateAfter('app');
        $this->assets
            ->addJs('js/vendor/angular.min.js', true)
            ->addJs('js/vendor/highcharts.js', true)
            ->addJs('js/vendor/highcharts-ng.js', true)
            ->addJs('js/historique.js', true)
            ->addCss('css/historique.css', true);
    }

    public function indexAction()
    {
    }

}

