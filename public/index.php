<?php

session_start();

// AUTOLOAD ET DB

require("../vendor/autoload.php");

// --------------------- SCRIPT COOKIE -------------------------- 

$_SESSION["user"] = 3;

$c = new etuapp\control\SitesController();
$result = $c->search("prisma");

echo $result;