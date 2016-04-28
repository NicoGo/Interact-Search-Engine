<?php
// Routes

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});


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