categoryApp.controller('CategoryController', ['$scope', '$rootScope', '$uibModal', '$filter', 'CartService', '$timeout', function ($scope, $rootScope, $uibModal, $filter, CartService, $timeout) {
	
	$timeout(function(){
		/* When js didn't  loaded then hide table categories */
		$('.content').removeClass('hidden');
		$('#page-loading').css('display', 'none');
	})

	$scope.products = angular.copy(window.products);

	$scope.category = window.category;

	// Count Category Filter
	$scope.priceRange1 = 0;
	$scope.priceRange2 = 0;
	$scope.priceRange3 = 0;
	angular.forEach(window.products, function(value, key) {
		if(value.price >= 0 && value.price <= 300000) {
			++$scope.priceRange1;
		} else if(value.price >= 301000 && value.price <= 600000) {
			++$scope.priceRange2;
		} else {
			++$scope.priceRange3;
		}
	});

	$scope.addProductToCart = function (productId) {
		CartService.addProductToCart(productId).then(function(data) {
			$rootScope.$emit("CallToMethodShowCart", data);
		});
	}

	// CATEGORY FILTER 
    $('.slider-range-price').each(function(){
    	Number.prototype.format = function(n, x) {
		    var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
		    return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
		};
        var min             = $(this).data('min');
        var max             = $(this).data('max');
        var unit            = $(this).data('unit');
        var value_min       = $(this).data('value-min');
        var value_max       = $(this).data('value-max');
        var label_reasult   = $(this).data('label-reasult');
        var t               = $(this);
        $( this ).slider({
          	range: true,
          	min: min,
          	max: max,
          	values: [value_min, value_max],
          	slide: function(event, ui) {
          		$scope.products = [];
          		angular.forEach(window.products, function(value, key) {
          			if (value.price >= ui.values[0] && value.price <= ui.values[1]) {
          				$scope.products.push(value);
          			}
          		})
          		$scope.$apply();
            	var result = label_reasult + " " + ui.values[0].format() + ' ' + unit + ' - ' + ui.values[1].format() + ' ' +unit ;
            	t.closest('.slider-range').find('.amount-range-price').html(result);
          	}
        });
    })

}]);