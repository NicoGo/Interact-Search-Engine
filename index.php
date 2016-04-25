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

// --------------------- SCRIPT COOKIE -------------------------- 

if(isset($_COOKIE["login"]) && isset($_COOKIE["pass"]))
{
	$count = User::Where("login","=",$_COOKIE["login"])->Where("pass","=",$_COOKIE["pass"])->count();

	if($count==1)
	{
		$_SESSION["user"] = User::Where("login","=",$_COOKIE["login"])->Where("pass","=",$_COOKIE["pass"])->first()->id;
	}
}

?>

<!-- HTML AND ANGULAR JS -->

<!doctype html>
<html ng-app="engineApp" ng-controller="ResultsController as todoList">

  <head>

    <!-- A IMPORTER VIA NODE / BOWER -->
    <script src="bower_components/angular/angular.js"></script>
    <script src="web/js/app.js"></script>
    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="web/css/public.css">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="bower_components/components-font-awesome/css/font-awesome.css">

  </head>

  <body>

  <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Interact Search Engine</a></br></br>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" ng-keydown="todoList.search()" placeholder="Search" ng-model="keywords">
        </div>
        <div class="form-group">
          <select class="form-control" ng-change="todoList.selectServer()" ng-model="selectedOption">
            <option ng-repeat="server in servers" value="{{server.server_name}}">{{server.server_name}}</option>
          </select>
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <button class="btn btn-primary navbar-btn" type="button">Sites : {{count}}</button>
         <button class="btn btn-success navbar-btn" type="button">
            Enable <span class="badge">4</span>
          </button>
          <button class="btn btn-danger navbar-btn" type="button">
            Disable <span class="badge">3</span>
          </button>
          <button ng-click="todoList.refreshTab()" type="button" class="btn btn-default navbar-btn"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Refresh</button>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Ajout <span class="caret"></span></a>
          <ul class="dropdown-menu" style="padding: 10px;">
            <li>
             <form method="post" ng-submit="todoList.postSite()">
                <label for="name">Nom :</label>

                <input type="text" id="name" name="name" ng-model="fields.name">

                <label for="server_name">Nom du serveur :</label>

                <input type="text" id="server_name" name="server_name" ng-model="fields.server_name">

                <label for="url_dev">URL dev :</label>

                <input type="text" id="url_dev" name="url_dev" ng-model="fields.url_dev">

                <label for="url_prod">URL Prod :</label>

                <input type="text" id="url_prod" name="url_prod" ng-model="fields.url_prod"></br></br>

                <input type="submit">

              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
  </nav>

<div class="container-fluid">
  <div class="row">

    <div class="col-md-6">

      <div class="panel panel-success">

        <div class="panel-heading">Sites Enable</div>

        <ul class="list-group">
          <li class="list-group-item" ng-repeat="todo in todos"><b>{{todo.name}}</b> &nbsp; <span class="label label-info">{{todo.server_name}}</span><i ng-click="todoList.toFavorite(todo.id_site)" style="color: #d35400;" ng-class="todoList.renderStar(todo.favorite)" aria-hidden="true"></i><span class="badge">{{todo.views}}</span>
            </br>Url prod : <a ng-click="todoList.clickLink(todo.id_site)" href="http://{{todo.url_prod}}" target="_blank">http://{{todo.url_prod}}</a>
            </br>Url dev : <a ng-click="todoList.clickLink(todo.id_site)" href="http://{{todo.url_dev}}" target="_blank">http://{{todo.url_dev}}</a>
          </li>
        </ul>

      </div>

    </div>

    <div class="col-md-6">

      <div class="panel panel-danger">

        <div class="panel-heading">Sites Disable</div>

        <ul class="list-group">
          <li class="list-group-item" ng-repeat="todo in todos"><b>{{todo.name}}</b> &nbsp; <span class="label label-info">{{todo.server_name}}</span><i ng-click="todoList.toFavorite(todo.id_site)" style="color: #d35400;" ng-class="todoList.renderStar(todo.favorite)" aria-hidden="true"></i><span class="badge">{{todo.views}}</span>
            </br>Url prod : <a ng-click="todoList.clickLink(todo.id_site)" href="http://{{todo.url_prod}}" target="_blank">http://{{todo.url_prod}}</a>
            </br>Url dev : <a ng-click="todoList.clickLink(todo.id_site)" href="http://{{todo.url_dev}}" target="_blank">http://{{todo.url_dev}}</a>
          </li>
        </ul>

      </div>

    </div>

  </div>
</div>

  </body>

</html>