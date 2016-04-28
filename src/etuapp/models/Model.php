<?php 

namespace etuapp\models;

use etuapp\utils\Database as Database; 

class Model
{
	/**
	* Nom de la table
	*/
	protected $table;
	/**
	* Objet database
	*/
	protected $db;
	/**
	* Champs de la base de données
	*/
	protected $fields;

	/**
	* Initialise le modèle parent -> database et attributs
	*/
	public function __construct()
	{
		$this->db = Database::getInstance();

		foreach ($this->fields as $value) {
			if(!isset($this->$value))
				$this->$value = null;
		}
	}

	/**
	* Permet de faire une requete prepare / query en fonction des arguments
	* @param $statement - requete SQL
	* @param $attributes - tableau de valeurs en cas de requete préparée
	* @param $one - si true -> renvoie classe sinon tableau de classe
	* @return une classe ou un tableau de classe
	*/
	public function query($statement,$attributes=null,$one = false)
	{
		if($attributes) {
			return $this->db->prepare($statement,$attributes,get_class($this),$one);
		}
		else {
			return $this->db->query($statement,get_class($this),$one);
		}
	}

	/**
	* Permet de trouver un element dans le modèle
	* @param $id - id de la ligne dans la BDD
	* @return l'instance du modele correspondant
	*/
	public function find($id)
	{
		return $this->query("SELECT * FROM ".$this->table." WHERE id=?",[$id],true);
	}

	/**
	* Permet de trouver tous les éléments du modèle fils
	* @return un tableau d'instances du modele correspondant
	*/
	public function findAll()
	{
		return $this->query("SELECT * FROM ".$this->table);
	}

	/**
	* Permet de faire une requete type COUNT
	* @param $statement - requete SQL
	* @return le compte des lignes correspondantes
	*/
	public function count($statement)
	{
		return $this->db->count($statement);
	}

	/**
	* Permet de mettre a jour le modèle
	* @return le resultat de la requete
	*/
	public function update()
	{

		$statement = "UPDATE ".$this->table." SET ";

		$sql = [];

		$attributes = [];

		foreach ($this->fields as $key => $value) {

			$sql[] = "$value = ?";
			$attributes[] = $this->$value;

		}

		$statement .= implode(",", $sql);
		$statement .= " WHERE id=".$this->id;

		return $this->query($statement,$attributes,true);
	}

	/**
	* Permet d'ajouter une ligne BDD sur la table correspondante
	* @return le resultat de la requete
	*/
	public function insert()
	{
		$statement = "INSERT INTO ".$this->table." SET ";

		$sql = [];

		$attributes = [];

		foreach ($this->fields as $key => $value) {

			$sql[] = "$value = ?";
			$attributes[] = $this->$value;

		}

		$statement .= implode(",", $sql);

		$result = $this->query($statement,$attributes,true);

		$this->id = $this->db->lastInsertId();

		return $result;
	}

	/**
	* Insert ou save selon le contexte
	*/
	public function save()
	{
		if(!empty($this->id)) {
			$this->update();
		}
		else {
			$this->insert();
		}
	}

} 