<?php

namespace etuapp\control;

use etuapp\models\CMS;
use etuapp\models\Membre;
use etuapp\vue\VueAdmin;

class AdminController extends AbstractController
{

	public function pageAcceuil()
	{
		$vue = new VueAdmin();
		$vue->render(1);
	}

}

?>

