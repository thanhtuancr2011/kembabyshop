productApp.controller('ProductController', ['$scope', '$uibModal', '$filter', 'ngTableParams', 'ProductService', function ($scope, $uibModal, $filter, ngTableParams, ProductService) {
	/* When js didn't  loaded then hide table products */
	$('.container-fluid').removeClass('hidden');
	$('#page-loading').css('display', 'none');

	/* Not show search in table products */
	$scope.isSearch = false;

	/* Set data products to scope */
	$scope.data = ProductService.setProducts(angular.copy(window.products));

	/* Lists map id with name of category */
	$scope.listCategories = window.listsMapCategories;

	/* Use ng-table for table products */
	$scope.tableParams = new ngTableParams({
        page: 1,
        count: 10,
        filter: {
            name: ''
        },
        sorting: {
            name: 'asc'
        }

    }, {
        total: $scope.data.length,
        getData: function ($defer, params) {
        	var orderedData = params.filter() ? $filter('filter')($scope.data, params.filter()) : $scope.data;       /* Filter products */
        	orderedData = params.sorting() ? $filter('orderBy')(orderedData, params.orderBy()) : orderedData;        /* Sort products */
            $defer.resolve(orderedData.slice((params.page() - 1) * params.count(), params.page() * params.count())); /* Paging */
        }
    })

	$scope.createProduct = function(){
		var template = '/admin/product/create?v=' + new Date().getTime();  /* Create product */
		window.location.href = window.baseUrl + template;
	};

	/**
	 * Edit product
	 * @author Thanh Tuan <thanhtuancr2011@gmail.com>
	 * @param  {Int} id ProductId
	 * @return {Void}    
	 */
	$scope.editProduct = function(id) {
		var template = '/admin/product/'+ id + '/edit?v=' + new Date().getTime(); /* Edit product */
		window.location.href = window.baseUrl + template;
	}

	/* Delete product */
	$scope.removeProduct = function(id, size){
		var template = '/app/components/back-end/products/view/DeleteProduct.html?v=' + new Date().getTime();  /* Delete product */
		var modalInstance = $uibModal.open({
		    animation: $scope.animationsEnabled,
		    templateUrl: window.baseUrl + template,
		    controller: 'ModalDeleteProductCtrl',
		    size: size,
		    resolve: {
		    	productId: function(){
		            return id;
		        }
		    }
		    
		});

		/* After create or edit product then reset product and reload ng-table */
		modalInstance.result.then(function (data) {
			$scope.data = ProductService.getProducts();
			$scope.tableParams.reload();
		}, function () {

		   });
	};

}])
.controller('ModalCreateProductCtrl', ['$scope', 'ProductService', '$timeout', 'Upload', function ($scope, ProductService, $timeout, Upload) {
	
	/* Show categories tree */
	$timeout(function(){
		$('.container-fluid').removeClass('hidden');
		$('#page-loading').css('display', 'none');
		$scope.categoriesTree = angular.copy(window.categoriesTree);
		var editor = CKEDITOR.replace('description');
	});

    /* Validate category */
	$scope.requiredCategory = true;
	$scope.chooseCategory = function (categoryId) {
		if (angular.isDefined(categoryId)) {
			$scope.requiredCategory = false;
		}
	}

	/* Validate description */
	$scope.requiredDescription = true;
	CKEDITOR.on("instanceCreated", function(event) {
	    event.editor.on("change", function () {
	    	$timeout(function(){
	    		if (event.editor.getData() != '') {
		        	$scope.requiredDescription = false;
		        	$scope.productItem.description = event.editor.getData();
		        } else {
		        	$scope.requiredDescription = true;
		        }
	    	});
	    });
	});

	// Format number
	$('input[name=price]').mask('000,000,000,000', {reverse: true});
	$('input[name=old_price]').mask('000,000,000,000', {reverse: true});
	$('input[name=availibility]').mask('000,000,000,000', {reverse: true});
	$('input[name=weight]').mask('000,000,000,000', {reverse: true});

	$scope.requireFile = true;

	/* When user click add or edit product */
	$scope.submit = function (validate) {

		$scope.submitted = true;

		// Check choose category
		if (!$scope.requiredCategory && !$scope.requiredDescription && !validate && !$scope.requireFile) {
			
			$('#page-loading').css('display', 'block');

			ProductService.createProductProvider($scope.productItem).then(function (data){
				// If name has exists
				if(data.status == 0){
					$scope.nameExists = true;
					$scope.messageNameExists = data.errors.alias[0];
				} else{
					$scope.productItem = data.product;
					// Call function upload indirective
					$scope.$broadcast('upload');
				}
			});
		}
	};

	// After directive upload file success
	$scope.$on('uploadSuccess', function(event, args) {

	    var allFiles = args.files;
	    $scope.productItem.fileUploaded = allFiles;

	    ProductService.createImageProduct($scope.productItem).then(function (data){
			// Update successfull
			if(data.status != 0){
				window.location.href = window.baseUrl + '/admin/product';
			}
		});
	});

	/* Event when user choose files or delete all files */
	$scope.$on('isNotChooseFile', function (event, args) {
		$scope.requireFile = args.val;
	});

	/* When user click cancel then close modal popup */
	$scope.cancel = function () {
		window.location.href = window.baseUrl + '/admin/product';
	};

}])
.controller('ModalEditProductCtrl', ['$scope', 'ProductService', '$timeout', 'Upload', function ($scope, ProductService, $timeout, Upload) {
	
	/* Show categories tree */
	$timeout(function(){
		
		$('.container-fluid').removeClass('hidden');
		$('#page-loading').css('display', 'none');
		$scope.categoriesTree = angular.copy(window.categoriesTree);
		var editor = CKEDITOR.replace('description');

		// Format number
		$('input[name=price]').mask('000,000,000,000', {reverse: true});
		$('input[name=old_price]').mask('000,000,000,000', {reverse: true});
		$('input[name=availibility]').mask('000,000,000,000', {reverse: true});
		$('input[name=weight]').mask('000,000,000,000', {reverse: true});
	});

	// Event on change ck editor
	CKEDITOR.on("instanceCreated", function(event) {
	    event.editor.on("change", function () {
	    	$timeout(function(){
	    		if (event.editor.getData() != '') {
		        	$scope.requiredDescription = false;
		        	$scope.productItem.description = event.editor.getData();
		        } else {
		        	$scope.requiredDescription = true;
		        	$scope.productItem.description = '';
		        }
	    	});
	    });
	});

	/* Set scope required */
	$scope.requiredCategory = false;
	$scope.requiredDescription = true;
	$scope.requireFile = true;

	/* If not choose category */
	$scope.chooseCategory = function (categoryId) {
		if (angular.isDefined(categoryId)) {
			$scope.requiredCategory = false;
		}
	}

	/* When user click add or edit product */
	$scope.submit = function (validate) {

		$scope.submitted  = true;

		// Check choose category
		if (!$scope.requiredCategory && !$scope.requiredDescription && !validate && !$scope.requireFile) {

			$('#page-loading').css('display', 'block');

			ProductService.createProductProvider($scope.productItem).then(function (data){
				// If name has exists
				if(data.status == 0){

					$scope.nameExists = true;
					$scope.messageNameExists = data.errors.alias[0];
				} else{
					$scope.productItem = data.product;

					// Call function upload indirective
					$scope.$broadcast('upload');
				}
			});
		}
	};

    /* After directive upload file success */
	$scope.$on('uploadSuccess', function(event, args) {

	    var allFiles = args.files;
	    $scope.productItem.fileUploaded = allFiles;

	    ProductService.createProductProvider($scope.productItem).then(function (data){
			// Update successfull
			if(data.status != 0){
				window.location.href = window.baseUrl + '/admin/product';
			}
		});
	});

	/* Event when user choose files or delete all files */
	$scope.$on('isNotChooseFile', function (event, args) {
		$scope.requireFile = args.val;
	});

	/* Event when delete file */
	$scope.filesDeleted = [];
	$scope.$on('fileDeleted', function (event, args) {
		$scope.filesDeleted.push(args.id);
	});

	/* When user click cancel then close modal popup */
	$scope.cancel = function () {
		window.location.href = window.baseUrl + '/admin/product';
	};

}])
.controller('ModalDeleteProductCtrl', ['$scope', '$uibModalInstance', 'productId', 'ProductService', 
	function ($scope, $uibModalInstance, productId, ProductService) {
		/* When user click Delete product */
		$scope.submit = function () {
			$('#page-loading').css('display', 'block');
			ProductService.deleteProduct(productId).then(function (){
				$('#page-loading').css('display', 'none');
				$uibModalInstance.close();
			});
		};

		/* When user click cancel then close modal popup */
		$scope.cancel = function () {
		    $uibModalInstance.dismiss('cancel');
		};
	}
])
.directive('stringToNumber', function() {
  	return {
	    require: 'ngModel',
	    link: function(scope, element, attrs, ngModel) {
	      	ngModel.$parsers.push(function(value) {
	        	return '' + value;
	      	});
	      	ngModel.$formatters.push(function(value) {
	        	return parseFloat(value, 10);
	      	});
	    }
  	};
});
