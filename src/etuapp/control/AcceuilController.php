<?php

namespace etuapp\control;

use etuapp\models\Sites;
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
		if($keyword!="")
		{
			$sites = Sites::Where("url_dev","like","%$keyword%")->get();
			
			echo "<div class=\"all-results\">";
					
			    	foreach ($sites as $key => $site) {

				  echo "<div class=\"result-container\">";

				  echo "<h3>".$site->name." - <a href=\"http://$site->url_dev\">http://$site->url_dev</a> </h3></br>";

				  echo "URL DEV : <a href=\"http://$site->url_prod\">http://$site->url_prod</a></br>";

				  echo "VIEWS : $site->views";

			  	  echo "</div>";
			}
			
			echo "</div>";
		}
		else
		{
			$sites = Sites::all();

			echo "<div class=\"all-results\">";
					
			    	foreach ($sites as $key => $site) {

				  echo "<div class=\"result-container\">";

				  echo "<h3>".$site->name." - <a href=\"http://$site->url_dev\">http://$site->url_dev</a> </h3></br>";

				  echo "URL DEV : <a href=\"http://$site->url_prod\">http://$site->url_prod</a></br>";

				  echo "VIEWS : $site->views";

			  	  echo "</div>";
			}
			
			echo "</div>";

		}
	
	}
}

?>