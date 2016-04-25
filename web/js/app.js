angular.module('engineApp',[])
  .controller('ResultsController', ['$scope','$http','$filter', function($scope,$http,$filter) {


    var result = this;



   $scope.todos = [];
   $scope.servers = [];
   $scope.count = 0;


 
      // DETERMINE LA CLASSE
    result.renderStar = function(fav) {
      if(fav==1)
        return "fa fa-star";
      return "fa fa-star-o";
    };

    result.toFavorite = function(id)
    { 
      // requete AJAX post 
      $http.get("routeur.php/favorite/"+id)
      .then(function(response){
            // trouver id 
            var obj = $filter('filter')($scope.todos, function (d) {return d.id_site === id;});
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
      $scope.todos = [];
      $scope.count = 0;
      result.getServers();
      $http.get("routeur.php/search/a")
      .then(function(response){
        angular.forEach(response.data, function(obj) {
          $scope.todos.push(obj);
          $scope.count++;
        }); 
      });
    };

    result.getServers = function()
    {
      $scope.servers = [];
      $http.get("routeur.php/servers")
      .then(function(response){
        angular.forEach(response.data, function(obj) {
          console.log(obj);
          $scope.servers.push(obj);
        }); 
      });
    }

    result.clickLink = function(id)
    {
      console.log(id);
      $http.get("routeur.php/inc/"+id)
      .then(function(response) {
          var obj = $filter('filter')($scope.todos, function (d) {return d.id === id;});
          obj = obj[0];
          obj.views++;
          obj.view_all++;
        }); 
    }

    result.selectServer = function()
    {
      result.search($scope.selectedOption);
    }

    result.search = function(word)
    {
      if(typeof word === 'undefined')
      {
        $scope.todos = [];
        $http.get("routeur.php/search/"+$scope.keywords)
        .then(function(response) {
            angular.forEach(response.data, function(obj) {
            $scope.todos.push(obj);
          }); 
        });
      }
      else
      {
        $scope.todos = [];
        $http.get("routeur.php/search/"+word)
        .then(function(response) {
            angular.forEach(response.data, function(obj) {
            $scope.todos.push(obj);
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