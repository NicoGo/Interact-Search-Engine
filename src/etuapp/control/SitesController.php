<?php

namespace etuapp\control;

use etuapp\models\User;
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
					$mus->favorite = 0;
				else
					$mus->favorite = 1;
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

}

?>