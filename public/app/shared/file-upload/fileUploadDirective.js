var fileUpload = angular.module('shop');
fileUpload.directive('fileUpload', ['FileService', 'Upload', '$timeout', '$rootScope', function(FileService, Upload, $timeout, $rootScope) {
        return {
            restrict: 'EA',
            require : '^ngModel',
            scope: {
                multipleFile: '=',
                filesUpload: '=',
                fileType: '='
            },
            replace: true,
            transclude: true,
            templateUrl: baseUrl + '/app/shared/file-upload/views/file-upload.html?v=2',
            link: function(scope, element, attrs, ngModel) {

                scope.baseUrl = baseUrl;
                scope.fileUpload = {};
                scope.fileError = {};

                /* Load file when edit */
                if (angular.isDefined(scope.filesUpload)) {

                    angular.forEach(scope.filesUpload, function(value, key) {
                        // Show file in view directive
                        value.type = scope.fileType;
                        value.progress = 100;
                        scope.fileUpload[value['uniId']] = value;

                        $rootScope.$broadcast('isNotChooseFile', { 'val': false });

                    })
                }
               
                /**
                 * Choose file upload
                 * @author Thanh Tuan <tuan@httsolution.com>
                 * @param  {File} files File
                 * @return {Void}       
                 */
                scope.chooseFile = function(files) {

                    if (files && files.length) {

                        for (var i = 0; i < files.length; i++) {
                            (function(i){
                                var file = files[i];
                                if (angular.isDefined(window.maxUpload)) {
                                    if(file['size'] > window.maxUpload['size']){
                                        file['uniId'] = getId();
                                        file['proccess'] = 100;
                                        file['error'] = 1;
                                        file['status'] = 0;
                                        scope.fileUpload[file['uniId']] = file;
                                        scope.fileUpload[file['uniId']]['error'] = 'Max file size is ' + window.maxUpload['name'];
                                        scope.fileError[file['uniId']] =file;
                                        return;
                                    } 
                                }

                                file['uniId'] = getId();
                                file['proccess'] = 0;
                                file['error'] = '';
                                scope.fileUpload[file['uniId']] = file;

                            })(i);
                        }

                        $rootScope.$broadcast('isNotChooseFile', { 'val': false });
                    }
                }

                /**
                 * Upload file
                 * @author Thanh Tuan <thanhtuancr2011@gmail.com>
                 * @return {Void}       
                 */
                scope.$on('upload', function () {

                    var count = 0;
                    scope.fileUploaded = [];

                    angular.forEach(scope.fileUpload, function(file, key) {
                        Upload.upload({
                            url: baseUrl + window.linkUpload,
                            file: file
                        }).progress(function(evt) {
                            if(angular.isDefined(scope.fileUpload[file['uniId']])) {
                                var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                            } else {
                                var progressPercentage =100;
                            }
                            if(angular.isDefined(scope.fileUpload[file['uniId']])) {
                                scope.fileUpload[file['uniId']]['proccess'] = progressPercentage;
                            }
                            
                        }).error(function(data, status, headers, config) {
                            scope.fileUpload.splice(1, i);
                            if(angular.isDefined(scope.fileUpload[file['uniId']])) {
                            if (angular.isDefined(data.message)) {
                                scope.fileUpload[file['uniId']]['error'] = data.message;
                            }
                              scope.fileError[config.file['uniId']] = data;
                            }
                        }).success(function(data, status, headers, config) {
                            if(angular.isDefined(scope.fileUpload[config.file.uniId])){
                                if (angular.isDefined(data.item)) {
                                    data.item['uniId'] = config.file.uniId;
                                    scope.fileUploaded.push(data.item);
                                }
                            }
                        }).finally(function() {
                            count++;
                            $timeout(function(){
                                if (count == Object.keys(scope.fileUpload).length) { 
                                    $rootScope.$broadcast('uploadSuccess', { files: scope.fileUploaded });
                                }
                            });
                        });
                    });
                });

                /**
                  * Check file
                  * @author Thanh Tuan <thanhtuancr2011@gmail.com>      
                  * @param  Type   type The file type
                  * @return String      The message
                  */
                scope.checkFile = function(type) {

                    var images = ['png', 'gif', 'jpg', 'jpeg'];

                    if(typeof type !== 'undefined'){
                        if(images.indexOf(type.split('/')[1]) != -1 ){
                             return 'image';
                        } else {
                            switch(type.split('/')[1]) {
                                case 'zip':
                                    return 'zip';
                                    break;
                                case 'pdf':
                                    return 'pdf';
                                    break;
                                case 'msword':
                                    return 'msword';
                                    break;
                                default:
                                    return 'other';
                                    break;
                            }
                        }
             
                    }
                }

                /**
                 * Get id of file
                 * @return {Void} 
                 */
                function getId() {
                    return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
                }

                /**
                 * Delete file
                 * @param  {Double} uniId 
                 * @return {Void}       
                 */
                scope.deleteFile = function(uniId) {
                    delete scope.fileUpload[uniId];
                    console.log(Object.keys(scope.fileUpload).length, 'scope.fileUpload).length');
                    if (Object.keys(scope.fileUpload).length == 0) {
                        $rootScope.$broadcast('isNotChooseFile', { val: true });
                    }
                }
                
            }
        }
    }
]).filter('bytes', function() {
    return function(bytes, precision) {
        if (isNaN(parseFloat(bytes)) || !isFinite(bytes)) return '-';
        if (typeof precision === 'undefined') precision = 1;
        var units = ['bytes', 'kB', 'MB', 'GB', 'TB', 'PB'],
            number = Math.floor(Math.log(bytes) / Math.log(1024));
        return (bytes / Math.pow(1024, Math.floor(number))).toFixed(precision) + ' ' + units[number];
    }
});