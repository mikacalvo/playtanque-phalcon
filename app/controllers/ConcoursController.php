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
        $this->assets
            ->addCss('https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css', false)
            ->addJs('https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js', false);
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
            } else {
                $this->flashSession->success("Paramètres sauvegardés");
            }

            $concours->options = json_decode($concours->options);
        }
        $this->view->id = $concours->id;

        $this->tag->setDefault("id", $concours->id);
        $this->tag->setDefault("label", $concours->label);
        $this->tag->setDefault("date", $concours->date);
        if ($concours->options) {
            $this->tag->setDefault("type", $concours->options->type);
            $this->tag->setDefault("equipe", $concours->options->equipe);
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


    /**
     * Gère les participants
     *
     * @param string $id
     */
    public function participantsAction($id)
    {
        $this->assets->addJs('js/participants.js', true);
        $concours = Concours::findFirstByid($id);
        if (!$concours) {
            $this->flashSession->error("Concours introuvable");

            return $this->dispatcher->forward(array(
                "controller" => "concours",
                "action" => "index"
            ));
        }

        $this->view->concours = $concours;
        $equipes = Equipe::find(array("concours_id = ".$id));

        $this->view->equipes   = $equipes;
        $this->view->nbEquipes = $equipes->count();

        $sql = "SELECT j.id, j.nom, j.prenom, j.options FROM joueur j INNER JOIN users_joueurs uj on uj.joueur_id = j.id
            WHERE uj.user_id = ".$this->session->get('auth')['id']." AND j.id not in (SELECT ej.joueur_id FROM equipes_joueurs ej inner join equipe e on e.concours_id = " . $id . ")";
        $result_set = $this->db->query($sql);
        $result_set->setFetchMode(Phalcon\Db::FETCH_OBJ);
        $this->view->availableJoueurs = $result_set->fetchAll($result_set);

        $this->tag->setDefault("id", $concours->id);
        $this->tag->setDefault("label", $concours->label);
        $this->tag->setDefault("date", $concours->date);
        $this->tag->setDefault("type", $concours->options->type);
        $this->tag->setDefault("tailleEquipe", $concours->options->equipe);
    }


    /**
     * Ajoute à la consolante
     */
    public function addEquipeAction()
    {
        if ($this->request->isPost()) {
            $concours = Concours::findFirstByid($this->request->getPost("id"));
            try {
                $this->db->begin();
                if("melee" == $concours->options->type) {
                    $equipe = Equipe::findFirst(array(
                        "concours_id = " . $concours->id
                    ));
                    if (!$equipe) {
                        $equipe = new Equipe();
                        $equipe->concours_id = $this->request->getPost("id");
                        $equipe->data = array(
                            '1' => array(),
                            '2' => array(),
                            '3' => array(),
                        );
                        if (!$equipe->save()) {
                            foreach ($equipe->getMessages() as $message) {
                                $this->flashSession->error($message);
                                throw new Exception();
                            }
                        }
                    }
                    if (filter_input(INPUT_POST, "joueur", FILTER_VALIDATE_INT)) {
                        if (!$this->addJoueur($equipe->id, $this->request->getPost("joueur"))) {
                            throw new Exception();
                        }
                    } else {
                        $equipe->data[$this->request->getPost("poste")] = $this->request->getPost("joueur");
                        if (!$equipe->save()) {
                            foreach ($equipe->getMessages() as $message) {
                                $this->flashSession->error($message);
                                throw new Exception();
                            }
                        }
                    }
                    $this->flashSession->success("Participant(e) ajouté(e)");
                } else {
                    $equipe = new Equipe();
                    $equipe->concours_id = $this->request->getPost("id");
                    $equipe->data = array();
                    for ($i=1; $i <= $this->request->getPost("tailleEquipe"); $i++) {
                        if (filter_input(INPUT_POST, "joueur".$i, FILTER_VALIDATE_INT)) {
                            $joueurs[] = $this->request->getPost("joueur".$i);
                        } else {
                            $equipe->data[] = $this->request->getPost("joueur".$i);
                        }
                    }
                    if (!$equipe->save()) {
                        foreach ($equipe->getMessages() as $message) {
                            $this->flashSession->error($message);
                            throw new Exception();
                        }
                    } else {
                        foreach ($joueurs as $key) {
                            if (!$this->addJoueur($equipe->id, $key)) {
                                throw new Exception();
                            }
                        }
                        $this->flashSession->success("Équipe ajoutée");
                    }
                }
                $this->db->commit();
            } catch (Exception $e) {
                $this->db->rollback("erreur");
            }

        }
        $this->response->redirect('concours/participants/'.$this->request->getPost("id"));
        $this->view->disable();
        return;
    }


    /**
     * Ajoute à la mêlée
     */
    public function addJoueur($equipeId, $joueurId)
    {
        $joueur = new EquipesJoueurs();
        $joueur->equipe_id = $equipeId;
        $joueur->joueur_id = $joueurId;
        if (!$joueur->save()) {
            foreach ($joueur->getMessages() as $message) {
                $this->flashSession->error($message);
                return false;
            }
        }
        return true;
    }

    /**
     * Supprime une équipe d'une consolante
     *
     */
    public function deleteEquipeAction()
    {
        if ($this->request->isPost()) {
            $equipe = Equipe::findFirst($this->request->getPost("equipe_id"));
            if (!$equipe) {
                $this->flashSession->error("Equipe introuvable");
            } else {
                if (!$equipe->delete()) {
                    foreach ($equipe->getMessages() as $message) {
                        $this->flashSession->error($message);
                    }
                } else {
                    $this->flashSession->success("Équipe supprimée");
                }
            }
            $this->response->redirect('concours/participants/'.$this->request->getPost("id"));
            $this->view->disable();
            return;
        }
    }
}
