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

// CATEGORY FILTER 
$('.slider-range-price').each(function(){
    Number.prototype.format = function(n, x) {
        var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
        return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
    };
    var min             = $(this).data('min');
    var max             = $(this).data('max');
    var unit            = $(this).data('unit');
    var value_min       = $(this).data('value-min');
    var value_max       = $(this).data('value-max');
    var label_reasult   = $(this).data('label-reasult');
    var t               = $(this);
    $( this ).slider({
        range: true,
        min: min,
        max: max,
        values: [value_min, value_max],
        slide: function(event, ui) {
            $scope.products = [];
            angular.forEach(window.products, function(value, key) {
                if (value.price >= ui.values[0] && value.price <= ui.values[1]) {
                    $scope.products.push(value);
                }
            })
            $scope.$apply();
            var result = label_reasult + " " + ui.values[0].format() + ' ' + unit + ' - ' + ui.values[1].format() + ' ' +unit ;
            t.closest('.slider-range').find('.amount-range-price').html(result);
        }
    });
})



