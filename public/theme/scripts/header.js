var _headerController;

_headerController = function(ApiService, $scope, UtitService, $rootScope, GTMService, $cookies) {
  var GTMTracking;
  $scope.init = function(slug, slugQuery, userSessionId, movieShowing, movieComingSoon, movieDetail, people, transactionInfo) {
    console.log("_headerController");
    $scope.slug = slug;
    $scope.slugQuery = slugQuery;
    $scope.userSessionId = userSessionId;
    $rootScope.movieShowing = movieShowing;
    $rootScope.movieComingSoon = movieComingSoon;
    $rootScope.movieDetail = movieDetail;
    $rootScope.people = people;
    if (transactionInfo) {
      $scope.transactionInfo = transactionInfo;
    }
    return GTMTracking();
  };
  $scope.logout = function() {
    var options;
    options = {
      url: "/api/auth/logout",
      method: 'POST',
      data: {}
    };
    return ApiService.request(options, function(error, result) {
      if (error) {
        return UtitService.notify(null, error.message);
      }
      $rootScope.userInfo = {};
      $cookies.remove('sessionId');
      if (window.location.pathname.indexOf('thanh-vien') === 1) {
        window.location.href = '/';
      }
      if (window.location.pathname.indexOf('book-ticket') === 1) {
        return window.location.reload();
      }
    });
  };
  $scope.openLogin = function() {
    return $('#login-modal').modal('show');
  };
  return GTMTracking = function() {
    var doneGetInfo, options;
    doneGetInfo = function(error, result) {
      console.log('userInfo', result);
      if (!error) {
        $rootScope.userInfo = result;
      }
      GTMService.pageTracking($scope.slug, $scope.slugQuery);
      if ($scope.transactionInfo) {
        return GTMService.purchaseTracking($scope.transactionInfo);
      }
    };
    options = {
      url: "/api/user/info",
      method: 'GET',
      data: {
        userSessionId: $scope.userSessionId
      }
    };
    return ApiService.request(options, doneGetInfo);
  };
};

_headerController.$inject = ['ApiService', '$scope', 'UtitService', '$rootScope', 'GTMService', '$cookies'];

angular.module("appweb").controller('headerController', _headerController);
