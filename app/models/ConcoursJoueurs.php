<?php

class ConcoursJoueurs extends \Phalcon\Mvc\Model
{
    /**
     *
     * @var integer
     */
    public $concours_id;

    /**
     *
     * @var integer
     */
    public $joueur_id;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'concours_id' => 'concours_id', 
            'joueur_id' => 'joueur_id'
        );
    }

    public function initialize()
    {
        $this->belongsTo("joueur_id", "Joueur", "id");
        $this->belongsTo("concours_id", "Concours", "id");
    }
}
