var productApp = angular.module('productApp', []);
productApp.factory('ProductResource',['$resource', function ($resource){
    return $resource('/api/category-detail/:method/:id', {'method':'@method','id':'@id'}, {
        add: {method: 'post'},
        save:{method: 'post'},
        update:{method: 'put'}
    });
}])
.service('CategoryService', ['ProductResource', '$q', function (ProductResource, $q) {
    

}]);
