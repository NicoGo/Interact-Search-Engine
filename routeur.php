<?php

session_start();

use etuapp\models\User;

// AUTOLOAD ET DB

require("vendor/autoload.php");

$app = new \Slim\Slim();

// --------------------- SCRIPT COOKIE -------------------------- 

//if(isset($_COOKIE["login"]) && isset($_COOKIE["pass"]))
//{
//	$count = User::Where("login","=",$_COOKIE["login"])->Where("pass","=",$_COOKIE["pass"])->count();

//	if($count==1)
//	{
//		$_SESSION["user"] = User::Where("login","=",$_COOKIE["login"])->Where("pass","=",$_COOKIE["pass"])->first()->id;
//	}
//}

$_SESSION["user"] = 3;

// --------------------- SECTION ACCEUIL -------------------------- 


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
	$c = new etuapp\control\SitesController();
	$c->search($keyword);
});

$app->get('/search/', function () {
	$c = new etuapp\control\SitesController();
	$c->search("");
});

// --------------------- SECTION SERVEURS -------------------------- 

$app->get('/servers', function () {
	$c = new etuapp\control\SitesController();
	$c->servers();
});

$app->run();
