var myApp = angular.module('engineApp',['ngRoute']);
  
myApp.controller('ResultsController', ['$scope','$http','$filter', function($scope,$http,$filter) {

   var result = this;

   $scope.results = [];
   $scope.servers = [];
   $scope.count = 0;
   $scope.keywords = "";
 
    // DETERMINE LA CLASSE
    result.renderStar = function(fav) {
      if(fav==1)
        return "fa fa-star";
      return "fa fa-star-o";
    };

    result.toFavorite = function(id)
    { 
      // requete AJAX post 
      $http.get("../routeur.php/favorite/"+id)
      .then(function(response){
            // trouver id 
            var obj = $filter('filter')($scope.results, function (d) {return d.id_site === id;});
            obj = obj[0];
            
            if(obj.favorite==1)
              obj.favorite = 0;
            else
              obj.favorite = 1;
            result.refreshTab();
        }); 
    };

    result.refreshTab = function()
    {
      console.log($scope.results);
      $scope.results = [];
      $scope.count = 0;
      result.getServers();
      $http.get("../routeur.php/search/a")
      .then(function(response){
        angular.forEach(response.data, function(obj) {
          $scope.results.push(obj);
          $scope.count++;
        }); 
      });
    };

    result.getServers = function()
    {
      console.log("fefez");
      $scope.servers = [];
      $http.get("../routeur.php/servers")
      .then(function(response){
        angular.forEach(response.data, function(obj) {
          $scope.servers.push(obj);
        }); 
      });
    }

    result.clickLink = function(id)
    {
      $http.get("../routeur.php/inc/"+id)
      .then(function(response) {
          var obj = $filter('filter')($scope.results, function (d) {return d.id_site === id;});
          obj = obj[0];
          obj.views++;
          obj.view_all++;
        }); 
    }

    result.selectServer = function(server)
    {
      result.search(server);
    }

    result.search = function(word)
    {

      if(typeof word === 'undefined')
      {
        $scope.results = [];
        console.log("../routeur.php/search/"+$scope.keywords);
        $http.get("../routeur.php/search/"+$scope.keywords)
        .then(function(response) {
          console.log(response);
            angular.forEach(response.data, function(obj) {
            $scope.results.push(obj);
          }); 
        });
      }
      else
      {
        $scope.results = [];
        $http.get("../routeur.php/search/"+word)
        .then(function(response) {
            angular.forEach(response.data, function(obj) {
            $scope.results.push(obj);
          }); 
        });
      }
    }

    result.postSite = function()
    {
      console.log($scope.fields);
      $http({
        url: "routeur.php/addsite",
          method: "POST",
          data:$scope.fields
        }).success(function(data, status, headers, config) {
          console.log(data);
        }).error(function(data, status, headers, config) {
          $scope.status = status;
      });
        result.refreshTab();
    }

}]);
