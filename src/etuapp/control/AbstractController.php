<?php 

namespace etuapp\control;

use etuapp\utils\HttpRequest;

abstract class AbstractController
{

	private $http; 

	function __construct(HttpRequest $http=null)
	{
		$this->http = $http;
	}
}

?>