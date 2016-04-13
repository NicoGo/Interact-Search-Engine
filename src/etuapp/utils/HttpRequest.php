<?php

namespace etuapp\utils;

class HttpRequest
{

	private $method; 
	private $script_name;
	private $path_info;
	private $query; 
	private $get;
	private $post;

	function __construct()
	{
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->script_name = $_SERVER['SCRIPT_NAME'];
		if(isset($_SERVER['PATH_INFO']))
		{
			$this->path_info = $_SERVER['PATH_INFO'];
		}
		$this->query = $_SERVER['QUERY_STRING'];
		$this->get = $_GET;
		$this->post = $_POST;
	}

	function __get($nom)
	{
			 if ( property_exists ($this, $nom) ) {
 			return $this->nom; 
		}
 		else throw new Exception ("$type : invalid property") ;
		
	}

	function __set($nom,$val)
	{
		if ( property_exists ($this, $nom) ) {
		 $this->nom = $val ;
		 return $this->nom ;
  		}
		 else throw new Exception ("$type : invalid property") ;
	}
	
}

?>