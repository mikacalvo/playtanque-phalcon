<?php

use Phalcon\Mvc\User\Component;

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Elements extends Component
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
    public function getHeader()
    {
    	echo 
			'<nav class="left tiny-hidden">
        	    <h1 id="genereTeams" class="h5-like app-title white" style="padding-top:10px; line-height:0;">Playtanque</h1>
			</nav>
			<nav class="right" style="margin-right: 10px;">
				'.$this->getUserBar().'
			</nav>';
    }

    /**
     * Builds header menu with left and right items
     *
     * @return string
     */
    public function getUserBar()
    {
        $auth = $this->session->get('auth');
        if (!$auth) {
            return
            	'<div class="userbar">
	            	<button class="pure-button username">Mode Hors Ligne</button>
	            	'.$this->tag->linkTo('index', '<a class="pure-button settings" title="Retour à la page de connexion" href="index"><i class="fa fa-sign-in"></i></a>').'
				</div>';
        } else {
            return 
            	'<div class="userbar">
            		<div class="dropdown">
		            	<button class="pure-button username dropdown-trigger" style="width:135px;">
		            		<span>'.$auth['username'].'</span> <i class="fa fa-caret-down right"></i><i class="fa fa-caret-up right"></i>
		            	</button>
		            	<ul id="usermenu" class="dropdown-menu">
							<li>'.$this->tag->linkTo(array('concours', 'Mes concours', "class"=>"b-light-gray dark-gray")).'</li>
							<li>'.$this->tag->linkTo(array('joueur', 'Mes joueurs', "class"=>"b-light-gray dark-gray")).'</li>
							<li>'.$this->tag->linkTo(array('historique', 'Historique', "class"=>"b-light-gray dark-gray")).'</li>
						</ul>
					</div>
            		<div class="dropdown">
						<button class="pure-button settings dropdown-trigger"><i class="fa fa-cog" style="margin-right:4px;"></i><i class="fa fa-caret-down right"></i><i class="fa fa-caret-up right"></i></button>
		            	<ul id="usermenu" class="dropdown-menu">
							<li>'.$this->tag->linkTo(array('settings', '<i class="fa fa-wrench"></i>', 'title'=>'Mon compte', "class"=>"b-light-gray dark-gray")).'</li>
							<li>'.$this->tag->linkTo(array('logout', '<i class="fa fa-sign-out"></i>', 'title'=>'Déconnexion', "class"=>"b-light-gray dark-gray")).'</li>
						</ul>
					</div>
				</div>';
        }
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

