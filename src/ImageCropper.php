<?php

    namespace crazysnowflake\imagecropper;


    class ImageCropper
    {
	    /**
	     * @param $sourceImagePath
	     * @param $thumbnailImagePath
	     * @param $params
	     * @param int $degrees
	     * @return bool
	     */
	    public static function cropImageSection($sourceImagePath, $thumbnailImagePath, $params, $degrees = 0)
	    {
		    if (file_exists($sourceImagePath) && is_file($sourceImagePath)) {
			    $rotate = 0;
			    $imageSizes = getimagesize($sourceImagePath);
			    $sourceGDImage = null;
			    /*
				 * $imageSizes[0] - original image width
				 * $imageSizes[1] - original image height
				 */
			    $sourceImageType = isset($imageSizes[2]) ? $imageSizes[2] : 0;
			    $sourceGDImage = self::imageCreateFrom($sourceImageType, $sourceImagePath);
			    if ($sourceGDImage === false) {
				    return false;
			    }
			    if (array_key_exists('degrees', $params))
				    $degrees = isset($params['degrees']) && $params['degrees'] == 270 ? 90 : ($params['degrees'] == 90 ? 270 : $params['degrees']);

			    $thumbnailGDImage = imagecreatetruecolor($params['th_w'], $params['th_h']);
			    if (isset($degrees))
				    $rotate = imagerotate($sourceGDImage, $degrees * -1, 0);
			    // Set transparate
			    if ($sourceImageType == IMAGETYPE_PNG || $sourceImageType == IMAGETYPE_GIF) {
				    imagealphablending($thumbnailGDImage, false);
				    imagesavealpha($thumbnailGDImage, true);
				    $transparent = imagecolorallocatealpha($thumbnailGDImage, 255, 255, 255, 127);
				    imagefilledrectangle($thumbnailGDImage, 0, 0, $params['width'], $params['height'], $transparent);
			    }

			    imagecopyresampled(
				    $thumbnailGDImage,
				    $rotate,
				    0,
				    0,
				    (int)$params['x'],
				    (int)$params['y'],
				    (int)$params['th_w'],
				    (int)$params['th_h'],
				    (int)$params['w']-$params['x'],
				    (int)$params['h']-$params['y']
			    );

			    imagedestroy($sourceGDImage);
			    self::image($sourceImageType, $thumbnailGDImage, $thumbnailImagePath);
			    imagedestroy($thumbnailGDImage);
			    return true;
		    }
		    return false;
	    }

	    /**
	     * @param $sourceImageType
	     * @param $sourceImagePath
	     * @return bool|resource
	     */
	    private static function imageCreateFrom($sourceImageType, $sourceImagePath)
	    {
		    $sourceGDImage = false;
		    switch ($sourceImageType) {
			    case IMAGETYPE_GIF:
				    $sourceGDImage = imagecreatefromgif($sourceImagePath);
				    break;
			    case IMAGETYPE_JPEG:
				    $sourceGDImage = imagecreatefromjpeg($sourceImagePath);
				    break;
			    case IMAGETYPE_PNG:
				    $sourceGDImage = imagecreatefrompng($sourceImagePath);
				    break;
		    }
		    return $sourceGDImage;
	    }

	    /**
	     * @param $sourceImageType
	     * @param $thumbnailGDImage
	     * @param $thumbnailImagePath
	     * @return bool
	     */
	    private static function image($sourceImageType, $thumbnailGDImage, $thumbnailImagePath)
	    {
		    $result = false;
		    switch ($sourceImageType) {
			    case IMAGETYPE_GIF:
				    $result = imagegif($thumbnailGDImage, $thumbnailImagePath);
				    break;
			    case IMAGETYPE_JPEG:
				    $result = imagejpeg($thumbnailGDImage, $thumbnailImagePath, 100);
				    break;
			    case IMAGETYPE_PNG:
				    $result = imagepng($thumbnailGDImage, $thumbnailImagePath, 9);
				    break;
		    }
		    return $result;
	    }
    }
