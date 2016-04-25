<?php

namespace etuapp\control;

use etuapp\models\User;
use etuapp\models\Sites;
use etuapp\models\MapUserSites;
use etuapp\vue\VueUser;

class SitesController
{

	public function toFavorite($id)
	{
		if(isset($_SESSION["user"]))
		{
			// SI LA LIAISON EXISTE DEJA

			$count = MapUserSites::Where("id_site","=",$id)->Where("id_user","=",$_SESSION["user"])->count();
			if($count==1)
			{

				$mus = MapUserSites::Where("id_site","=",$id)->Where("id_user","=",$_SESSION["user"])->first();
				// UPDATE 
				if($mus->favorite==1)
				{
					$mus->favorite = 0;
				}
				else
				{
					$mus->favorite = 1;
				}
				// SAVE
				$mus->save();
			}
			else
			{
				$mus = new MapUserSites();
				// SET DES DONNEES
				$mus->id_user = $_SESSION["user"];
				$mus->id_site = $id;
				$mus->favorite = 1;
				//SAVE 
				$mus->save();
			}
		}
	}

	public function toInc($id)
	{
		if(isset($_SESSION["user"]))
		{
			// SI LA LIAISON EXISTE DEJA

			$count = MapUserSites::Where("id_site","=",$id)->Where("id_user","=",$_SESSION["user"])->count();
			if($count==1)
			{
				$mus = MapUserSites::Where("id_site","=",$id)->Where("id_user","=",$_SESSION["user"])->first();
				$site = Sites::find($id);
				$site->increment("views_all");
				// UPDATE 
				$mus->increment('views');

				// SAVE
				$mus->save();
			}
			else
			{
				$mus = new MapUserSites();
				// SET DES DONNEES
				$mus->id_user = $_SESSION["user"];
				$mus->id_site = $id;
				$mus->views = 1;
				//SAVE 
				$mus->save();
			}
		}
	}

	public function addSite()
	{
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		var_dump($request->name);
		if(isset($_SESSION["user"]))
		{
			if(isset($_POST))
			{
				$site = new Sites();

				$site->name = $request->name;
				$site->server_name = $request->server_name;
				$site->url_dev = $request->url_dev;
				$site->url_prod = $request->url_prod;

				$site->save();

				$users = User::all();
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