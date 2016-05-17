<?php 
function getVersionImage(){
	return 1;
}

function getVersionScript(){
	return 15;
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

