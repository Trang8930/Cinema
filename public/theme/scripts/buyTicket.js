var _buyTicketDir;

_buyTicketDir = function(UtitService) {
  var directive, link, template;
  template = "<a href=\"{{link}}\"  class=\"showtimes-list\">{{session.showTime}}</a>";
  link = function($scope, $element, $attr) {
    $scope.link = 'javascript:;';
    return $scope.$watch('session', function(session) {
      var lang;
      if (session === void 0) {
        return;
      }
      lang = UtitService.lang();
      if (lang === 'vi') {
        lang = '';
      }
      return $scope.link = lang + "/book-ticket/" + $scope.slug + "?cinemaId=" + session.cinemaId + "&sessionId=" + session.sessionId;
    }, true);
  };
  directive = {
    restrict: 'E',
    scope: {
      session: '=ngModel',
      slug: '=ngMovieSlug'
    },
    template: template,
    link: link
  };
  return directive;
};

_buyTicketDir.$inject = ['UtitService'];

angular.module('appweb').directive("galaxyBuyTicket", _buyTicketDir);
