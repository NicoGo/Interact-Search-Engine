<?php

namespace etuapp\control;

use etuapp\models\Sites;
use etuapp\vue\VueUser;

class UserController
{

	public function pageRegister()
	{
		$vue = new VueUser();
		$vue->render(2);
	}

	public function logUser()
	{
		$erreur = false;
		$message = "";
		if(isset($_POST))
		{
			if(!empty($_POST["login"]))
			{
				if(!empty($_POST["pass"]))
				{
					$user = new User($_POST);
					$user->save();
				}
				else
				{
					$erreur = true;
					$message = "Pas de mdp";
				}
			}
			else
			{
				$erreur = true;
				$message = "Pas de login";
			}
		}
		else
		{
			$erreur = true;
			$message = "Formulaire inexistant/vide";
		}

	

	}

}

?>