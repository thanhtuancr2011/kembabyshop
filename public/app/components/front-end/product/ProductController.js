productApp.controller('ProductController', ['$scope', '$rootScope', '$uibModal', '$filter', 'CartService', '$timeout', function ($scope, $rootScope, $uibModal, $filter, CartService, $timeout) {
	/* When js didn't  loaded then hide table categories */
	$('.content').removeClass('hidden');

	$timeout(function(){
		$('#page-loading').css('display', 'none');
	})

	$scope.product = window.product;

	$scope.products = window.products;

	$scope.saleProducts = [];
	angular.forEach(window.saleProducts, function(value, key) {
		if (key <= 2) {
			$scope.saleProducts.push(value);
		}
	})

	$scope.listProductMapCategoryId = angular.copy(window.listProductMapCategoryId);

	$scope.addProductToCart = function (productId) {
		CartService.addProductToCart(productId).then(function(data) {
			$rootScope.$emit("CallToMethodShowCart", data);
		});
	}

	$scope.quickViewProduct = function(productId) {
		$('#page-loading').css('display', 'block');
		var template = '/product-detail/show-modal/' + productId + '?' + new Date().getTime();
		var modalInstance = $uibModal.open({
		    animation: $scope.animationsEnabled,
		    templateUrl: window.baseUrl + template,
		    controller: 'ModalProductDetail',
		    size: 'lg',
		    resolve: {
		    }
		    
		});
	}

	// PRODUCT FILTER 
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


}])
.controller('ModalProductDetail', ['$scope', '$rootScope', '$uibModalInstance', '$timeout', '$sce', 'CartService', function ($scope, $rootScope, $uibModalInstance, $timeout, $sce, CartService) {
		$timeout(function() {
			$('#page-loading').css('display', 'none');
			$scope.product = window.product;
		});

		/* When user click cancel then close modal popup */
		$scope.closeModal = function () {
		    $uibModalInstance.dismiss('cancel');
		};

		$scope.addProductToCart = function (productId) {
			CartService.addProductToCart(productId).then(function(data) {
				$rootScope.$emit("CallToMethodShowCart", data);
			})
		}
	}
]);