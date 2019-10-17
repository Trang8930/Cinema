var Controller;

Controller = function(ApiService, $scope, $rootScope, $location) {
  var options;
  $scope.info;
  options = {
    url: "/api/policy/info",
    method: 'GET'
  };
  return ApiService.request(options, function(err, result) {
    return $scope.info = result;
  });
};

Controller.$inject = ['ApiService', '$scope', '$rootScope', '$location'];

angular.module("appweb").controller('policyController', Controller);
