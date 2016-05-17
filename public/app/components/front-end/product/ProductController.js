productApp.controller('ProductController', ['$scope', '$rootScope', '$uibModal', '$filter', 'CartService', '$timeout', function ($scope, $rootScope, $uibModal, $filter, CartService, $timeout) {
	/* When js didn't  loaded then hide table categories */
	$('.content').removeClass('hidden');

	$timeout(function(){
		$('#page-loading').css('display', 'none');
	})

	$scope.product = window.product;

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