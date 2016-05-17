masterApp.controller('MasterController', ['$scope', '$rootScope', '$uibModal', '$filter', 'CartService', '$timeout', 'MasterService', '$http', function ($scope, $rootScope, $uibModal, $filter, CartService, $timeout, MasterService, $http) {
	/* When js didn't  loaded then hide element */
	$('.home').removeClass('hidden');

	$timeout(function() {
		$('.select-category').prop('disabled', true);
		$('.select2-selection__arrow').addClass('hidden');
	})

	// Lists categories
	$scope.categories = angular.copy(window.categories);

	// Shopping cart
	$scope.carts = angular.copy(window.carts);

	// Price total
	$scope.priceTotal = angular.copy(window.priceTotal);

	// Number of items
	$scope.numberItem = angular.copy(window.numberItem);

	$rootScope.$on("CallToMethodShowCart", function(event, data){
    	$scope.showCart(data);
    });

    /** SELECT CATEGORY **/
    $('.select-category').select2();

    /**
     * [showCart description]
     * @param  {[type]} data [description]
     * @return {[type]}      [description]
     */
    $scope.showCart = function(data) {
    	$scope.carts = data.carts;
    	$scope.priceTotal = data.priceTotal;
    	$scope.numberItem = data.numberItem;
    	$('#page-loading').css('display', 'none');
    }

    /**
     * [deleteCart description]
     * @param  {[type]} rowId [description]
     * @return {[type]}       [description]
     */
    $scope.deleteCart = function(rowId) {
		CartService.deleteCart(rowId).then(function(data) {
			$scope.showCart(data);
		});
	}

	$scope.search = {};
}]);