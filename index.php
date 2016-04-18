<?php

ob_start();

session_start();

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use etuapp\models\User;

// AUTOLOAD ET DB

require("vendor/autoload.php");
use Illuminate\Database\Capsule\Manager as DB;
$db = new DB();
$conf = parse_ini_file("src/conf/config.ini");
$db->addConnection($conf);
$db->setAsGlobal();
$db->bootEloquent();

$app = new \Slim\Slim();

// --------------------- SCRIPT COOKIE -------------------------- 

if(isset($_COOKIE["login"]) && isset($_COOKIE["pass"]))
{
	$count = User::Where("login","=",$_COOKIE["login"])->Where("pass","=",$_COOKIE["pass"])->count();

	if($count==1)
	{
		$_SESSION["user"] = User::Where("login","=",$_COOKIE["login"])->Where("pass","=",$_COOKIE["pass"])->first()->id;
	}
}

// --------------------- SECTION ACCEUIL -------------------------- 

$app->get('/', function () {
 	
	$c = new etuapp\control\AcceuilController();
	$c->pageAcceuil();

});

// --------------------- SECTION USER -------------------------- 

$app->get('/login', function () {
	$c = new etuapp\control\UserController();
	$c->pageLogin();
});

$app->post('/login', function () {
	$c = new etuapp\control\UserController();
	$c->logUser();
});

$app->get('/register', function () {
	$c = new etuapp\control\UserController();
	$c->pageRegister();
});

$app->post('/register', function () {
	$c = new etuapp\control\UserController();
	$c->registerUser();
});

// --------------------- SECTION FAVORITE -------------------------- 

$app->get('/favorite/:id', function ($id) {
	$c = new etuapp\control\SitesController();
	$c->toFavorite($id);
});

// --------------------- SECTION AJOUT SITE -------------------------- 

$app->get('/addsite', function () {
	$c = new etuapp\control\SitesController();
	$c->pageAddSite();
});

$app->post('/addsite', function () {
	$c = new etuapp\control\SitesController();
	$c->addSite();
});

// --------------------- SECTION INCREMENTATION VIEW -------------------------- 

$app->get('/inc/:id', function ($id) {
	$c = new etuapp\control\SitesController();
	$c->toInc($id);
});

// --------------------- SECTION RECHERCHE -------------------------- 

$app->get('/search/:keyword', function ($keyword) {
	$c = new etuapp\control\AcceuilController();
	$c->search($keyword);
});

$app->get('/search', function () {
	$c = new etuapp\control\AcceuilController();
	$c->search("");
});

$app->run();

ob_end_flush();

?>