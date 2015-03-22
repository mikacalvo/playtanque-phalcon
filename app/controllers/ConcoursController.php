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
        $concours = Concours::findFirstByid($id);
        if (!$concours) {
            $this->flashSession->error("Concours introuvable");

            return $this->dispatcher->forward(array(
                "controller" => "concours",
                "action" => "index"
            ));
        }
        if ($this->request->isPost()) {
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
            $concours->options = json_decode($concours->options);
        }
        $this->view->id = $concours->id;

        $this->tag->setDefault("id", $concours->id);
        $this->tag->setDefault("label", $concours->label);
        $this->tag->setDefault("date", $concours->date);
        $this->tag->setDefault("type", $concours->options->type);
        $this->tag->setDefault("equipe", $concours->options->equipe);
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


    /**
     * Gère les participants
     *
     * @param string $id
     */
    public function participantsAction($id)
    {
        $this->view->concoursJoueurs = $user->concoursJoueurs;
        if (!$this->request->isPost()) {
            $concours = Concours::findFirstByid($id);
            if (!$concours) {
                $this->flashSession->error("Concours introuvable");

                return $this->dispatcher->forward(array(
                    "controller" => "concours",
                    "action" => "index"
                ));
            }

            $this->view->concours = $concours;

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
     * Ajoute à la consolante
     */
    public function addToConsolanteAjax()
    {
        if ($this->request->isPost()) {
            $consolante = new Consolante();
            $consolante->concours_id = $this->request->getPost("concours_id");
            if (is_int($this->request->getPost("joueur1"))) {
                $consolante->joueur1 =  $this->request->getPost("joueur1");
            } else {
                $consolante->joueur_tmp[] = $this->request->getPost("joueur1");
            }
            if (is_int($this->request->getPost("joueur2"))) {
                $consolante->joueur2 =  $this->request->getPost("joueur2");
            } else {
                $consolante->joueur_tmp[] = $this->request->getPost("joueur2");
            }
            if (is_int($this->request->getPost("joueur3"))) {
                $consolante->joueur3 =  $this->request->getPost("joueur3");
            } else {
                $consolante->joueur_tmp[] = $this->request->getPost("joueur3");
            }
            if (!$consolante->save()) {
                return json_encode($consolante->getMessages());
            } else {
                return true;
            }
        }
    }
}
