var _Controller;

_Controller = function(ApiService, $scope, UtitService, $rootScope) {
  var doneGetInfo, options;
  doneGetInfo = function(error, result) {
    if (error) {
      return;
    }
    return $scope.item = result;
  };
  options = {
    url: "/api/movie/showAndComming",
    method: 'GET',
    data: {}
  };
  return ApiService.request(options, doneGetInfo);
};

_Controller.$inject = ['ApiService', '$scope', 'UtitService', '$rootScope'];

angular.module("appweb").controller('navbarController', _Controller);
