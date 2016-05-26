var defaultModules = 
[
	'ui.bootstrap',
	'ngResource',
	'ngSanitize',
	'masterApp',
	'homeApp',
	'productApp',
	'categoryApp',
	'CartApp',
	'CustomerApp',
    'searchApp'
];

if(typeof modules != 'undefined'){
	defaultModules = defaultModules.concat(modules);
}
angular.module('shop-front-end', defaultModules);
window.fbAsyncInit = function() {
    FB.init({
        appId      : '1566345896991188',
        xfbml      : true,
        version    : 'v2.6'
    });
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));




