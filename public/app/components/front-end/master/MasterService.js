var masterApp = angular.module('masterApp', []);
masterApp.factory('MasterResource',['$resource', function ($resource){
    return $resource('/api/:method/:id', {'method':'@method','id':'@id'}, {
        add: {method: 'post'},
        save:{method: 'post'},
        update:{method: 'put'}
    });
}])
.service('MasterService', ['MasterResource', '$q', function (MasterResource, $q) {
    
    /**
     * Search product
     * @augments Thanh Tuan <thanhtuancr2011@gmail.com>
     * @param  {Object} data Data search
     * @return {Void}      
     */
    this.searchProduct = function(data){
        var defer = $q.defer(); 
        var temp  = new MasterResource(data);
        temp.$save({method: 'search-product'}, function success(data) {
            /* Resolve result */
            defer.resolve(data);
        },
        /* If error */
        function error(reponse) {
            /* Resolve result */
            defer.resolve(reponse.data);
        });

        return defer.promise;  
    };
}]);
