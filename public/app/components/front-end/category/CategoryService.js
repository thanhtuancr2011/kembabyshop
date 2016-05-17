var categoryApp = angular.module('categoryApp', []);
categoryApp.factory('CategoryResource',['$resource', function ($resource){
    return $resource('/api/category-detail/:method/:id', {'method':'@method','id':'@id'}, {
        add: {method: 'post'},
        save:{method: 'post'},
        update:{method: 'put'}
    });
}])
.service('CategoryService', ['CategoryResource', '$q', function (CategoryResource, $q) {
    

}]);
