<?php

namespace etuapp\vue;

use etuapp\models\Sites;

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

				<link rel=\"stylesheet\" type=\"text/css\" href=\"$css\" media=\"screen\" />
				<link href='https://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' type='text/css'>
				<link rel=\"stylesheet\" href=\"$fontawesome\">

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

		// AFFICHAGE IMAGE HEADER / MENU 

		echo "

		<div class=\"slider\" style=\"height: 350px; background-image: url('$this->image_dir/wall_1.jpg');\">

				<div class=\"slider-menu\">
					
					<ul>
						
						<li><a href=\"$url_login\">Se connecter</a></li>
						<li><a href=\"$url_register\">S'inscrire</a></li>

					</ul>

				</div>
			
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

			foreach ($sites as $key => $site) {

				  echo "<div class=\"result-container\">";

				  echo "<h3>".$site->name." - <a href=\"http://$site->url_dev\">http://$site->url_dev</a> </h3></br>";

				  echo "URL DEV : <a href=\"http://$site->url_prod\">http://$site->url_prod</a></br>";

				  echo "VIEWS : $site->views";

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