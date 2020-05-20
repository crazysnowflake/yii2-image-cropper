<?php

    namespace crazysnowflake\imagecropper;

    use kartik\base\InputWidget;

    class ImageCropper  extends InputWidget
    {
    	public $model;
    	public $attribute;
    	public $templateImage = null;
    	public $templateRemove = '<i class="fas fa-times-circle"></i>';

        public function init() {
            parent::init();
        }

        public function run() {
        	$this->options['class'] = 'image-cropper-file d-none';
	        return $this->render('render', [
		        'input' => $this->getInput('fileInput'),
		        'attribute' => $this->attribute,
		        'templateImage' => $this->templateImage,
		        'templateRemove' => $this->templateRemove,
	        ]);
        }
    }
