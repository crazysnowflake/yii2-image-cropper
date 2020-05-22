<?php

/**
 * @var string $id
 * @var string $input
 * @var string $attribute
 * @var string $templateImage
 * @var string $templateRemove
 * @var array $cropSize
 */

use yii\helpers\Html; ?>


<div id="<?= $id; ?>" class="image-cropper-container <?= $templateImage ? 'has-image' : ''; ?>">
    <div class="image-cropper-preview">

    </div>
	<?= Html::hiddenInput('cropdata['.$attribute.'][x]', '', ['class' => 'image-croper-cropdata-x']); ?>
	<?= Html::hiddenInput('cropdata['.$attribute.'][y]', '', ['class' => 'image-croper-cropdata-y']); ?>
	<?= Html::hiddenInput('cropdata['.$attribute.'][w]', '', ['class' => 'image-croper-cropdata-w']); ?>
	<?= Html::hiddenInput('cropdata['.$attribute.'][h]', '', ['class' => 'image-croper-cropdata-h']); ?>
	<?= Html::hiddenInput('cropdata['.$attribute.'][th_w]', $cropSize[0]); ?>
	<?= Html::hiddenInput('cropdata['.$attribute.'][th_h]', $cropSize[1]); ?>
	<?= Html::hiddenInput('cropdata['.$attribute.'][scale]', '', ['class' => 'image-croper-cropdata-scale']); ?>
	<?= Html::hiddenInput('cropdata['.$attribute.'][remove]', '', ['class' => 'image-croper-cropdata-remove']); ?>

    <label class="d-block">
        <?= $input; ?>

        <div class="image-cropper-upload-msg">
		   <span><?= Yii::t('app', 'Please click on the field to select the picture section'); ?></span>
	        <?= $templateImage ? $templateImage : ''; ?>
        </div>
        <span class="btn btn-sm btn-primary w-100 image-cropper-change-image"><?= Yii::t('app', 'Change image'); ?></span>
        <span class="btn btn-sm btn-primary w-100 image-cropper-select-image"><?= Yii::t('app', 'Select image'); ?></span>
    </label>
    <span class="image-cropper-remove-image">
       <?= $templateRemove; ?>
    </span>
</div>
