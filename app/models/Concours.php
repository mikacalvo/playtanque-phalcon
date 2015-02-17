<?php

class Concours extends \Phalcon\Mvc\Model
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
     * @var string
     */
    public $date;

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
            'label' => 'label', 
            'date' => 'date', 
            'options' => 'options'
        );
    }

    public function initialize()
    {
        $this->hasMany("id", "ConcoursJoueurs", "concours_id");
    }
}
