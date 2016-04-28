<?php

namespace etuapp\control;

use etuapp\models\User;
use etuapp\models\Sites;
use etuapp\models\MapUserSites;
use etuapp\vue\VueUser;

class SitesController
{
	/**
	* Mets/Enleve un site des favoris
	* @param   $id id du site 
	*/
	public function toFavorite($id)
	{
		if(isset($_SESSION["user"])) {
			// SI LA LIAISON EXISTE DEJA

			$mus = new MapUserSites();
			$exist = $mus->linkExist($id);
			if($exist==1) {

				$mus = new MapUserSites();
				$mus = $mus->firstLink($id);
				// UPDATE 
				if($mus->favorite==1) {
					$mus->favorite = 0;
				}
				else {
					$mus->favorite = 1;
				}
				// SAVE
				$mus->save();

			}
			else {

				$mus = new MapUserSites();
				// SET DES DONNEES
				$mus->id_user = $_SESSION["user"];
				$mus->id_site = $id;
				$mus->views = 0;
				$mus->favorite = 1;
				//SAVE 
				$mus->save();

			}
		}
	}

	/**
	* Increment les champs views/views_all 
	* @param  $id id du site 
	*/
	public function toInc($id)
	{
		if(isset($_SESSION["user"])) {
			// SI LA LIAISON EXISTE DEJA

			$mus = new MapUserSites();
			$exist = $mus->linkExist($id);
			if($exist==1) {

				$mus = new MapUserSites();
				$mus = $mus->firstLink($id);

				$site = new Sites();
				$site = $site->find($id);

				$mus->views++;
				$site->views_all++;

				// SAVE
				$mus->save();
				$site->save();

			}
			else
			{

				$mus = new MapUserSites();
				// SET DES DONNEES
				$mus->id_user = $_SESSION["user"];
				$mus->id_site = $id;
				$mus->views = 1;
				$mus->favorite = 0;
				//SAVE 
				$mus->save();

			}
		}
	}

	/**
	* Fait une recherche sur les sites dans la base de données. Affiche les données en JSON.
	* @param   $keyword mots clés
	*/
	public function search($keyword)
	{
		if(strlen($keyword)>1) {
			$sites = new Sites();		
			echo json_encode($sites->search($keyword));
		}
		else {
			$sites = new Sites();
			echo json_encode($sites->findJoinAll());
		}
	}

	/**
	* Affiche les serveurs répertoriés en BDD en JSON.
	*/
	public function servers()
	{
		$sites = new Sites();

		echo json_encode($sites->findAllServers());
	}

	/**
	* Ajoute un site dans la base de données
	*/
	public function addSite()
	{
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		if(isset($_SESSION["user"])) {
			if(isset($_POST)) {
				$site = new Sites();

				$site->name = $request->name;
				$site->server_name = $request->server_name;
				$site->url_dev = $request->url_dev;
				$site->url_prod = $request->url_prod;

				$site->save();

				$users = new User();
				$user = $user->findAll();
				foreach ($users as $key => $user) {
					$mus = new MapUserSites();
					$mus->id_user = $user->id;
					$mus->id_site = $site->id;
					$mus->save();
				}
			}
		}
	}

}

?>