<?php 
function getVersionImage(){
	return 1;
}

function getVersionScript(){
	return 1922222222222223222222222222222222222222222222222222;
}
function getVersionCss(){
	return 13;
}

function isProduction(){
   return env('APP_ENV', 'local') == 'production'? true: false;
}

function isDev(){
 return env('APP_ENV', 'local') == 'development'? true: false;
}

