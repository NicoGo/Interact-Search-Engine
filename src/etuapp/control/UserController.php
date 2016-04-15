<?php

namespace etuapp\control;

use etuapp\models\User;
use etuapp\models\Sites;
use etuapp\vue\VueUser;

class UserController
{

	public function pageLogin()
	{
		$vue = new VueUser();
		$vue->render(1);
	}

	public function pageRegister()
	{
		$vue = new VueUser();
		$vue->render(2);
	}

	public function registerUser()
	{
		$erreur = false;
		$message = "";
		if(isset($_POST))
		{
			if(!empty($_POST["login"]))
			{
				// SI LE LOGIN N'EXISTE PAS

				$count = User::Where("login","=",$_POST["login"])->count();

				if($count==0)
				{ 
					if(!empty($_POST["pass"]))
					{
						// CRYPTAGE DU MDP 
						$_POST["pass"] = crypt($_POST["pass"],CRYPT_BLOWFISH);

						// SAVE BDD
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
					$message = "Login existant";
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
		echo $message;
	}

	public function logUser()
	{
		$erreur = false;
		$message = "";
		if(isset($_POST))
		{
			// CRYPTAGE MDP

			$pass = crypt($_POST["pass"],CRYPT_BLOWFISH);

			$count = User::Where("login","=",$_POST["login"])->Where("pass","=",$pass)->count();

			if($count==1)
			{
				// LOGIN ET CREATION DU COOKIE 
				setcookie("login",$_POST["login"],time() + (10 * 365 * 24 * 60 * 60));
				setcookie("pass",$pass,time() + (10 * 365 * 24 * 60 * 60));

			}
			else
			{
				$erreur = true;
				$message = "La connexion a été échouée";
			}

		}
		else
		{
			$erreur = true;
			$message = "Formulaire inexistant/vide";
		}
		echo $message;
	}
}

?>