<?php

namespace etuapp\vue;

use etuapp\models\Sites;
use etuapp\models\MapUserSites;

class VueAcceuil
{


	const AFFICHERACCEUIL = 1;

	private $image_dir;

	function __construct($page=null)
	{

		$urlindex = $_SERVER["SCRIPT_NAME"]."/";

		$css = $_SERVER["SCRIPT_NAME"]."/../web/css/public.css";

		$fontawesome = $_SERVER["SCRIPT_NAME"]."/../web/css/font-awesome.min.css";

		$this->image_dir = $_SERVER["SCRIPT_NAME"]."/../web/images";

		// JS

		$urljquery = $_SERVER["SCRIPT_NAME"]."/../web/js/jquery.js";
		$urlapp = $_SERVER["SCRIPT_NAME"]."/../web/js/script.js";

		// URL DU MENU

		$urlacceuil = $_SERVER["SCRIPT_NAME"]."/../index.php";
		$urlregister = $_SERVER["SCRIPT_NAME"]."/user/register/";


		echo "<title>Interact Project Manager</title> 

			<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css\">


				<link rel=\"stylesheet\" type=\"text/css\" href=\"$css\" media=\"screen\" />
				<link href='https://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' type='text/css'>
				
				<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />

				<script type=\"text/javascript\" src=\"$urljquery\"></script>
				<script type=\"text/javascript\" src=\"$urlapp\"></script>

				<script src=\"$urljquery\"></script>";
				 
		}

	function render($type)
	{
		switch ($type) {
			case self::AFFICHERACCEUIL:
				$this->afficherAcceuil();
				break;
		}
	}

	private function afficherAcceuil()
	{
		// URLs

		$url_login =  $_SERVER["SCRIPT_NAME"]."/login";
		$url_register =  $_SERVER["SCRIPT_NAME"]."/register";
		$url_creation =  $_SERVER["SCRIPT_NAME"]."/addsite";

		// RECUPERATION DES DONNNES

		$sites = Sites::join('map_user_sites', 'sites.id', '=', 'map_user_sites.id_site')->orderBy("views","DESC")->get(['map_user_sites.id AS mus_id', 'sites.*']);

		$nbr_sites = Sites::All()->count();

		if(isset($_SESSION["user"]))
		{
			$favoris = MapUserSites::Where("id_user","=",$_SESSION["user"])->Where("favorite","=","1")->get();
		}
		
		// AFFICHAGE IMAGE HEADER / MENU 

		echo "<div class=\"header\">

			<ul> 

				<li><i class=\"fa fa-server\" aria-hidden=\"true\"></i>&nbsp; $nbr_sites</li>
				<li style=\"color: #2ecc71\"><i class=\"fa fa-circle\" aria-hidden=\"true\"></i>&nbsp; 10</li>
				<li style=\"color: #e74c3c\"><i class=\"fa fa-circle\" aria-hidden=\"true\"></i>&nbsp; 10</li>
				<li><a href=\"$url_creation\"><i class=\"fa fa-plus-circle\" aria-hidden=\"true\"></i></a></li>
				<li><i class=\"fa fa-cogs\" aria-hidden=\"true\"></i></li>";
				if(isset($_COOKIE["login"]))
				{
					echo "<li>".$_COOKIE["login"]."</li>";
				}

			echo "</ul>

		</div>";

		echo "

		<div class=\"slider\" style=\"height: 350px; background-image: url('$this->image_dir/wall_1.jpg');\">

				<div class=\"slider-menu\">";
					
						if(!isset($_COOKIE["login"]))
						{
							echo "<ul>
						
									<li><a href=\"$url_login\">Se connecter</a></li>
									<li><a href=\"$url_register\">S'inscrire</a></li>
							</ul>";
						}

						
				echo "</div>
			
				<div class=\"slider-text\">
				
					<img src=\"$this->image_dir/logo.png\">

					<p>Project Manager </p>
					

				</div>
				
				<div class=\"slider-text\" style=\"border-left: 1px solid white;\"><h2>Favoris</h2>";

					if(isset($_SESSION["user"]))
					{
						foreach ($favoris as $key => $favori) {

						  // RECUPERATION DU SITE

						  $site = Sites::Where("id","=",$favori->id)->first();

						  echo "<h3>".$site->name." - <a href=\"http://$site->url_dev\" target=\"_blank\">http://$site->url_dev</a> </h3>";

						}
					}

				echo "</div>

		</div>";

		// AFFICHAGE COLONNE GAUCHE (PROJET ENABLE)

		echo "
		
		<div class=\"bloc-search\">

			<div class=\"form-group\">

				<input type=\"text\" class=\"in-text search\">

				<div class=\"search-results\">

				</div>

			</div>

		</div>";

		// RESULT BLOC

		echo "<div class=\"all-results\">";

			// echo "<h3 style=\"text-align: center;\"> ---------- FAVORIS ---------- </h3>";

			// if(isset($_SESSION["user"]))
			// {
			//	foreach ($favoris as $key => $favori) {

				  // RECUPERATION DU SITE

			//	  $site = Sites::Where("id","=",$favori->id)->first();
			//
			//	  echo "<div class=\"result-container\" id=\"result-container-$site->id\">";
			//
			//	  echo "<h3>".$site->name." - <a href=\"http://$site->url_dev\" target=\"_blank\">http://$site->url_dev</a> </h3></br>";
			//
			//	  echo "URL DEV : <a href=\"http://$site->url_prod\" target=\"_blank\">http://$site->url_prod</a></br>";
			//
			//	  echo "VIEWS : $site->views";
			//
			//	  echo "<div class=\"result-favorite\"><a href=\"../index.php/favorite/$site->id\" class=\"result-favorite-link\"><i class=\"fa fa-star\"></i></a></div></div>";
			//
			//  	  echo "</div>";

		//		}
	//		}

			echo "<h3 style=\"text-align: center;\"> ---------- SITES ---------- </h3>";

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

		echo "</div>";
		
	}

	public function alert($type,$message)
	{
		switch ($type) {
			case 1;
				echo "<div class=\"alertSuccess\">$message</div>";
				break;
			case 2;
				echo "<div class=\"alertFail\">$message</div>";
				break;
		}
	}


	
}

?>