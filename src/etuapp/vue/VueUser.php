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

	

	
}

?>