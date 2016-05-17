customerApp.controller('CustomerController', ['$scope', '$rootScope', '$uibModal', '$filter', 'CustomerService', '$timeout', '$http', function ($scope, $rootScope, $uibModal, $filter, CustomerService, $timeout, $http) {
	/* When js didn't  loaded then hide table categories */
	$('.content').removeClass('hidden');

	$timeout(function(){
		$('.is-home').addClass("hidden");
		$('#page-loading').css('display', 'none');
	});

	$scope.submit = function (validate) {

		$scope.emailExists = '';
		$scope.messageCreateSuccess = '';

		$scope.submitted = true;

		if (validate) {
			return;
		}

		$('#page-loading').css('display', 'block');
		
		CustomerService.createCustomerProvider($scope.customer).then(function (data){
			$('#page-loading').css('display', 'none');
			if(data.status == 0){
				$scope.emailExists = data.error.email[0];
			} else{
				$scope.customer = {};
				$scope.submitted = false;
				$scope.messageCreateSuccess = 'Chúc mừng! tài khoản của bạn đã được tạo thành công.';
				$timeout(function(){
					$scope.messageCreateSuccess = '';
				}, 3000)
			}
		});
	};

	$scope.logFb = function () {
		FB.login(function(response) {
    		if (response.authResponse) {
     			FB.api('/me?fields=first_name, last_name, email, picture, name, age_range, link, gender, locale, timezone, updated_time, verified', function(response) {
	       			$('#page-loading').css('display', 'block');
	       			CustomerService.loginFb(response).then(function (data){
						$('#page-loading').css('display', 'none');
						if (data.status == 0) {
							$scope.msg = data.msg;
						} else {
							window.location = window.baseUrl;
						}
					})
	     		});
    		} else {
     			console.log('User cancelled login or did not fully authorize.');
    		}
		});
	}

	$scope.login = function (validate) {
		
		$scope.msg = '';

		$scope.submitted1 = true;

		if (validate) {
			return;
		}

		$('#page-loading').css('display', 'block');
		
		CustomerService.login($scope.customerLogin).then(function (data){
			$('#page-loading').css('display', 'none');
			if (data.status == 0) {
				$scope.msg = data.msg;
			} else {
				window.location = window.baseUrl;
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
}]);