<?php

class Equipe extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $concours_id;

    /**
     *
     * @var string
     */
    public $data;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id'          => 'id',
            'concours_id' => 'concours_id',
            'data'        => 'data'
        );
    }

    public function initialize()
    {
        $this->hasMany("id", "EquipesJoueurs", "equipe_id");
        $this->belongsTo("concours_id", "Concours", "id");
    }

    public function beforeSave()
    {
        //Convert the array into a string
        $this->data = empty($this->data) ? null : json_encode($this->data);
    }

    public function afterFetch()
    {
        //Convert the string to an array
        $this->data = json_decode($this->data);
    }

}
