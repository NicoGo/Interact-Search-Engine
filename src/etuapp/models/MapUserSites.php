<?php 

namespace etuapp\models;

class MapUserSites extends Model
{

	/**
	* Initialise le modèle
	*/
	public function __construct()
	{
		$this->table = "map_user_sites";
		$this->fields = array('id','id_user', 'id_site','views','favorite');
		parent::__construct();
	}
	
	/**
	* Renvoie si la liasion site / utilisateur est créee
	* @param $id - id du site
	*/
	public function linkExist($id)
	{
		$count = $this->count("SELECT COUNT(id) FROM ".$this->table." 
			WHERE id_site=".$id." AND id_user=".$_SESSION["user"],null,true);
		if($count==1) {
			return true;
		}
		else {
			return false;
		}
	}

	/**
	* Renvoie la liaison site / utilisateur
	* @param $id_site - id du site
	*/
	public function firstLink($id)
	{
		return $this->query("SELECT * FROM ".$this->table." 
			WHERE id_site=".$id." AND id_user=".$_SESSION["user"],null,true);
	}
	
}