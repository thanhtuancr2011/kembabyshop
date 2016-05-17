<div id="page-loading" style="display: block" class="overlay-loading">
  	<div class="spin-box"></div>
</div>

{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}

{!! Html::script('assets/lib/bootstrap/js/bootstrap.min.js')!!}

{!! Html::script('bower_components/jquery-ui/jquery-ui.min.js')!!}  
{!! Html::script('bower_components/angular/angular.min.js')!!}  
{!! Html::script('bower_components/fancytree/dist/jquery.fancytree-all.min.js')!!}
{!! Html::script('bower_components/angular-resource/angular-resource.js')!!}
{!! Html::script('bower_components/angular-bootstrap/ui-bootstrap.min.js')!!}
{!! Html::script('bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js')!!}
{!! Html::script('bower_components/ng-table/dist/ng-table.min.js')!!}
{!! Html::script('bower_components/ngImgCrop/source/js/init.js')!!}
{!! Html::script('bower_components/ngImgCrop/source/js/ng-img-crop.js')!!}
{!! Html::script('bower_components/ngImgCrop/compile/minified/ng-img-crop.js')!!}
{!! Html::script('bower_components/angular-cookies/angular-cookies.js')!!}
{!! Html::script('bower_components/angular-xeditable/dist/js/xeditable.js') !!}
{!! Html::script('bower_components/angular-sanitize/angular-sanitize.js')!!}
{!! Html::script('bower_components/momentjs/min/moment.min.js')!!}
{!! Html::script('bower_components/momentjs/min/locales.min.js')!!}
{!! Html::script('bower_components/humanize-duration/humanize-duration.js')!!}      
{!! Html::script('bower_components/angular-timer/dist/angular-timer.js')!!}
{!! Html::script('bower_components/angular-ui-utils/modules/mask/mask.js')!!}

<!-- My Angular js File -->
{!! Html::script('app/components/front-end/app.js')!!}
{!! Html::script('app/components/front-end/config.js')!!}
{!! Html::script('app/baseController.js')!!}

<!-- Angular switch bootstrap -->
{!! Html::script('bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js')!!}

<!-- jquery spectrum color picker -->
{!!Html::script('bower_components/spectrum/spectrum.js')!!}

<!-- jquery  select 2 -->
{!!Html::script('bower_components/select2/dist/js/select2.min.js')!!}

<!-- jquery highcharts -->
{!!Html::script('bower_components/highcharts/highcharts.js')!!}

<!-- flow js  -->
{!!Html::script('bower_components/ng-flow/dist/ng-flow-standalone.min.js')!!}
{!!Html::script('bower_components/flow.js/dist/flow.min.js')!!}
{!!Html::script('bower_components/ng-flow/dist/ng-flow.min.js')!!}

<!-- upload js  -->
{!! Html::script('bower_components/ng-file-upload/ng-file-upload-all.min.js')!!}
{!! Html::script('bower_components/ng-file-upload/ng-file-upload-shim.min.js')!!}

<script type="text/javascript">

    window.baseUrl = '{{URL::to("")}}';
    window.carts = {!! json_encode(getCarts()) !!};
    window.priceTotal = {!! json_encode(getPriceTotal()) !!};
    window.numberItem = {!! json_encode(getNumberItem()) !!};
    window.categories = {!! json_encode(getCategories()) !!};

</script>

{!!Html::script('assets/lib/jquery.bxslider/jquery.bxslider.min.js')!!}
{!!Html::script('assets/lib/owl.carousel/owl.carousel.min.js')!!}
{!!Html::script('assets/lib/jquery.countdown/jquery.countdown.min.js')!!}
{!!Html::script('assets/js/jquery.actual.min.js')!!}
{!!Html::script('assets/js/theme-script.js')!!}
{!!Html::script('assets/lib/jquery.elevatezoom.js')!!}
{!!Html::script('assets/lib/fancyBox/jquery.fancybox.js')!!}


{!! Html::script('app/components/front-end/cart/CartService.js?v='.getVersionScript())!!}
{!! Html::script('app/components/front-end/master/MasterService.js?v='.getVersionScript())!!}
{!! Html::script('app/components/front-end/master/MasterController.js?v='.getVersionScript())!!}

@yield('script')



