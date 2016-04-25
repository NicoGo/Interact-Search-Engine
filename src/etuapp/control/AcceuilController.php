<?php

namespace etuapp\control;

use etuapp\models\Sites;
use etuapp\models\MapUserSites;
use etuapp\vue\VueAcceuil;

class AcceuilController
{

	public function pageAcceuil()
	{
		$vue = new VueAcceuil();
		$vue->render(1);
	}

	public function search($keyword)
	{

		if(strlen($keyword)>1)
		{
			$sites = Sites::Where("url_dev","like","%$keyword%")->orWhere("server_name","like","%$keyword%")->join('map_user_sites', 'sites.id', '=', 'map_user_sites.id_site')->orderBy("favorite","DESC")->orderBy("views","DESC")->get(['map_user_sites.id AS mus_id', 'sites.*','map_user_sites.*']);
			
			$json = $sites->toJson();

			echo $json;
		}
		else
		{
			$sites = Sites::join('map_user_sites', 'sites.id', '=', 'map_user_sites.id_site')->orderBy("favorite","DESC")->orderBy("views","DESC")->get(['map_user_sites.id AS mus_id', 'sites.*','map_user_sites.*']);

			$json = $sites->toJson();

			echo $json;
			
		}
	
	}

	public function servers()
	{
		$sites = Sites::Select("server_name")->distinct()->get();

		$json = $sites->toJson();

		echo $json;
	}
}

?>