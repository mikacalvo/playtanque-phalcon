<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class JoueurController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for joueur
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Joueur", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $joueur = Joueur::find($parameters);
        if (count($joueur) == 0) {
            $this->flash->notice("The search did not find any joueur");

            return $this->dispatcher->forward(array(
                "controller" => "joueur",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $joueur,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

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
                $this->flash->error("joueur was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "joueur",
                    "action" => "index"
                ));
            }

            $this->view->id = $joueur->id;

            $this->tag->setDefault("id", $joueur->id);
            $this->tag->setDefault("label", $joueur->label);
            $this->tag->setDefault("poste", $joueur->poste);
            
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

        $joueur->label = $this->request->getPost("label");
        $joueur->poste = $this->request->getPost("poste");
        

        if (!$joueur->save()) {
            foreach ($joueur->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "joueur",
                "action" => "new"
            ));
        }

        $this->flash->success("joueur was created successfully");

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
            $this->flash->error("joueur does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "joueur",
                "action" => "index"
            ));
        }

        $joueur->label = $this->request->getPost("label");
        $joueur->poste = $this->request->getPost("poste");
        

        if (!$joueur->save()) {

            foreach ($joueur->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "joueur",
                "action" => "edit",
                "params" => array($joueur->id)
            ));
        }

        $this->flash->success("joueur was updated successfully");

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
            $this->flash->error("joueur was not found");

            return $this->dispatcher->forward(array(
                "controller" => "joueur",
                "action" => "index"
            ));
        }

        if (!$joueur->delete()) {

            foreach ($joueur->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "joueur",
                "action" => "search"
            ));
        }

        $this->flash->success("joueur was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "joueur",
            "action" => "index"
        ));
    }

}
