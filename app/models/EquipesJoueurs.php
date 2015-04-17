<?php

class EquipesJoueurs extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $equipe_id;

    /**
     *
     * @var integer
     */
    public $joueur_id;

    /**
     *
     * @var string
     */
    public $poste;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'equipe_id' => 'equipe_id',
            'joueur_id' => 'joueur_id',
            'poste'     => 'poste',
        );
    }

    public function initialize()
    {
        $this->belongsTo("equipe_id", "Equipe", "id");
        $this->belongsTo("joueur_id", "Joueur", "id");
    }

}
