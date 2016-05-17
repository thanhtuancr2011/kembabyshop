var customerApp = angular.module('CustomerApp', []);
customerApp.factory('CustomerResource',['$resource', function ($resource){
    return $resource('/api/customer/:method/:id', {'method':'@method','id':'@id'}, {
        add: {method: 'post'},
        save:{method: 'post'},
        update:{method: 'put'}
    });
}])
.service('CustomerService', ['CustomerResource', '$q', function (CustomerResource, $q) {

	/**
	 * Create new customer
	 *
	 * @author  Thanh Tuan <tuan@httsolution.com>
	 * 
	 * @param  {Object} data Data input
	 * 
	 * @return {Void}      
	 */
	this.createCustomerProvider = function(data){
		var defer = $q.defer(); 
        var temp  = new CustomerResource(data);
        /* Create customer successfull */
        temp.$save({}, function success(data) {
            /* Resolve result */
            defer.resolve(data);
        },
        /* If create customer is error */
        function error(reponse) {
            /* Resolve result */
        	defer.resolve(reponse.data);
        });

        return defer.promise;  
	};

	/**
	 * Login customer
	 *
	 * @author Thanh Tuan <thanhtuancr2011@gmail.com>
	 * 
	 * @param  {Object} data Data input
	 * 
	 * @return {Void}      
	 */
    this.login = function (data) {
        var defer = $q.defer(); 
        var temp  = new CustomerResource(data);
        temp.$save({method: 'login'}, function success(data) {
            defer.resolve(data);
        },
        
        function error(reponse) {
            defer.resolve(reponse.data);
        });
        return defer.promise;  
    }

    /**
     * Send Email to Customer
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  {Object} data Customer
     * 
     * @return {Void}      
     */
    this.sendEmail = function (data) {
        var defer = $q.defer(); 
        var temp  = new CustomerResource(data);
        temp.$save({method: 'send-email'}, function success(data) {
            defer.resolve(data);
        },
        
        function error(reponse) {
            defer.resolve(reponse.data);
        });
        return defer.promise;  
    }

    this.loginFb = function (data) {
        delete data.id;
        var defer = $q.defer(); 
        var temp  = new CustomerResource(data);
        temp.$save({method: 'login-facebook'}, function success(data) {
            defer.resolve(data);
        },
        
        function error(reponse) {
            defer.resolve(reponse.data);
        });
        return defer.promise;  
    }

}]);
