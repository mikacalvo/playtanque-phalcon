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
			'id'      => 'id', 
			'label'   => 'label', 
			'date'    => 'date', 
			'options' => 'options'
        );
    }

    public function initialize()
    {
        $this->hasMany("id", "UsersConcours", "concours_id");
        $this->hasMany("id", "ConcoursJoueurs", "concours_id");
    }
    
    public function afterCreate()
    {
    	$userConcours  = new UsersConcours ();
		$userConcours->user_id = $this->getDI()->getSession()->get('auth')['id'];
		$userConcours->concours_id = $this->id;
		if (!$userConcours->save()) {
	        return $this->getDI()->getFlashSession()->error(implode(', ', $userConcours->getMessages()));
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
}
