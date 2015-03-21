<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class ConcoursController extends ControllerBase
{
    /**
     *
     */
    public function initialize()
    {
        parent::initialize();
        $this->view->setTemplateAfter('app');
    }

    /**
     * Index action
     */
    public function indexAction()
    {
        $user = Users::findFirstByid($this->session->get('auth')['id']);
        $this->view->userConcours = $user->usersConcours;
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {
    }

    /**
     * Edits a concours
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $concours = Concours::findFirstByid($id);
            if (!$concours) {
                $this->flashSession->error("Concours introuvable");

                return $this->dispatcher->forward(array(
                    "controller" => "concours",
                    "action" => "index"
                ));
            }

            $this->view->id = $concours->id;

            $this->tag->setDefault("id", $concours->id);
            $this->tag->setDefault("label", $concours->label);
            $this->tag->setDefault("date", $concours->date);
            $this->tag->setDefault("type", $concours->options->type);
            $this->tag->setDefault("equipe", $concours->options->equipe);
        } else {
            $id = $this->request->getPost("id");

            $concours = Concours::findFirstByid($id);
            if (!$concours) {
                $this->flashSession->error("Concours introuvable");

                return $this->dispatcher->forward(array(
                    "controller" => "concours",
                    "action" => "index"
                ));
            }

            $concours->label   = $this->request->getPost("label");
            $concours->date    = $this->request->getPost("date");
            $concours->options = array(
                'type'   => $this->request->getPost("type"),
                'equipe' => $this->request->getPost("equipe"),
            );

            if (!$concours->save()) {
                foreach ($concours->getMessages() as $message) {
                    $this->flashSession->error($message);
                }
            }

            $this->flashSession->success("Paramètres sauvegardés");
        }
    }

    /**
     * Creates a new concours
     */
    public function createAction()
    {
        if ($this->request->isPost()) {
	        $concours = new Concours();
			$concours->label = $this->request->getPost("label");
			$concours->date  = $this->request->getPost("date");

	        if (!$concours->save()) {
	            foreach ($concours->getMessages() as $message) {
	                $this->flashSession->error($message);
	            }
	        } else {
	        	$this->flashSession->success('Concours ajouté');
	        }
	        $this->response->redirect('concours/new');
			$this->view->disable();
			return;
        } else {
	        $this->response->redirect('concours/new');
			$this->view->disable();
            return;
        }
    }

    /**
     * Saves a concours edited
     *
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "concours",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $concours = Concours::findFirstByid($id);
        if (!$concours) {
            $this->flashSession->error("Concours introuvable");

            return $this->dispatcher->forward(array(
                "controller" => "concours",
                "action" => "index"
            ));
        }

		$concours->label   = $this->request->getPost("label");
        $concours->date    = $this->request->getPost("date");
        $concours->options = array(
            'type'   => $this->request->getPost("type"),
            'equipe' => $this->request->getPost("equipe"),
        );

        if (!$concours->save()) {
            foreach ($concours->getMessages() as $message) {
                $this->flashSession->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "concours",
                "action" => "edit",
                "params" => array($concours->id)
            ));
        }

        $this->flashSession->success("Concours modifié");

        return $this->dispatcher->forward(array(
            "controller" => "concours",
            "action" => "index"
        ));
    }

    /**
     * Deletes a concours
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $concours = Concours::findFirstByid($id);
        if (!$concours) {
            $this->flashSession->error("Concours introuvable");

            return $this->dispatcher->forward(array(
                "controller" => "concours",
                "action" => "index"
            ));
        }

        if (!$concours->delete()) {
            foreach ($concours->getMessages() as $message) {
                $this->flashSession->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "concours",
                "action" => "search"
            ));
        }

        $this->flashSession->success("Concours supprimé");
        $this->response->redirect('concours');
        $this->view->disable();
        return;
    }

    /**
     * Définit les options souhaitées
     *
     * @param string $id
     */
    public function settingsAction($id)
    {
        $concours = Concours::findFirstByid($id);
        if (!$concours) {
            $this->flashSession->error("Concours introuvable");

            return $this->dispatcher->forward(array(
                "controller" => "concours",
                "action" => "index"
            ));
        }

        $this->view->id = $concours->id;

        $this->tag->setDefault("id", $concours->id);
        $this->tag->setDefault("label", $concours->label);
        $this->tag->setDefault("date", $concours->date);
        $this->tag->setDefault("options", $concours->options);
    }

}
