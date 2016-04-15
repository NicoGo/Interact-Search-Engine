<?php

ob_start();

session_start();

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// AUTOLOAD ET DB

require("vendor/autoload.php");
use Illuminate\Database\Capsule\Manager as DB;
$db = new DB();
$conf = parse_ini_file("src/conf/config.ini");
$db->addConnection($conf);
$db->setAsGlobal();
$db->bootEloquent();

$app = new \Slim\Slim();

$app->get('', function () {
 	
	$c = new etuapp\control\AcceuilController();
	$c->pageAcceuil();

});

$app->get('/', function () {
 	
	$c = new etuapp\control\AcceuilController();
	$c->pageAcceuil();

});

$app->get('/login', function () {
 	
	$c = new etuapp\control\AcceuilController();
	$c->pageAcceuil();

});

$app->get('/register', function () {
	$c = new etuapp\control\UserController();
	$c->pageRegister();
});

$app->post('/register', function () {
	$c = new etuapp\control\UserController();
	$c->logUser();
});

$app->get('/search/:keyword', function ($keyword) {
	$c = new etuapp\control\AcceuilController();
	$c->search($keyword);
});

$app->get('/search', function () {
	$c = new etuapp\control\AcceuilController();
	$c->search("");
});

$app->post('/admin/membre', function () {
 	
	$c = new etuapp\control\AdminController();
	$c->creerMembre($_POST);

});

$app->run();

ob_end_flush();

?>