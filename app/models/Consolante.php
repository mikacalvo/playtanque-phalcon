<?php

class Consolante extends \Phalcon\Mvc\Model
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
    public $joueur1;

    /**
     *
     * @var integer
     */
    public $joueur2;

    /**
     *
     * @var integer
     */
    public $joueur3;

    /**
     *
     * @var integer
     */
    public $concours_id;

    /**
     *
     * @var string
     */
    public $joueurs_tmp;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'equipe_id'   => 'equipe_id',
            'joueur1'     => 'joueur1',
            'joueur2'     => 'joueur2',
            'joueur3'     => 'joueur3',
            'concours_id' => 'concours_id',
            'joueurs_tmp' => 'joueurs_tmp',
        );
    }

    public function initialize()
    {
        $this->belongsTo("concours_id", "Concours", "id");
        $this->belongsTo("joueur1", "Joueur", "id");
        $this->belongsTo("joueur2", "Joueur", "id");
        $this->belongsTo("joueur3", "Joueur", "id");
    }

    public function beforeSave()
    {
        //Convert the array into a string
        $this->joueurs_tmp = json_encode($this->joueurs_tmp);
    }

    public function afterFetch()
    {
        //Convert the string to an array
        $this->joueurs_tmp = json_decode($this->joueurs_tmp);
    }
}
