<?php

namespace etuapp\vue;

use etuapp\models\CMS;
use etuapp\models\Membre;
use etuapp\models\Contact;

class VueAdmin
{

	private $produit;
	const AFFICHERACCEUIL = 1;
	const AFFICHERCONTACT = 2;

	function __construct($produit=null)
	{

		$this->produit = $produit;

		$urlindex = $_SERVER["SCRIPT_NAME"]."/";
		$urlinfos = $_SERVER["SCRIPT_NAME"]."/infos/";

		$css = $_SERVER["SCRIPT_NAME"]."/../web/css/public.css";

		$fontawesome = $_SERVER["SCRIPT_NAME"]."/../web/fontawesome/css/font-awesome.min.css";
		$example = $_SERVER["SCRIPT_NAME"]."/../web/css/example.css";
		$fontcss = $_SERVER["SCRIPT_NAME"]."/../web/css/font-awesome.min.css";

		$urlregister = $_SERVER["SCRIPT_NAME"]."/user/register/";
		$urlslidesjs = $_SERVER["SCRIPT_NAME"]."/../web/js/responsiveslides.min.js";

		$dossierimage = $_SERVER["SCRIPT_NAME"]."/../web/images";

		// JS
		$urlapp = $_SERVER["SCRIPT_NAME"]."/../web/js/app.js";
		$urljquery = $_SERVER["SCRIPT_NAME"]."/../web/js/jquery.js";

		// URL MENU 

		$urlsite = $_SERVER["SCRIPT_NAME"]."/";
		$urlindex = $_SERVER["SCRIPT_NAME"]."/admin";
		$urlcontact = $_SERVER["SCRIPT_NAME"]."/admin/contact";

		echo "
			<title>Orchestre</title> 

			<link rel=\"stylesheet\" type=\"text/css\" href=\"$css\" media=\"screen\" />
			<link href=\"https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300\" rel=\"stylesheet\" type=\"text/css\">
			<link rel=\"stylesheet\" href=\"$fontawesome\">
			<link rel=\"stylesheet\" href=\"$example\">
			<link rel=\"stylesheet\" href=\"$fontcss\">

			<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />

			<script src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js\"></script>

			<script type=\"text/javascript\" src=\"$urljquery\"></script>
			<script type=\"text/javascript\" src=\"$urlapp\"></script>

			 <script src=\"//cdn.tinymce.com/4/tinymce.min.js\"></script>
			 <script>tinymce.init({ selector:'textarea' });</script>
			 
			<div id=\"header2\">
				
				<ul>
					
					<li><a href=\"$urlsite\"><i class=\"fa fa-tablet\"></i> &nbsp Le site</a></li>
					<li><a href=\"$urlindex\"><i class=\"fa fa-edit\"></i> &nbsp Contenu</a></li>
					<li><a href=\"$urlcontact\"><i class=\"fa fa-envelope\"></i> &nbsp Contact</a></li>

				</ul>


			</div>
			      
			";
	}

	function render($type)
	{
		switch ($type) {
			case self::AFFICHERACCEUIL:
				$this->afficherAcceuil();
				break;
			case self::AFFICHERCONTACT:
				$this->afficherContact();
				break;
		}
	
		
	}

	private function afficherAcceuil()
	{

		// URL

	 	$urlformulaire =  $_SERVER["SCRIPT_NAME"]."/admin/cms";
	 	$urlmember =  $_SERVER["SCRIPT_NAME"]."/admin/membre";
	 	$urlsuppression =  $_SERVER["SCRIPT_NAME"]."/admin/delete";

	 	// RECUPERATION DES CONTENUS

	 	$content1 = CMS::Where("nom","=","presentation")->first();
	 	$content2 = CMS::Where("nom","=","videos")->first();

	 	$membres = Membre::all();

	 	// IMG DIR 

	 	$imgdir =  $_SERVER["SCRIPT_NAME"]."/../web/img/";

	 	// CODE

	 	echo "<div id=\"admin-title\">

	 		PRESENTATION 

	 	</div>";

	 	echo "<div id=\"admin-container\">

	 		<form method=\"post\" action=\"$urlformulaire\">

				<input type=\"hidden\" name=\"nom\" value=\"presentation\">

	 			<textarea name=\"contenu\">$content1->contenu</textarea></br>

	 			<input type=\"submit\">

	 		</form>

	 	</div>";

	 	echo "<div id=\"admin-title\">

	 		VIDEOS 

	 	</div>";

	 	echo "<div id=\"admin-container\">

	 		<form method=\"post\" action=\"\">

	 			<input type=\"hidden\" name=\"nom\" value=\"videos\">

	 			<textarea name=\"contenu\">$content2->contenu</textarea></br>

	 			<input type=\"submit\">

	 		</form>

	 	</div>";

	 	echo "<div id=\"admin-title\">

	 		MEMBRES 

	 	</div>";

	 	echo "<div id=\"admin-container\">

	 		<form method=\"post\" enctype=\"multipart/form-data\" action=\"$urlmember\">

				<input type=\"text\" name=\"nom\" placeholder=\"Nom Prenom...\"> 

	 			<input type=\"text\" name=\"fonction\" placeholder=\"Fonction...\"> 

	 			<input type=\"file\" name=\"image\"> (Image carré)

	 			<input type=\"submit\">

	 		</form>";

	 	echo "

	 	<table> 

	 		<tr id=\"theader\">

	 			<td> </td>
	 			<td> Nom </td>
	 			<td> Fonction </td>
	 			<td> Supprimer </td>

	 		</tr>";

	 		foreach ($membres as $key => $value) {	

		 		echo "<tr> 

					<td> <img src=\"$imgdir".$value["image"]."\" style=\"width:40px; width:40px;\"></td>
		 			<td> ".$value["nom"]."</td>
		 			<td>".$value["fonction"]."</td>
		 			<td><a href=".$urlsuppression."/".$value["id"].">Supprimer</a></td>

		 		</tr>";

	 	}


	}

	private function afficherContact()
	{
		// RECUPERATION DES MESSAGES 
		$contact = Contact::orderBy("id","DESC")->get();

		echo "<div id=\"admin-title\">

	 		MESSAGES 

	 	</div>";

		foreach ($contact as $key => $value) {


			echo "<div id=\"contact-msn\">

				De : $value->nom - $value->email </br>

				$value->content

			</div>";
			
		}
	}

	public function alert($type,$message)
	{
		switch ($type) {
			case 1;
				echo "<div id=\"alertSuccess\">$message</div>";
				break;
			case 2;
				echo "<div id=\"alertFail\">$message</div>";
				break;
		}
	
		
	}


	
}

?>

