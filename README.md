# yii2-image-cropper


## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/). Check the [composer.json](https://github.com/crazysnowflake/yii2-image-cropper/blob/master/composer.json) for this extension's requirements and dependencies. Read this [web tip /wiki](http://webtips.krajee.com/setting-composer-minimum-stability-application/) on setting the `minimum-stability` settings for your application's composer.json.

To install, either run

```
$ php composer.phar require crazysnowflake/yii2-image-cropper "^1.0@dev"
```

or add

```
"crazysnowflake/yii2-image-cropper": "^1.0@dev"
```

to the `require` section of your `composer.json` file.

## Release Changes

> NOTE: Refer the [CHANGE LOG](https://github.com/crazysnowflake/yii2-image-cropper/blob/master/CHANGE.md) for details on changes to various releases.


## Usage

```php
use crazysnowflake\imagecropper\ImageCropperWidget;

$form = ActiveForm::begin( [
        'id'                   => 'edit-profile',
        'options'              => [ 'enctype' => 'multipart/form-data' ],
        'fieldConfig'          => [
            'inputOptions' => [ 'class' => 'form-control form-control-lg' ]
        ],
    ] );
    
echo $form->field( $model, 'virtualImage' )
          ->widget( ImageCropperWidget::classname(), [
                'options'       => [
                    'id'       => 'user-avatar',
                    'accept'   => 'image/*',
                    'multiple' => false,
                ],
                'templateImage' => $model->avatar ? \yii\helpers\Html::img( $model->avatar ) : null,
            ] )->label( 'Profile Image' )->hint( 'We recommend a square image for best results. The ideal size would be 200px wide by 200px high.', [ 'class' => 'hint-block text-muted' ] ); ?>

ActiveForm::end();
```

#####Your controller function:
    
```php
use crazysnowflake\imagecropper\ImageCropper;

 
protected function saveImageProfile() {
    $this->virtualImageProfile = UploadedFile::getInstance($this, 'virtualImageProfile');
    
    if ($this->virtualImageProfile && $this->virtualImageProfile->type === 'image/jpeg') {    
        $data = Yii::$app->request->post( 'cropdata' );
        if( $data && isset($data['virtualImageProfile']) && $data['virtualImageProfile'] ){
            ImageCropper::cropImageSection($this->virtualImageProfile->tempName, $this->virtualImageProfile->tempName, $data['virtualImageProfile']);
        }
        $filename = uniqid() . '.' . $this->virtualImageProfile->extension;
        $this->virtualImageProfile->saveAs(Yii::getAlias('@app') . "/web/uploads/users/" . $filename);
    
    }
}
```

## License

**yii2-image-cropper** is released under the MIT License. See the bundled `LICENSE.md` for details.
