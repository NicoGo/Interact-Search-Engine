<?php 

namespace etuapp\models;

class User extends Model
{

	/**
	* Initialise le modèle
	*/
	public function __construct()
	{
		$this->table = "sites";
		$this->fields = array('id','login', 'pass');
		parent::__construct();
	}

}