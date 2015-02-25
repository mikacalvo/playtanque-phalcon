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
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'nom' => 'nom', 
            'poste' => 'poste'
        );
    }

    public function initialize()
    {
        $this->hasMany("id", "ConcoursJoueurs", "joueur_id");
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
}
