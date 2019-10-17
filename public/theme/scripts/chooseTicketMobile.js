var _chooseTicketDir;

_chooseTicketDir = function($rootScope, $document, GTMService) {
  var directive, link, template;
  template = "<tr ng-repeat='item in items'>\n  <td>\n    <p><b>{{item.name}}</b></p>\n    <p class=\"des-corn\">{{item.description}}</p>\n  </td>\n  <td class=\"td-mobile-number\">\n    <div class=\"input-group input-booking\">\n      <span class=\"input-group-btn\" ng-click='addSeat($index,false)'>\n        <button type=\"button\" ng-disabled=\"item.defaultQuantity==0\" class=\"btn btn-addminus\">\n          <span><i class=\"icon-minus\"></i></span>\n        </button>\n      </span>\n      <input style='width: 40px' type=\"number\" ng-model=\"item.defaultQuantity\" ng-min=\"0\" ng-max=\"maxSeat\" class=\"form-control input-number\"/>\n      <span class=\"input-group-btn\" ng-click='addSeat($index,true)'>\n        <button type=\"button\" class=\"btn btn-addminus\" ng-disabled=\"item.defaultQuantity==maxSeat\">\n          <span><i class=\"icon-plus\"></i></span>\n        </button>\n      </span>\n    </div>\n  </td>\n  <td >{{item.displayPrice  | currency : \"\" : 0 }}</td>\n</tr>\n<tr ng-repeat='bar in getBarcode(items)'>\n                  <td>Mã Voucher / Mã Pin</td>\n                  <td>\n                    <div class=\"input-group input-booking\">\n                      <input ng-model='bar.voucher' style='width: 80px' type=\"text\" placeholder='Mã Voucher' class=\"form-control input-number\"/>\n                    </div>\n                  </td>\n                  <td class='add-pin'>\n                    <div class=\"input-group input-booking\">\n                      <input ng-model='bar.bincode'  style='width: 80px' type=\"text\" placeholder='Mã Pin' class=\"form-control input-number\"/>\n                    </div>\n                  </td>\n  </tr>";
  link = function($scope, $element, $attr) {
    $scope.maxSeat = 8;
    $scope.action = '';
    $scope.item = {};
    $scope.getBarcode = function(items) {
      var index;
      index = _.findIndex(items, function(item) {
        var ref;
        if (((ref = item.barcode) != null ? ref.length : void 0) > 0) {
          return item;
        }
      });
      if (index === -1) {
        return [];
      }
      return items[index].barcode;
    };
    $scope.addSeat = function(index, next) {
      var quantity;
      quantity = $scope.items[index].defaultQuantity;
      $scope.item = $scope.items[index];
      if (next) {
        quantity++;
        $scope.action = 'add';
      } else {
        quantity--;
        $scope.action = 'remove';
      }
      if (quantity < 0) {
        quantity = 0;
      }
      if (quantity > $scope.maxSeat) {
        quantity = $scope.maxSeat;
      }
      return $scope.items[index].defaultQuantity = quantity;
    };
    return $scope.$watch('items', function(data) {
      $scope.total = 0;
      _.map(data, function(item) {
        var voucher;
        item.defaultQuantity = item.defaultQuantity || '';
        $scope.total = $scope.total + (item.defaultQuantity || 0) * item.displayPrice;
        if (_.isNumber(item.defaultQuantity) && item.defaultQuantity > 0 && item.displayPrice === 0) {
          voucher = {
            voucher: '',
            bincode: ''
          };
          if (!item.barcode) {
            item.barcode = [];
          }
          if (item.defaultQuantity > item.barcode.length) {
            item.barcode.push(voucher);
          } else if (item.defaultQuantity < item.barcode.length) {
            item.barcode.pop();
          }
        } else {
          item.barcode = [];
        }
        return item;
      });
      $scope.items = data;
      if ($scope.action !== '') {
        return GTMService.checkoutTracking($scope.action, 'ticket', $scope.item);
      }
    }, true);
  };
  directive = {
    restrict: 'A',
    scope: {
      items: '=ngModel'
    },
    template: template,
    link: link
  };
  return directive;
};

_chooseTicketDir.$inject = ['$rootScope', '$document', 'GTMService'];

angular.module('appweb').directive("galaxyChooseTicketMobile", _chooseTicketDir);
