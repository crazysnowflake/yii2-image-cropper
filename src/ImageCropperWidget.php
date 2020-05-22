<?php

    namespace crazysnowflake\imagecropper;

    use kartik\base\InputWidget;
    use Yii;

    class ImageCropperWidget  extends InputWidget
    {
    	public $model;
    	public $attribute;
    	public $pluginOptions = [];
    	public $templateImage = null;
    	public $templateRemove = '<i class="fas fa-times-circle"></i>';
	    public $cropSize = [200, 200];

	    public function init() {
            parent::init();
        }

        public function run() {
	        $this->prepareOptions()
	             ->registerJs()
	             ->registerCss();

        	$this->options['class'] = 'image-cropper-file d-none';
	        return $this->render('render', [
		        'input' => $this->getInput('fileInput'),
		        'id'    => $this->getId(),
		        'attribute' => $this->attribute,
		        'pluginOptions' => $this->pluginOptions,
		        'templateImage' => $this->templateImage,
		        'templateRemove' => $this->templateRemove,
		        'cropSize'       => $this->cropSize,
	        ]);
        }
        protected function prepareOptions(){
	        $this->pluginOptions = array_merge([
		        "viewport" => [
			        "width" => 200,
			        "height" => 200
		        ]
	        ], $this->pluginOptions);
	        if(!isset($this->pluginOptions['boundary'])){
		        $this->pluginOptions['boundary'] = [
			        "height" => $this->pluginOptions['viewport']['height']
		        ];
	        }
	        return $this;
        }

	    /**
	     * @return ImageCropperWidget
	     */
	    protected function registerJs()
	    {
	    	if( $this->pluginOptions ) {
			    $id      = $this->getId();
			    $options = \yii\helpers\Json::htmlEncode($this->pluginOptions);
		    $js          = <<<SCRIPT
jQuery('#{$id}').data('imageCropperOptions', {$options});
SCRIPT;
		    Yii::$app->view->registerJs( $js, \yii\web\View::POS_READY );
			}
		    return $this;
	    }
	    /**
	     * @return ImageCropperWidget
	     */
	    protected function registerCss()
	    {
	    	if( $this->pluginOptions ) {
			    $id      = $this->getId();
			    $height  = $this->pluginOptions['viewport']['height'];
			    $width  = $this->pluginOptions['viewport']['width'];

			    $css = <<<STYLE
#{$id}.image-cropper-container .image-cropper-upload-msg {
    height: {$height}px;
}
#{$id}.image-cropper-container .image-cropper-upload-msg img{
    width: {$width}px;
}
STYLE;
			    Yii::$app->view->registerCss($css);

			}
		    return $this;
	    }
    }
