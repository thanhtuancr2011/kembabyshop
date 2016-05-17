var homeApp = angular.module('homeApp', []);
homeApp.factory('HomeResource',['$resource', function ($resource){
    return $resource('/api/category-detail/:method/:id', {'method':'@method','id':'@id'}, {
        add: {method: 'post'},
        save:{method: 'post'},
        update:{method: 'put'}
    });
}])
.service('CategoryService', ['HomeResource', '$q', function (HomeResource, $q) {
    

}]);
