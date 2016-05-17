<div id="page-loading" style="display: block" class="overlay-loading">
    <div class="spin-box"></div>
</div>

{!! Html::script('bower_components/jquery/dist/jquery.min.js')!!}

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
{!! Html::script('bower_components/jquery.maskedinput/dist/jquery.maskedinput.min.js')!!}
{!! Html::script('bower_components/mask-money/dist/jquery.maskMoney.js')!!}
{!! Html::script('bower_components/mask-money/dist/jquery.maskMoney.min.js')!!}

<!-- My Angular js File -->
{!! Html::script('app/components/back-end/app.js')!!}
{!! Html::script('app/components/back-end/config.js')!!}

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
</script>

<!-- Bootstrap Core JavaScript -->
{!!Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js')!!}

<!-- Metis Menu Plugin JavaScript -->
{!!Html::script('bower_components/metisMenu/dist/metisMenu.min.js')!!}

<!-- Custom Theme JavaScript -->
{!!Html::script('js/sb-admin-2.js')!!}

@yield('script')



    