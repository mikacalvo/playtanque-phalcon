<?php

class UsersConcours extends \Phalcon\Mvc\Model
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
    public $concours_id;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
			'user_id'     => 'user_id',
			'concours_id' => 'concours_id', 
        );
    }

    public function initialize()
    {
        $this->belongsTo("user_id", "Users", "id");
        $this->belongsTo("concours_id", "Concours", "id");
    }
}
