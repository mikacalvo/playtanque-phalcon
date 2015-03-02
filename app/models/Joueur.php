<?php

class Joueur extends \Phalcon\Mvc\Model
{
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $nom;

    /**
     *
     * @var string
     */
    public $options;


    /**
     *
     * @var string
     */
    protected $postes;


    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id'      => 'id',
            'nom'     => 'nom',
            'options' => 'options'
        );
    }

    public function initialize()
    {
        $this->hasMany("id", "ConcoursJoueurs", "joueur_id");
        $this->postes = array(
            0 => '',
            1 => 'pointeur',
            2 => 'milieu',
            3 => 'tireur',
        );
    }

    public function afterCreate()
    {
        $userJoueurs  = new UsersJoueurs ();
        $userJoueurs->user_id = $this->getDI()->getSession()->get('auth')['id'];
        $userJoueurs->joueur_id = $this->id;
        if (!$userJoueurs->save()) {
            foreach ($userJoueurs->getMessages() as $message) {
                $this->getDI()->getFlashSession()->error($message);
            }
            return false;
        }
        return true;
    }

    public function beforeSave()
    {
        //Convert the array into a string
        $this->options = json_encode($this->options);
    }

    public function afterFetch()
    {
        //Convert the string to an array
        $this->options = json_decode($this->options);
    }

    public function getPoste()
    {
        return $this->postes[$this->options->poste];
    }
}
