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

$app->get('/videos/', function () {
 	
	$c = new etuapp\control\AcceuilController();
	$c->pageVideos();

});

$app->get('/calendrier/', function () {
	$c = new etuapp\control\AcceuilController();
	$c->pageCalendrier();
});

$app->get('/contact/', function () {
 	
	$c = new etuapp\control\AcceuilController();
	$c->pageContact();

});

$app->post('/contact/send', function () {
 	
	$c = new etuapp\control\AcceuilController();
	$c->envoyerMessage($_POST);

});

$app->post('/admin/cms', function () {
 	
	$c = new etuapp\control\AdminController();
	$c->creerCMS($_POST);

});

$app->get('/admin', function () {
 	
	$c = new etuapp\control\AdminController();
	$c->pageAcceuil();

});

$app->get('/admin/contact', function () {
 	
	$c = new etuapp\control\AdminController();
	$c->pageContact();

});

$app->get('/admin/delete/:id', function ($id) {
 	
	$c = new etuapp\control\AdminController();
	$c->supprimerMembre($id);

});

$app->post('/admin/cms', function () {
 	
	$c = new etuapp\control\AdminController();
	$c->creerCMS($_POST);

});

$app->post('/admin/membre', function () {
 	
	$c = new etuapp\control\AdminController();
	$c->creerMembre($_POST);

});

$app->run();

ob_end_flush();

?>