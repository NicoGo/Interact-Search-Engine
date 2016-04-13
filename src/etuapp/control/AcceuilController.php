<?php

namespace etuapp\control;

use etuapp\models\CMS;
use etuapp\models\Contact;
use etuapp\vue\VueAcceuil;

class AcceuilController extends AbstractController
{

	public function pageAcceuil()
	{
		
		$vue = new VueAcceuil(1);
		$vue->render(1);

	}

}

?>