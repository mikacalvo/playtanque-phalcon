<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class ConcoursController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for concours
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Concours", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $concours = Concours::find($parameters);
        if (count($concours) == 0) {
            $this->flash->notice("The search did not find any concours");

            return $this->dispatcher->forward(array(
                "controller" => "concours",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $concours,
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
     * Edits a concour
     *
     * @param string $id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $concour = Concours::findFirstByid($id);
            if (!$concour) {
                $this->flash->error("concour was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "concours",
                    "action" => "index"
                ));
            }

            $this->view->id = $concour->id;

            $this->tag->setDefault("id", $concour->id);
            $this->tag->setDefault("label", $concour->label);
            $this->tag->setDefault("date", $concour->date);
            $this->tag->setDefault("options", $concour->options);
            
        }
    }

    /**
     * Creates a new concour
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "concours",
                "action" => "index"
            ));
        }

        $concour = new Concours();

        $concour->label = $this->request->getPost("label");
        $concour->date = $this->request->getPost("date");
        $concour->options = $this->request->getPost("options");
        

        if (!$concour->save()) {
            foreach ($concour->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "concours",
                "action" => "new"
            ));
        }

        $this->flash->success("concour was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "concours",
            "action" => "index"
        ));

    }

    /**
     * Saves a concour edited
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

        $concour = Concours::findFirstByid($id);
        if (!$concour) {
            $this->flash->error("concour does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "concours",
                "action" => "index"
            ));
        }

        $concour->label = $this->request->getPost("label");
        $concour->date = $this->request->getPost("date");
        $concour->options = $this->request->getPost("options");
        

        if (!$concour->save()) {

            foreach ($concour->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "concours",
                "action" => "edit",
                "params" => array($concour->id)
            ));
        }

        $this->flash->success("concour was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "concours",
            "action" => "index"
        ));

    }

    /**
     * Deletes a concour
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $concour = Concours::findFirstByid($id);
        if (!$concour) {
            $this->flash->error("concour was not found");

            return $this->dispatcher->forward(array(
                "controller" => "concours",
                "action" => "index"
            ));
        }

        if (!$concour->delete()) {

            foreach ($concour->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "concours",
                "action" => "search"
            ));
        }

        $this->flash->success("concour was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "concours",
            "action" => "index"
        ));
    }

}
