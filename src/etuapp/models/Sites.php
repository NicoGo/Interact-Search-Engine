<?php 

namespace etuapp\models;

class Sites extends Model
{

	/**
	* Initialise le modèle
	*/
	public function __construct()
	{
		$this->table = "sites";
		$this->fields = array('id','name', 'server_name','url_dev','url_prod','views_all');
		parent::__construct();
	}

	/**
	* Permet de faire une recherche sur les Sites 
	* @param $keywords - mots clés pour la recherche
	* @return un tableau d'instances Sites
	*/
	public function search($keywords)
	{
		return $this->query("SELECT *,map_user_sites.id AS mus_id FROM ".$this->table." 
			LEFT JOIN map_user_sites ON ".$this->table.".id=map_user_sites.id_site 
			WHERE url_dev LIKE '%".$keywords."%' OR server_name LIKE '%".$keywords."%' 
			ORDER BY favorite,views DESC;");
	}

	/**
	* Retourne tous les sites
	* @return un tableau d'instances Sites
	*/
	public function findJoinAll()
	{
		return $this->query("SELECT *,map_user_sites.id AS mus_id FROM ".$this->table." 
			LEFT JOIN map_user_sites ON ".$this->table.".id=map_user_sites.id_site 
			ORDER BY favorite DESC,views_all DESC;");
	}

	/**
	* Permet de lister les serveurs différents présents dans la BDD
	* @param un tableau avec les différents serveurs
	*/
	public function findAllServers()
	{
		return $this->query("SELECT DISTINCT server_name FROM ".$this->table);
	}
	
}