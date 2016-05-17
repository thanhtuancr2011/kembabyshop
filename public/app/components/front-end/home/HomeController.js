homeApp.controller('HomeController', ['$scope', '$rootScope', '$uibModal', '$filter', 'CartService', '$sce', '$timeout', function ($scope, $rootScope, $uibModal, $filter, CartService, $sce, $timeout) {
	/* When js didn't  loaded then hide table categories */
	$('.content').removeClass('hidden');

	$timeout(function(){
		$('#page-loading').css('display', 'none');
	})

	$scope.listProductMapCategoryId = angular.copy(window.listProductMapCategoryId);

	$scope.saleProducts = angular.copy(window.saleProducts);
	
	$scope.newProducts = angular.copy(window.newProducts);

	$scope.renderHtml = function(html_code) {
		var html = $sce.trustAsHtml(html_code);
	    return html;
	};
}])
.filter("sanitize", ['$sce', function($sce) {
  	return function(htmlCode){
  	  	return $sce.trustAsHtml(htmlCode);
  	}
}]);