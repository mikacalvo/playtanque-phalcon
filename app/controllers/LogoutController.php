<?php

class LogoutController extends Phalcon\Mvc\Controller
{
    private function _deleteSession()
    {
        $this->session->remove('auth');
    }

    public function indexAction()
    {
        $this->_deleteSession();
        $this->response->redirect("login");
        return $this->view->disable();
    }
}