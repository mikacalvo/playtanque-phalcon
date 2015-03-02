<?php

class UsersJoueurs extends \Phalcon\Mvc\Model
{
    /**
     *
     * @var integer
     */
    public $user_id;

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
            'user_id'   => 'user_id',
            'joueur_id' => 'joueur_id',
        );
    }

    public function initialize()
    {
        $this->belongsTo("user_id", "Users", "id");
        $this->belongsTo("joueur_id", "Joueur", "id");
    }
}
