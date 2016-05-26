userApp.controller('UserProfileControler', ['$scope', '$uibModal', 'UserProfileService', '$q', '$http',
    function($scope, $uibModal, UserProfileService, $q, $http) {
    /* When js didn't  loaded then hide table user */
    $('.user-profile').removeClass('hidden');
    $('#page-loading').css('display', 'none');

    /* Set userProfile */
    $scope.profileUser = angular.copy(window.profileUser);

    /* Change password for user */
    $scope.getModalChangePassword = function(userId) {
        var modalInstance = $uibModal.open({
            templateUrl: window.baseUrl + '/user/change-password',
            controller: 'ModalChangePassword',
            size: null,
            resolve: {
                userId: function() {
                    return userId;
                }
            },
        });
        modalInstance.result.then(function() {}, function() {

        });
    };

    /**
     * Upload image profile
     * @param  {File}   files File upload
     * @param  {String} type  Type upload
     * @return {Void}       
     */
    $scope.upload = function(files, type) {
        if (files.length != 0) {
            $scope.files = files;
            $scope.getModalCropAvatar();
        }
    }

    $scope.getModalCropAvatar = function(size) {
        var modalInstance = $uibModal.open({
            templateUrl: window.baseUrl + '/app/components/back-end/users/view/modal/myModalContent.html',
            controller: 'ModalChangeAvatar',
            size: size,
            resolve: {
                files: function() {
                    return $scope.files;
                },
                userId: function() {
                    return $scope.userProfile.id;
                }
            },
        });
        modalInstance.result.then(function(avatarUrl) {
            $scope.userProfile.avatar = avatarUrl;
            $('#page-loading').css('display', 'none');
        }, function() {

        });
    };

    $scope.checkFirstName = function(data) {
        if (data == '') {
          return "Mời bạn nhập tên";
        } else {
            $scope.userProfile.first_name = data;
            $scope.updateUser();
        }
    };

    $scope.checkLastName = function(data) {
        if (data == '') {
          return "Mời bạn nhập họ";
        } else {
            $scope.userProfile.last_name = data;
            $scope.updateUser();
        }
    };

    $scope.checkEmail = function(email,id) {

        $status = 1;

        var regex_email = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/i;

        if(email == '') {

            return "Mời bạn nhập email!";

        } else if(regex_email.test(email) == false) {

            return "Email không đúng định dạng";

        } else {

            var d = $q.defer();

            $http.post('/api/user/profile/check-email', {id: id, email:email}).success(function(res) {

                res = res || {};
                if(res.status == 1) {

                    $scope.userProfile.email = email;

                    $scope.updateUser();

                    d.resolve();

                } else {

                    d.resolve('Email đã tồn tại trong hệ thống.');
                }

            }).error(function(e){

                d.reject('Server error!');
            });
            return d.promise;
        }
    }

    $scope.updateUser = function(){
        $('#page-loading').css('display', 'block');
        UserProfileService.update($scope.userProfile).then(function(data){
            if(data.status) {
                $('#page-loading').css('display', 'none');
                $scope.userProfile = data.user;                    
            }
        });
    }

}])
.controller('ModalChangePassword', ['$scope', '$uibModalInstance', 'UserProfileService', 'userId', '$timeout', 
    function($scope, $uibModalInstance, UserProfileService, userId, $timeout) {
    /* When user click add or edit user */
    $scope.submit = function() {
        $('#page-loading').css('display', 'block');
        UserProfileService.changePassword($scope.user, userId).then(function(data) {
            /* If change password fail */
            if (data.status == 0) {
                $('#page-loading').css('display', 'none');
                $scope.errors = 'Đổi mật khẩu chưa thành công';
            } else {
                $('#page-loading').css('display', 'none');
                $scope.message_success = 'Đổi mật khẩu thành công';
                $timeout(function() {
                    /* Close modal */
                    $uibModalInstance.close(data);
                }, 3000);
            }

        })
    };

    /* When user click cancel then close modal popup */
    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };
}])
.controller('ModalChangeAvatar', ['$scope', '$timeout', '$uibModalInstance', 'Upload', 'UserProfileService', 'files', 'userId',
    function($scope, $timeout, $uibModalInstance, Upload, UserProfileService, files, userId) {
        $scope.myImage = '';
        $scope.myCroppedImage = '';
        var reader = new FileReader();
        if (files.length != 0) {
            reader.readAsDataURL(files[0]);
            reader.onload = function(evt) {
                $scope.$apply(function() {
                    $scope.myImage = evt.target.result;
                    $scope.myCroppedImage = evt.target.result;
                });
            };
        }
        $scope.changeAvatar = function() {
            $('#page-loading').css('display', 'block');
            UserProfileService.changeAvatar(userId, $scope.myCroppedImage).then(function(response) {
                $uibModalInstance.close(response.item.avatar);
            });
        }

        $scope.cancel = function() {
            $uibModalInstance.dismiss('cancel');
        };

    }
]);