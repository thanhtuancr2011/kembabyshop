var cartApp = angular.module('CartApp', []);
cartApp.factory('CartResource',['$resource', function ($resource){
    return $resource('/api/shopping-cart/:method/:id', {'method':'@method','id':'@id'}, {
        add: {method: 'post'},
        save:{method: 'post'},
        update:{method: 'put'}
    });
}])
.service('CartService', ['CartResource', '$q', function (CartResource, $q) {

    /**
     * Add product to cart
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param {String} productId Id of product
     */
    this.addProductToCart = function(productId){
        $('#page-loading').css('display', 'block');
        var defer = $q.defer(); 
        var temp  = new CartResource();
        temp.$save({id: productId}, function success(data) {
            defer.resolve(data);
        },
        function error(reponse) {
            defer.resolve(reponse.data);
        });
        
        return defer.promise;  
    };

    /**
     * Update cart
     *
     * @author Thanh Tuan <thanhtuancr2011@gmail.com>
     * 
     * @param  {Cart} data Cart
     * 
     * @return {Void}      
     */
    this.updateCart = function(data){
        var defer = $q.defer(); 
        var temp  = new CartResource(data);
        temp.$update({id: data['rowid']}, function success(data) {
            defer.resolve(data);
        },
        function error(reponse) {
            defer.resolve(reponse.data);
        });
        return defer.promise;  
    };

    this.deleteCart = function (id) {
        var defer = $q.defer(); 
        var temp  = new CartResource();
        temp.$delete({id: id}, function success(data) {
            defer.resolve(data);
        },
        function error(reponse) {
            defer.resolve(reponse.data);
        });
        return defer.promise;  
    }

}]);
