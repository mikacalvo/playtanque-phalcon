<?php

use Phalcon\Mvc\Model\Validator\Email as Email;
use Phalcon\Mvc\Model\Validator\InclusionIn,
    Phalcon\Mvc\Model\Validator\Uniqueness;

class Users extends \Phalcon\Mvc\Model
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
    public $username;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $date_creation;

    /**
     *
     * @var string
     */
    public $is_actif;

    /**
     *
     * @var string
     */
    public $options;

    /**
     * Validations and business logic
     */
    public function validation()
    {
        $this->validate(
            new Email(
                array(
                    'field'    => 'email',
                    'required' => true,
                )
            )
        );
        $this->validate(new Uniqueness(
            array(
                "field"   => "email",
                "message" => "Un compte avec cette adresse email existe déjà."
            )
        ));
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
			'id'            => 'id',
			'username'      => 'username',
			'password'      => 'password',
			'email'         => 'email',
			'date_creation' => 'date_creation',
			'is_actif'      => 'is_actif',
			'options'       => 'options',
        );
    }

    public function initialize()
    {
        $this->hasMany("id", "UsersConcours", "user_id");
        $this->hasMany("id", "UsersJoueurs", "user_id");
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
