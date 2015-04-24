<?php

use Phalcon\Mvc\User\Component;

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Elements extends Component
{
    private $_nav = array(
        'Concours' => array(
            'controller' => 'concours',
            'action'     => 'index',
            'any'        => true,
            'title'      => 'Mes concours',
            'icon'       => 'trophy',
            'color'      => 'red',
        ),
        'Joueur' => array(
            'controller' => 'joueur',
            'action'     => 'index',
            'any'        => true,
            'title'      => 'Mes joueurs',
            'icon'       => 'users',
            'color'      => 'blue',
        ),
        'Historique' => array(
            'controller' => 'historique',
            'action'     => 'index',
            'any'        => true,
            'title'      => 'Mon historique',
            'icon'       => 'bar-chart',
            'color'      => 'green',
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
			'<nav class="inbl">
        	    <!--h1 id="genereTeams" class="h5-like app-title white inbl">Playtanque</h1-->
			</nav>
			<nav class="fr" style="margin-right: 10px;">
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
                    <button class="pure-button b-lighter-gray username">Mode Hors Ligne</button>
                    '.$this->tag->linkTo(array('index', '<i class="fa fa-sign-in"></i>', 'class'=>'pure-button b-lighter-gray settings', 'title'=>'Retour à la page de connexion')).'
                </div>';
        } else {
            return
                '<div class="userbar">
                    <div class="dropdown">
                        <button class="pure-button username b-lighter-gray">
                            <span>'.$auth['username'].'</span>
                        </button>
                    </div>
                    <div class="dropdown">
                        <button class="pure-button settings b-lighter-gray dropdown-trigger"><i class="fa fa-cog" style="margin-right:4px;"></i><i class="fa fa-caret-down right"></i><i class="fa fa-caret-up right"></i></button>
                        <ul id="usermenu" class="dropdown-menu">
                            <li>'.$this->tag->linkTo(array('settings', '<i class="fa fa-wrench"></i>', 'title'=>'Mon compte', "class"=>"b-light-gray dark-gray")).'</li>
                            <li>'.$this->tag->linkTo(array('logout', '<i class="fa fa-sign-out"></i>', 'title'=>'Déconnexion', "class"=>"b-light-gray dark-gray")).'</li>
                        </ul>
                    </div>
                </div>';
        }
    }

    /**
     * Builds header menu with left and right items
     *
     * @return string
     */
    public function getNav()
    {
        $return = '<aside class="flex-item-first">
                <nav id="navigation" role="navigation">
                    <ul class="unstyled pan">';
        foreach ($this->_nav as $ctrl => $param) {
            $return .= '<li class="mbs">
                            '.$this->tag->linkTo(array($param['controller'], '<i class="fa fa-2x fa-'.$param['icon'].' fl"></i><span class="mls small-hidden">'.$param['title'].'</span>', "class"=>"pure-button b-".$param['color']." white white-hover shadow-hover")).'
                        </li>';
        }
        return $return . '</ul>
                </nav>
            </aside>';
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

    /**
     * Builds header menu with left and right items
     *
     * @return string
     */
    public function getMenu()
    {

        $auth = $this->session->get('auth');
        if ($auth) {
            $this->_headerMenu['navbar-right']['session'] = array(
                'caption' => 'Log Out',
                'action' => 'end'
            );
        } else {
            unset($this->_headerMenu['navbar-left']['invoices']);
        }

        $controllerName = $this->view->getControllerName();
        foreach ($this->_headerMenu as $position => $menu) {
            echo '<div class="nav-collapse">';
            echo '<ul class="nav navbar-nav ', $position, '">';
            foreach ($menu as $controller => $option) {
                if ($controllerName == $controller) {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                echo $this->tag->linkTo($controller . '/' . $option['action'], $option['caption']);
                echo '</li>';
            }
            echo '</ul>';
            echo '</div>';
        }

    }
}

