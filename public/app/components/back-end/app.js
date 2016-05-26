
var defaultModules = 
[
	'ui.bootstrap',
	'ngResource',
	'ngFileUpload',
	'ngImgCrop',
	'ngTable',
	'xeditable',
	'AppUser',
	'ProductApp',
	'CategoryApp',
	'OrderApp',
	'AppUserProfile',
	'selectLevelCategory',
	'file'
];

if(typeof modules != 'undefined'){
	defaultModules = defaultModules.concat(modules);
}
angular.module('shop', defaultModules);
angular.module('shop').run(['editableOptions',function(editableOptions) {
  	editableOptions.theme = 'bs3';
}]);



