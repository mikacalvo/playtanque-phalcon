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
    public $label;

    /**
     *
     * @var integer
     */
    public $poste;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'label' => 'label', 
            'poste' => 'poste'
        );
    }

    public function initialize()
    {
        $this->hasMany("id", "ConcoursJoueurs", "joueur_id");
    }
}
