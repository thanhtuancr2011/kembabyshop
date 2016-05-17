/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	config.language = 'vi';
	config.uiColor = '#F7B42C';
	config.height = 300;
	config.toolbarCanCollapse = true;
	config.filebrowserBrowseUrl = '/bower_components/kcfinder/browse.php?opener=ckeditor&type=files';
   	config.filebrowserImageBrowseUrl = '/bower_components/kcfinder/browse.php?opener=ckeditor&type=images';
   	config.filebrowserFlashBrowseUrl = '/bower_components/kcfinder/browse.php?opener=ckeditor&type=flash';
   	config.filebrowserUploadUrl = '/bower_components/kcfinder/upload.php?opener=ckeditor&type=files';
   	config.filebrowserImageUploadUrl = '/bower_components/kcfinder/upload.php?opener=ckeditor&type=images';
   	config.filebrowserFlashUploadUrl = '/bower_components/kcfinder/upload.php?opener=ckeditor&type=flash';
};
