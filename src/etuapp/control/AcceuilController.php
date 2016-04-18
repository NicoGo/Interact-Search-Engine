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

			$sites = Sites::Where("url_dev","like","%$keyword%")->get();
					
			    	foreach ($sites as $key => $site) {

				  echo "<div class=\"result-container\" id=\"result-container-$site->id\">";

				  echo "<h3>".$site->name." - <a href=\"http://$site->url_dev\" target=\"_blank\">http://$site->url_dev</a> </h3></br>";

				  echo "URL DEV : <a href=\"http://$site->url_prod\" target=\"_blank\">http://$site->url_prod</a></br>";

				  echo "VIEWS : $site->views_all";

				  if(isset($_SESSION["user"]))
				  {	
				  		// SI FAVORI

				  		$is_fav = MapUserSites::Where("id_user","=",$_SESSION["user"])->Where("id_site","=",$site->id)->Where("favorite","=","1")->count();

				  		echo "<div class=\"result-favorite\"><a href=\"index.php/favorite/$site->id\" class=\"result-favorite-link\">";if($is_fav==1){echo "<i class=\"fa fa-star\"></i>";}else{echo "<i class=\"fa fa-star-o\"></i>";}echo"</a></div>";

				  }

			  	  echo "</div>";
			}
			

		}
		else
		{
			$sites = Sites::all();

			$sites = Sites::join('map_user_sites', 'sites.id', '=', 'map_user_sites.id_site')->orderBy("views","DESC")->get(['map_user_sites.id AS mus_id', 'sites.*']);
	
			    foreach ($sites as $key => $site) {

				  echo "<div class=\"result-container\" id=\"result-container-$site->id\">";

				  echo "<h3>".$site->name." - <a href=\"http://$site->url_dev\" target=\"_blank\">http://$site->url_dev</a> </h3></br>";

				  echo "URL DEV : <a href=\"http://$site->url_prod\" target=\"_blank\">http://$site->url_prod</a></br>";

				  echo "VIEWS : $site->views_all";

				  if(isset($_SESSION["user"]))
				  {	
				  		// SI FAVORI

				  		$is_fav = MapUserSites::Where("id_user","=",$_SESSION["user"])->Where("id_site","=",$site->id)->Where("favorite","=","1")->count();

				  		echo "<div class=\"result-favorite\"><a href=\"index.php/favorite/$site->id\" class=\"result-favorite-link\">";if($is_fav==1){echo "<i class=\"fa fa-star\"></i>";}else{echo "<i class=\"fa fa-star-o\"></i>";}echo"</a></div>";

				  }

			  	  echo "</div>";
			}
			


		}
	
	}
}

?>