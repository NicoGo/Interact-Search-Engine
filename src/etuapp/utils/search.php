<?php 

namespace etuapp\utils;

use etuapp\models\Sites;

$test = new Search($_POST);

class Search
{

	function __construct($array)
	{
			$keyword = $_POST["keyword"];

	if(!empty($keyword))
	{

		$sites = Sites::Where("url","like","%$keyword%")->get();

		foreach ($variable as $key => $value) {
		
		
				
		
		    	echo "<div class=\"result-container\">";

				  echo "<h3>".$titre."</h3>";

				  echo "<a class=\"livepreview\" href=\"$url\">$url</a>";

			  echo "</div>";
		



		}

	}
	else
	{
		$sites = Sites::all();

		
				
		
		    	echo "<div class=\"result-container\">";

				  echo "<h3>".$titre."</h3>";

				  echo "<a class=\"livepreview\" href=\"$url\">$url</a>";

			  echo "</div>";
			
		
	

	}
	}


}

?>