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

		// RECUPERATION DES DONNNES

		$sites = Sites::all();

		if(isset($_SESSION["user"]))
		{
			$favoris = MapUserSites::Where("id_user","=",$_SESSION["user"])->Where("favorite","=","1")->get();
		}
		
		// AFFICHAGE IMAGE HEADER / MENU 

		echo "

		<div class=\"slider\" style=\"height: 350px; background-image: url('$this->image_dir/wall_1.jpg');\">

				<div class=\"slider-menu\">";
					
						if(isset($_COOKIE["login"]))
						{
							echo "<ul><li>Bonjour, ".$_COOKIE["login"]."</li></ul>";
						}
						else
						{
							echo "<ul>
						
									<li><a href=\"$url_login\">Se connecter</a></li>
									<li><a href=\"$url_register\">S'inscrire</a></li>

							</ul>";
						}

						
				echo "</div>
			
				<div class=\"slider-text\">
				
					<h2>Nombre de projet : 120</h2>

					<p>Enable : 80 </br>
					Disable : 20 
					</p></br>

					<a href=\"#\" class=\"slider-button\">Lorem Ipsum</a>

			</div>

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

			echo "<h3> ---------- FAVORIS --------</h3>";

			if(isset($_SESSION["user"]))
			{
				foreach ($favoris as $key => $favori) {

				  // RECUPERATION DU SITE

				  $site = Sites::Where("id","=",$favori->id)->first();

				  echo "<div class=\"result-container\">";

				  echo "<h3>".$site->name." - <a href=\"http://$site->url_dev\">http://$site->url_dev</a> </h3></br>";

				  echo "URL DEV : <a href=\"http://$site->url_prod\">http://$site->url_prod</a></br>";

				  echo "VIEWS : $site->views";

				  echo "<div class=\"result-favorite\"><a href=\"index.php/favorite/$site->id\" class=\"result-favorite-link\"><i class=\"fa fa-star\"></i></a></div></div>";

			  	  echo "</div>";

				}
			}

			echo "<h3> ---------- SITES --------</h3>";

			foreach ($sites as $key => $site) {

				  echo "<div class=\"result-container\">";

				  echo "<h3>".$site->name." - <a href=\"http://$site->url_dev\">http://$site->url_dev</a> </h3></br>";

				  echo "URL DEV : <a href=\"http://$site->url_prod\">http://$site->url_prod</a></br>";

				  echo "VIEWS : $site->views";

				  if(isset($_SESSION["user"]))
				  {	
				  		// SI FAVORI

				  		$is_fav = MapUserSites::Where("id_user","=",$_SESSION["user"])->Where("id_site","=",$site->id)->Where("favorite","=","1")->count();



				  		echo "<div class=\"result-favorite\"><a href=\"index.php/favorite/$site->id\" class=\"result-favorite-link\">";if($is_fav==1){echo "<i class=\"fa fa-star\"></i>";}else{echo "<i class=\"fa fa-star-o\"></i>";}echo"</a></div></div>";

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