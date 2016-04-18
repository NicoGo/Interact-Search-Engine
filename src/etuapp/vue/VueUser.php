<?php

namespace etuapp\vue;

use etuapp\models\Sites;
use etuapp\models\User;

class VueUser
{

	const AFFICHER_LOGIN = 1;
	const AFFICHER_REGISTER = 2;
	const AFFICHER_ADD_SITE = 3;

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
			case self::AFFICHER_LOGIN:
				$this->afficherLogin();
				break;
			case self::AFFICHER_REGISTER:
				$this->afficherRegister();
				break;
			case self::AFFICHER_ADD_SITE:
				$this->afficherAddSite();
				break;

		}
	}

	private function afficherLogin()
	{

		$this->afficherHeader();

		echo "<div class=\"register_container\">

		<form method=\"post\" action=\"\">

			<label for=\"login\">Login :</label>

			<input type=\"text\" id=\"login\" name=\"login\">

			<label for=\"password\">Mot de passe :</label>

			<input type=\"password\"  id=\"password\" name=\"pass\">

			<input type=\"submit\">

		</form>";
	}

	private function afficherRegister()
	{
		$this->afficherHeader();

		echo "<div class=\"register_container\">

		<form method=\"post\" action=\"\">

			<label for=\"login\">Login :</label>

			<input type=\"text\" id=\"login\" name=\"login\">

			<label for=\"password\">Mot de passe :</label>

			<input type=\"password\"  id=\"password\" name=\"pass\">

			<input type=\"submit\">

		</form>";

	}	

	private function afficherAddSite()
	{
		$this->afficherHeader();

		echo "<div class=\"register_container\">

		<form method=\"post\" action=\"\">

			<label for=\"name\">Nom :</label>

			<input type=\"text\" id=\"name\" name=\"name\">

			<label for=\"server_name\">Nom du serveur :</label>

			<input type=\"text\" id=\"server_name\" name=\"server_name\">

			<label for=\"url_dev\">URL dev :</label>

			<input type=\"text\" id=\"url_dev\" name=\"url_dev\">

			<label for=\"url_prod\">URL Prod :</label>

			<input type=\"text\" id=\"url_prod\" name=\"url_prod\">

			<input type=\"submit\">

		</form>";
	}

	private function afficherHeader()
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

	}

	
}

?>