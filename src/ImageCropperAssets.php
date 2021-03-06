<?php

    namespace crazysnowflake\imagecropper;

    class ImageCropperAssets  extends \yii\web\AssetBundle
    {

    	public $sourcePath = "@vendor/crazysnowflake/yii2-image-cropper/src";
	    public $js = [
		    'assets/js/croppie.min.js',
		    'assets/js/image-cropper.js',
	    ];
	    public $css = [
		    'assets/css/croppie.min.css',
		    'assets/css/image-cropper.css',
	    ];
	    public $depends = [
		    'yii\web\JqueryAsset'
	    ];

    }
