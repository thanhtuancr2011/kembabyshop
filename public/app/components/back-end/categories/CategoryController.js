categoryApp.controller('CategoryController', ['$scope', '$uibModal', '$filter', 'ngTableParams', 'CategoryService', function ($scope, $uibModal, $filter, ngTableParams, CategoryService) {
	/* When js didn't  loaded then hide table categories */
	$('.container-fluid').removeClass('hidden');
	$('#page-loading').css('display', 'none');

	/* Not show search in table categories */
	$scope.isSearch = false;

	/* Set data categories to scope */
	$scope.data = CategoryService.setCategories(angular.copy(window.categories));

	$scope.listCategories = window.listsMapCategories;

	/* Use ng-table for table categories */
	$scope.tableParams = new ngTableParams({
        page: 1,
        count: 50,
        filter: {
            name: ''
        },
        sorting: {
            name: 'asc'
        }

    }, {
        total: $scope.data.length,
        getData: function ($defer, params) {
        	var orderedData = params.filter() ? $filter('filter')($scope.data, params.filter()) : $scope.data; /* Filter categories */
        	orderedData = params.sorting() ? $filter('orderBy')(orderedData, params.orderBy()) : orderedData; /* Sort categories */
            $defer.resolve(orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count())); /* Paging */
        }
    })

	$scope.createCategory = function(){
		var template = '/admin/category/create?v=' + new Date().getTime();  /* Create category */
		window.location.href = window.baseUrl + template;
	};

	/**
	 * Edit category
	 * @author Thanh Tuan <thanhtuancr2011@gmail.com>
	 * @param  {Int} id ProductId
	 * @return {Void}    
	 */
	$scope.editCategory = function(id) {
		var template = '/admin/category/'+ id + '/edit?v=' + new Date().getTime(); /* Edit category */
		window.location.href = window.baseUrl + template;
	}

	/* Delete category */
	$scope.removeCategory = function(id, size){
		var template = '/app/components/back-end/categories/view/DeleteCategory.html?v=' + new Date().getTime();  /* Delete category */
		var modalInstance = $uibModal.open({
		    animation: $scope.animationsEnabled,
		    templateUrl: window.baseUrl + template,
		    controller: 'ModalDeleteCategoryCtrl',
		    size: size,
		    resolve: {
		    	categoryId: function(){
		            return id;
		        }
		    }
		    
		});

		/* After create or edit category then reset category and reload ng-table */
		modalInstance.result.then(function (data) {
			$scope.data = CategoryService.getCategories();
			$scope.tableParams.reload();
		}, function () {

		   });
	};

}])
.controller('ModalCreateCategoryCtrl', ['$controller', '$scope', 'CategoryService', '$timeout', function ($controller, $scope, CategoryService, $timeout) {
	/* When js loaded */
	$('#page-wrapper').removeClass('hidden');
	$('#page-loading').css('display', 'none');

	$scope.initSortNumber = function () {
    	$("#sort-order").maskMoney({suffix: '', precision: 0});
    };

	/* Show categories tree */
	$timeout(function(){
		$scope.categoriesTree = angular.copy(window.categoriesTree);
	});

	$scope.requireFile = true;

	$scope.selectedFile = function(selected) {
		if (selected == true) {
			$scope.requireFile = false;
		} else {
			$scope.requireFile = true;
		}
	}

	var replaceString = function (str) {
        str= str.toLowerCase();  
        str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");  
        str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");  
        str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");  
        str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");  
        str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");  
        str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");  
        str= str.replace(/đ/g,"d");  
        return str; 
    }

	/* When user click add or edit category */
	$scope.submit = function (validate) {

		$scope.submitted  = true;

		// Validate
  		if(validate){
			return;
  		}

  		if ($scope.requireFile) {
			return;
		}

		var alias = replaceString($scope.categoryItem.name);

		$scope.categoryItem.alias = alias.replace(/\s+/g,'_').toLowerCase();

		$('#page-loading').css('display', 'block');

		CategoryService.createCategoryProvider($scope.categoryItem).then(function (data){
			// If name has exists
			if(data.status == 0){
				$scope.nameExists = true;
				$scope.messageNameExists = data.errors.alias[0];
			} else{
				$scope.categoryItem = data.category;
				$scope.isSavedData = true;
			}
		});

		// Check name exists
		$scope.$watch('categoryItem.name', function(newVal, oldVal) {
	        if (newVal != oldVal) {
	        	$scope.nameExists = false;
	        }
	    });
	};

	// Check file upload
	$scope.$watch('fileUploaded', function(newVal, oldVal) {
		if (angular.isDefined(newVal) && newVal.files.length != 0) {
			if ($scope.isSavedData) {
				$scope.categoryItem.fileUploaded = newVal.files;
				CategoryService.createImageCategory($scope.categoryItem).then(function (data){
					// Update successfull
					if(data.status != 0){
						window.location.href = window.baseUrl + '/admin/category';
					}
				});
			}
		}
    });

	/* When user click cancel then close modal popup */
	$scope.cancel = function () {
	    window.location.href = window.baseUrl + '/admin/category';
	};
}])
.controller('ModalEditCategoryCtrl', ['$scope', 'CategoryService', '$timeout', function ($scope, CategoryService, $timeout) {
	/* When js loaded */
	$('#page-wrapper').removeClass('hidden');
	$('#page-loading').css('display', 'none');

	$scope.initSortNumber = function () {
    	$("#sort-order").maskMoney({suffix: '', precision: 0});
    };

	/* Show categories tree */
	$timeout(function(){
		$scope.categoriesTree = angular.copy(window.categoriesTree);
	});

	$scope.requireFile = true;

	$scope.selectedFile = function(selected) {
		if (selected == true) {
			$scope.requireFile = false;
		} else {
			$scope.requireFile = true;
		}
	}

	$scope.editItem = function (isEdited) {
		if (!isEdited) return;
		window.location.href = window.baseUrl + '/admin/category';
	}

	$scope.replaceString = function (str) {  
		str= str.toLowerCase();  
		str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");  
		str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");  
		str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");  
		str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");  
		str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");  
		str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");  
		str= str.replace(/đ/g,"d");  
		return str;  
	}

	/* When user click add or edit category */
	$scope.submit = function (validate) {

		$scope.submitted  = true;

		// Validate
  		if(validate){
			return;
  		}

  		if ($scope.requireFile) {
			return;
		}

		var alias = $scope.replaceString($scope.categoryItem.name);

		$scope.categoryItem.alias = alias.replace(/\s+/g,'_').toLowerCase();

		$('#page-loading').css('display', 'block');

		CategoryService.createCategoryProvider($scope.categoryItem).then(function (data){
			// If name has exists
			if(data.status == 0){
				$scope.nameExists = true;
				$scope.messageNameExists = data.errors.alias[0];
			} else{
				$scope.isSavedData = true;
			}
		});

		// Check name exists
		$scope.$watch('categoryItem.name', function(newVal, oldVal) {
	        if (newVal != oldVal) {
	        	$scope.nameExists = false;
	        }
	    });
	};

	// Check file upload
	$scope.$watch('fileUploaded', function(newVal, oldVal) {
		if (angular.isDefined(newVal) && (newVal.files.length > 0)) {
			// Set file uploaded
			$scope.categoryItem.fileUploaded = newVal.files;
			// When user click submit
			if ($scope.submitted == true) {
				CategoryService.createCategoryProvider($scope.categoryItem).then(function (data){
					// Update successfull
					if(data.status != 0){
						window.location.href = window.baseUrl + '/admin/category';
					}
				});
			}
		}
    });

	/* When user click cancel then close modal popup */
	$scope.cancel = function () {
	    window.location.href = window.baseUrl + '/admin/category';
	};
}])
.controller('ModalDeleteCategoryCtrl', ['$scope', '$uibModalInstance', 'categoryId', 'CategoryService', 
	function ($scope, $uibModalInstance, categoryId, CategoryService) {
		/* When user click Delete category */
		$scope.submit = function () {
			$('#page-loading').css('display', 'block');
			CategoryService.deleteCategory(categoryId).then(function (){
				$('#page-loading').css('display', 'none');
				$uibModalInstance.close();
			});
		};

		/* When user click cancel then close modal popup */
		$scope.cancel = function () {
		    $uibModalInstance.dismiss('cancel');
		};
	}
]);
