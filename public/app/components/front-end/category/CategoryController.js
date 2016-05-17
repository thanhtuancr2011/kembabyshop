categoryApp.controller('CategoryController', ['$scope', '$rootScope', '$uibModal', '$filter', 'CartService', '$timeout', function ($scope, $rootScope, $uibModal, $filter, CartService, $timeout) {
	
	$timeout(function(){
		/* When js didn't  loaded then hide table categories */
		$('.content').removeClass('hidden');
		$('#page-loading').css('display', 'none');
	})

	$scope.products = angular.copy(window.products);

	$scope.category = window.category;

	$scope.addProductToCart = function (productId) {
		CartService.addProductToCart(productId).then(function(data) {
			$rootScope.$emit("CallToMethodShowCart", data);
		});
	}
}]);