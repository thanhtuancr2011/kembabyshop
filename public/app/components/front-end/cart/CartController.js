cartApp.controller('CartController', ['$scope', '$rootScope', '$uibModal', '$filter', 'CartService', 'CustomerService', '$timeout', function ($scope, $rootScope, $uibModal, $filter, CartService, CustomerService, $timeout) {
	/* When js didn't  loaded then hide table categories */
	$('.content').removeClass('hidden');
	$timeout(function(){
		$('#header').addClass("hidden");
		$('#page-loading').css('display', 'none');
	});

	/**
	 * When user click login facebook
	 * @return {Void} 
	 */
	$scope.logFb = function () {
		FB.login(function(response) {
    		if (response.authResponse) {
     			FB.api('/me?fields=first_name, last_name, email, picture, name, age_range, link, gender, locale, timezone, updated_time, verified', function(response) {
	       			$('#page-loading').css('display', 'block');
	       			CustomerService.loginFb(response).then(function (data){
						if (data.status == 0) {
							$('#page-loading').css('display', 'none');
							$scope.msg = data.msg;
						} else {
							CustomerService.sendEmail(data.customer).then(function (result){
								if (result.status) {
									$('#page-loading').css('display', 'none');
									$scope.customerCreated = data.customer;
									$scope.currentStep = 3;
								}
							})
						}
					})
	     		});
    		} else {
     			console.log('User cancelled login or did not fully authorize.');
    		}
		});
	}

	$scope.customer = angular.copy(window.customer);

	$scope.login = {};

	$scope.carts = angular.copy(window.carts);
	$scope.priceTotal = angular.copy(window.priceTotal);
	$scope.numberItem = angular.copy(window.numberItem);

	/**
	 * When user click update cart
	 * @param  {Object} cart Cart
	 * @return {Void}      
	 */
	$scope.updateCart = function(cart) {
		CartService.updateCart(cart).then(function(data) {
			$scope.carts = data.carts;
			$scope.priceTotal = data.priceTotal;
			$scope.numberItem = data.numberItem;
			$rootScope.$emit("CallToMethodShowCart", data);
		});
	}

	/**
	 * When user click delete cart
	 * @param  {String} rowId Cart id
	 * @return {Void}       
	 */
	$scope.deleteCart = function(rowId) {
		CartService.deleteCart(rowId).then(function(data) {
			$scope.carts = data.carts;
			$scope.priceTotal = data.priceTotal;
			$scope.numberItem = data.numberItem;
			$rootScope.$emit("CallToMethodShowCart", data);
		});
	}

	$scope.currentStep = 1;

	/**
	 * When user click button continue check out
	 * @return {Void} 
	 */
	$scope.continueCheckOut = function () {
		if (angular.isDefined($scope.customer.id)) {
			$('#page-loading').css('display', 'block');
			CustomerService.sendEmail($scope.customer).then(function (data){
				$('#page-loading').css('display', 'none');
				$scope.customerCreated = $scope.customer;
				$scope.currentStep = 3;
			})
		} else {
			$scope.currentStep += 1;
		}
	}

	/**
	 * When user click create new customer
	 * @param  {Validate} validate Validate form
	 * @return {Void}          
	 */
	$scope.submit = function (validate) {

		$scope.submitted = true;

		if (validate) {
			return;
		}

		$('#page-loading').css('display', 'block');
		
		CustomerService.createCustomerProvider($scope.customer).then(function (data){
			if(data.status == 0){
				$scope.emailExists = data.error.email[0];
				$('#page-loading').css('display', 'none');
			} else{
				CustomerService.sendEmail(data.customer).then(function (result){
					if (result.status) {
						$('#page-loading').css('display', 'none');
						$scope.customerCreated = data.customer;
						$scope.currentStep = 3;
					}
				})
			}
		})
	};

	/**
	 * When user click login
	 * @param  {Validate} validate Validate form
	 * @return {Void}          
	 */
	$scope.login = function (validate) {

		$scope.submitted1 = true;

		if (validate) {
			return;
		}

		$('#page-loading').css('display', 'block');
		
		CustomerService.login($scope.login).then(function (data){

			console.log(data, 'dáta');
			if (data.status == 0) {
				$('#page-loading').css('display', 'none');
				$scope.msg = data.msg;
			} else {
				CustomerService.sendEmail(data.customer).then(function (result){
					if (result.status) {
						$('#page-loading').css('display', 'none');
						$scope.customerCreated = data.customer;
						$scope.currentStep = 3;
					}
				})
			}
		})
	};

	$scope.$watch('customer.email', function(newVal, oldVal) {
		if (angular.isDefined(newVal) && angular.isDefined(oldVal)) {
			if (newVal != oldVal) {
				$scope.emailExists = '';
			}
		}
	})

	$scope.redirectToHome = function() {
		window.location.href = window.baseUrl;
	}

}]);