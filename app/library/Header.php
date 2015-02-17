<?php

use Phalcon\Mvc\User\Component;

/**
 * Header
 *
 * Helps to build UI elements for the application
 */
class Header extends Component
{

    private $_headerMenu = array(
        'navbar-left' => array(
            'produit' => array(
                'caption' => 'Nos Produits',
                'action' => 'index'
            ),
            'mktg' => array(
                'caption' => 'Marketing',
                'action' => 'index'
            ),
        ),
        'navbar-right' => array(
            'session' => array(
                'caption' => 'Log In/Sign Up',
                'action' => 'index'
            ),
        )
    );

    private $_tabs = array(
        'Commande' => array(
            'controller' => 'mktg',
            'action' => 'index',
            'any' => false
        ),
        'Rubriques' => array(
            'controller' => 'mktg_rubrique',
            'action' => 'index',
            'any' => true
        ),
        'Produits' => array(
            'controller' => 'mktg_produit',
            'action' => 'index',
            'any' => true
        ),
    );

    /**
     * Builds header menu with left and right items
     *
     * @return string
     */
    public function getHeader($typeConcours)
    {
    	echo 
			'<header class="zero no-print">
			    <a id="show" class="pas">
			      <i class="fa fa-chevron-right fa-2x inbl"></i>
			    </a>
			    <section id="titre" class="man small-hidden tiny-hidden">
			      <h1 class="app-title">Playtanque</h1>
			    </section>
			    <section id="typeTournoi" class="mats">
			      <div class="col">
			        <div class="mod">
			          <span id="Consolante" data-div="consolante" class="navspan h5-like restart">
			            <i class="fa fa-sitemap mash"></i>
			            <strong class="small-hidden tiny-hidden">Consolante</strong>
			          </span>
			        </div>
			        <div class="mod">
			          <span id="Inter" data-div="inter" class="navspan h5-like dynamic">
			            <i class="fa fa-users mash"></i>
			            <strong class="small-hidden tiny-hidden">Mêlée</strong>
			          </span>
			        </div>
			        <div class="mod">
			          <span id="Point" data-div="inter" class="navspan h5-like">
			            <i class="fa fa-flag mash"></i>
			            <strong class="small-hidden tiny-hidden">Points</strong>
			          </span>
			        </div>
			      </div>
			    </section>

			    <section id="teamManagement" class="mats pas top-border">
			      <div id="commands">
			        <a id="hide" class="tiny-hidden row">
			          <i class="fa fa-chevron-left fa-2x inbl"></i>
			          <label class="inbl man">Masquer</label>
			        </a>
			        <a id="startConcours" class="row">
			          <i class="fa fa-random fa-2x inbl"></i>
			          <label class="tiny-hidden man inbl">Tirage</label>
			        </a>
			      </div>
			      <div class="icon-input dark">
			        <input type="text" id="teaminput" class="dark pas par" placeholder="Ajouter des joueurs" />
			        <i class="fa fa-plus fa-2x tiny-hidden" id="addteam"></i>
			        <i class="fa fa-plus fa-2x small-hidden medium-hidden large-hidden" id="addteam-mobile"></i>
			      </div>
			      <div class="row tiny-hidden">
			        <span id="nbEquipes" class="bold right">0 <span>équipes</span></span>
			      </div>
			      <div id="teams" class="mats no-scroll">
			        <div class="scroll-v">
			          <ul id="teamlist" class="unstyled pan datalist"></ul>
			        </div>
			      </div>
			    </section>

			    <footer class="footer tiny-hidden small-hidden">
			      <em id="genereTeams" class="info man">&hearts; Pétanque &hearts;</em>
			    </footer>
			  </header>';

    }

    /**
     * Returns menu tabs
     */
    public function getTabs()
    {
        $controllerName = $this->view->getControllerName();
        $actionName = $this->view->getActionName();
        echo '<ul class="nav nav-tabs">';
        foreach ($this->_tabs as $caption => $option) {
            if ($option['controller'] == $controllerName && ($option['action'] == $actionName || $option['any'])) {
                echo '<li class="active">';
            } else {
                echo '<li>';
            }
            echo $this->tag->linkTo($option['controller'] . '/' . $option['action'], $caption), '<li>';
        }
        echo '</ul>';
    }
}

