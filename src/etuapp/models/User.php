<?php 

namespace etuapp\models;

class User extends Model
{

	/**
	* Initialise le modèle
	*/
	public function __construct()
	{
		$this->table = "user";
		$this->fields = array('id','login', 'pass');
		parent::__construct();
	}

	public function userExist($login,$password)
	{
		// $count = $this->count("SELECT COUNT(id) FROM ".$this->table." 
			// WHERE login='".$login."'' AND pass='".$password."'",null,true);
		return true;
		if($count==1) {
			return true;
		}
		else {
			return false;
		}
	}

}