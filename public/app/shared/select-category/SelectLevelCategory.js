var selectLevel = angular.module('selectLevelCategory', []);
'use strict';
var version = 5;
selectLevel.directive("selectLevelCategory", ['$timeout', '$filter', function($timeout, $filter) {
    return {
        require: '?ngModel',
        restrict: 'EA',
        scope: {
            items: '=',
            text: '@',
            selectedItems: '=selectedItem',
            onClick: '&',
            currentCategory: '='
        },
        replace: true,
        templateUrl: baseUrl + '/app/shared/select-category/views/view.html?v=' + new Date().getTime(),
        link: function($scope, element, attrs, ngModel) {

            var itemIdNeedActived = [];
            if (angular.isDefined($scope.selectedItems)) {
                itemIdNeedActived = $scope.selectedItems;
            }

            $scope.$watch('selectedItems', function(newVal, oldVal) {
                if (angular.isDefined(newVal)) {
                    $timeout(function(){
                        $scope.text = newVal.name;
                    })
                }
            });

            $timeout(function() {
                // event click document
                $(document).on('click', function closeMenu(e) {
                    if ($('#select-level-modal').hasClass('in') && !$(".js-filterable-field").is(":focus")) {
                        $('#select-level-modal').collapse('hide');
                        $('.show-sub-select i').removeClass('fa fa-folder-open fa').addClass('fa fa-folder');
                    }
                });

                $scope.showSubSelect = function(event) {
                    $(event.currentTarget).addClass('fa fa-folder');
                    $(event.currentTarget).toggleClass('fa fa-folder-open fa');
                    // how to hide previously clicked submenus?
                }
                
            });

            /**
             * Select Item
             * @author Thanh Tuan <thanhtuancr2011@gmail.com>
             * @param  {Object} item    Item selected
             * @param  {Event}  $event  Event
             * @return {Void}
             */
            $scope.selectedItem = function(item, event) {
                // Prevent ng-click
                if (angular.isDefined(event)) {
                    event.preventDefault();
                }

                // Delete all class active in tag a
                $('#select-level').find('a').removeClass('active-category');

                // Toggle class active off item clicked
                $(event.currentTarget).toggleClass('active-category');

                // Set value ngModel
                ngModel.$setViewValue(item.id);

                // Item need active
                itemIdNeedActived = item;

                // Set text
                $scope.text = item.name;

                // If change type of page
                $scope.onClick({categoryId: item.id});

                $scope.toggle();
            }

            /**
             * Toggle select menu
             * @author Thanh Tuan <thanhtuancr2011@gmail.com>
             * @param  {Event} $event Event
             * @return {Void}      
             */
            $scope.toggleSelectMenu = function($event) {
                // Delete all class active in tag a
                $('#select-level').find('ul').removeClass('in');
                $('#select-level').find('i').removeClass('fa fa-folder-open fa').addClass('fa fa-folder');

                // Expand ancestor of item activated
                if (angular.isDefined(itemIdNeedActived.ancestor_ids)) {
                    angular.forEach(itemIdNeedActived.ancestor_ids, function (value, key) {
                        $('.sub-select-' + value).addClass('in');
                        // Delete all class active in tag a
                        $('.show-sub-select-' + itemIdNeedActived.id).addClass('active-category');
                        $('.icon-folder-' + value).removeClass('fa fa-folder').addClass('fa fa-folder-open fa');
                    });
                }

                $scope.toggle();
            }

            /**
             * Toggle
             * @author Thanh Tuan <thanhtuancr2011@gmail.com>   
             * @param  {Event} $event Event
             * @return {Void}       
             */
            $scope.toggle = function($event) {
                $('.select-level-modal').collapse('toggle');
            }
        }

    }
}])
