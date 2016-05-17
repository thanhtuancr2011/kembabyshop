var searchApp = angular.module('searchApp', []);
searchApp.factory('SearchResource',['$resource', function ($resource){
    return $resource('/api/search/:method/:id', {'method':'@method','id':'@id'}, {
        add: {method: 'post'},
        save:{method: 'post'},
        update:{method: 'put'}
    });
}])
.service('SearchService', ['SearchResource', '$q', function (SearchResource, $q) {
    

}]);
