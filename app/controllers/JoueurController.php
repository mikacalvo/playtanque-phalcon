<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class JoueurController extends ControllerBase
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
        $this->view->userJoueurs = $user->usersJoueurs;
        $this->assets
            ->addJs('js/vendor/stacktable.js', true)
            ->addJs('js/joueur.js', true);
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {
        if ($this->request->isPost()) {
            $joueur = new Joueur();

            $joueur->nom = $this->request->getPost("nom");
            $joueur->prenom = $this->request->getPost("prenom");
            $joueur->options->poste = $this->request->getPost("poste");

            if (!$joueur->save()) {
                foreach ($joueur->getMessages() as $message) {
                    $this->flashSession->error($message);
                }

                return $this->dispatcher->forward(array(
                    "controller" => "joueur",
                    "action" => "new"
                ));
            }

            $this->flashSession->success("joueur créé");
            $this->response->redirect('joueur');
            $this->view->disable();
            return;
        }
    }

    /**
     * Edits a joueur
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $joueur = Joueur::findFirstByid($id);
            if (!$joueur) {
                $this->flashSession->error("joueur introuvable");

                return $this->dispatcher->forward(array(
                    "controller" => "joueur",
                    "action" => "index"
                ));
            }

            $this->view->id = $joueur->id;

            $this->tag->setDefault("id", $joueur->id);
            $this->tag->setDefault("nom", $joueur->nom);
            $this->tag->setDefault("prenom", $joueur->prenom);
            $this->tag->setDefault("poste", $joueur->options->poste);
        }
    }

    /**
     * Creates a new joueur
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "joueur",
                "action" => "index"
            ));
        }

        $joueur = new Joueur();

        $joueur->nom = $this->request->getPost("nom");
        $joueur->prenom = $this->request->getPost("prenom");
        $joueur->options->poste = $this->request->getPost("poste");

        if (!$joueur->save()) {
            foreach ($joueur->getMessages() as $message) {
                $this->flashSession->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "joueur",
                "action" => "new"
            ));
            $this->response->redirect('joueur/new');
            $this->view->disable();
            return;
        }

        $this->flashSession->success("joueur créé");

        return $this->dispatcher->forward(array(
            "controller" => "joueur",
            "action" => "index"
        ));
    }

    /**
     * Saves a joueur edited
     *
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "joueur",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $joueur = Joueur::findFirstByid($id);
        if (!$joueur) {
            $this->flashSession->error("joueur ".$id." introuvable");

            return $this->dispatcher->forward(array(
                "controller" => "joueur",
                "action" => "index"
            ));
        }

        $joueur->nom = $this->request->getPost("nom");
        $joueur->prenom = $this->request->getPost("prenom");
        $joueur->options->poste = $this->request->getPost("poste");

        if (!$joueur->save()) {
            foreach ($joueur->getMessages() as $message) {
                $this->flashSession->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "joueur",
                "action" => "edit",
                "params" => array($joueur->id)
            ));
        }

        $this->flashSession->success("joueur modifié");

        return $this->dispatcher->forward(array(
            "controller" => "joueur",
            "action" => "index"
        ));
    }

    /**
     * Deletes a joueur
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $joueur = Joueur::findFirstByid($id);
        if (!$joueur) {
            $this->flashSession->error("joueur inconnu");

            return $this->dispatcher->forward(array(
                "controller" => "joueur",
                "action" => "index"
            ));
        }

        if (!$joueur->delete()) {
            foreach ($joueur->getMessages() as $message) {
                $this->flashSession->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "joueur",
                "action" => "index"
            ));
        }

        $this->flashSession->success("joueur supprimé");

        return $this->dispatcher->forward(array(
            "controller" => "joueur",
            "action" => "index"
        ));
    }

}
