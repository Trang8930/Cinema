var _loginController;

_loginController = function(ApiService, $scope, $rootScope, $location) {
  var doneLogin, initEvent;
  $scope.isSubmit = false;
  $scope.enableSkip = false;
  $scope.callbackBuyTicket = void 0;
  $scope.userNotActive = false;
  $scope.closeModel = function() {
    return $('#login-modal').modal('hide');
  };
  $scope.openModel = function() {
    return $('#login-modal').modal('show');
  };
  initEvent = function() {
    $('#login-modal').on('hidden.bs.modal', function() {
      $scope.enableSkip = false;
      if (_.isFunction($scope.callbackBuyTicket)) {
        $scope.callbackBuyTicket();
      }
      $scope.callbackBuyTicket = void 0;
      $scope.$apply();
      return console.log('hidemodel');
    });
    $rootScope.$on('open-login', function(event, callback, data) {
      console.log(data, callback);
      $scope.callbackBuyTicket = callback;
      $scope.enableSkip = data.enableSkip;
      return $scope.openModel();
    });
    if ($location.absUrl().indexOf("#tab_login_1") !== -1 || $location.absUrl().indexOf("qac=login") !== -1) {
      $scope.openModel();
      angular.element(document.querySelector('#tab_login_2')).removeClass('active');
      angular.element(document.querySelector('#tab_login_1')).addClass('active');
      angular.element(document.querySelector('#a_tab_login_2')).parent().removeClass('active');
      angular.element(document.querySelector('#a_tab_login_1')).parent().addClass('active');
    }
    if ($location.absUrl().indexOf("#tab_login_2") !== -1 || $location.absUrl().indexOf("qac=register") !== -1) {
      $scope.openModel();
      angular.element(document.querySelector('#tab_login_2')).addClass('active');
      angular.element(document.querySelector('#tab_login_1')).removeClass('active');
      angular.element(document.querySelector('#a_tab_login_2')).parent().addClass('active');
      return angular.element(document.querySelector('#a_tab_login_1')).parent().removeClass('active');
    }
  };
  initEvent();
  $scope.userInfo = {
    email: '',
    password: '',
    fullName: '',
    mobielPhone: '',
    confirmPassword: '',
    city: '',
    suburb: '',
    remember: false
  };
  $scope.submit = function() {
    var options;
    $scope.message = null;
    if ($scope.isSubmit) {
      return;
    }
    $scope.isSubmit = true;
    $scope.userNotActive = false;
    options = {
      url: "/api/auth/login",
      method: 'POST',
      data: $scope.userInfo
    };
    return ApiService.request(options, doneLogin);
  };
  doneLogin = function(error, result) {
    $scope.isSubmit = false;
    if (error) {
      if (error.code === 4001) {
        $scope.userNotActive = true;
      }
      $scope.message = error.message;
      return;
    }
    $rootScope.userInfo = result;
    $scope.closeModel();
    if (window.location.href.indexOf("book-ticket") > 0) {
      return window.location.reload();
    }
  };
  return $scope.reSendActiveCode = function() {
    var doneResend, options;
    options = {
      url: "/api/auth/reSendActiveCode",
      method: 'POST',
      data: $scope.userInfo
    };
    doneResend = function(error, result) {
      return $scope.message = result.message;
    };
    return ApiService.request(options, doneResend);
  };
};

_loginController.$inject = ['ApiService', '$scope', '$rootScope', '$location'];

angular.module("appweb").controller('loginController', _loginController);
