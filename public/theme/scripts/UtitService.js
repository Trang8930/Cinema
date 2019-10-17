var _service;

_service = function($rootScope, $http) {
  var self;
  self = this;
  self.lang = function() {
    var lang;
    lang = $('html').attr('lang');
    return lang;
  };
  self.apply = function(scope) {
    return setTimeout(function() {
      return scope.$apply();
    }, 1);
  };
  self.notify = function(cb, message, title) {
    var data;
    data = {
      message: message,
      title: title
    };
    return $rootScope.$broadcast('show-dialog', data, cb);
  };
  self.formatSessionDate = function(dateInfo) {
    var data, date, dates, datesLabel;
    datesLabel = ['Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bảy'];
    dates = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
    date = new Date(dateInfo.replace('.000Z', ''));
    data = {
      dayOfWeekLabel: datesLabel[date.getDay()],
      dayOfWeekKey: dates[date.getDay()],
      showDate: (date.getDate()) + "/" + (date.getMonth() + 1) + "/" + (date.getFullYear()),
      showTime: (date.getHours()) + ":" + (date.getMinutes()),
      originDate: dateInfo
    };
    console.log(data);
    return data;
  };
  self.getHrefSearch = function(item) {
    var href, prefix;
    prefix = 'phim';
    switch (item.modelType) {
      case 'post':
        switch (item.type) {
          case 'review':
            prefix = "binh-luan-phim";
            break;
          case 'promotion':
            prefix = "khuyen-mai";
        }
        break;
      case 'metadata':
        switch (item.type) {
          case 'cast':
            prefix = "dien-vien";
            break;
          case 'directore':
            prefix = "dao-dien";
        }
        break;
      case 'cinema':
        prefix = "rap-gia-ve";
        break;
    }
    href = "/" + prefix + "/" + item.slug;
    return href;
  };
  return null;
};

_service.$inject = ['$rootScope', '$http'];

angular.module('appweb').service('UtitService', _service);
