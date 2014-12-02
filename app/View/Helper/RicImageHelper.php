<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RicImage
 *
 * @author manu
 */
App::uses('AppHelper', 'View/Helper');

class RicImageHelper extends AppHelper {

    public $helpers = array('Html');

    public function image($image,$displaySize = '') {


        if ($image != null) {
            
            extract($image);

            //$srcResizedFile = '/medias/' . $category . '/' . $dir . '/' . $displaySize . '_' . $file;
            $dir=(empty($dir))?'':'/'.$dir;
             $srcResizedFile = '/medias/'.strtolower($category) . $dir . '/' . $displaySize . '_' . $file;
           
            $rootResizedSrcFile = WWW_ROOT . $srcResizedFile;
            if (file_exists($rootResizedSrcFile)) {
                $image = $this->Html->image('..' . $srcResizedFile, array('class' => $displaySize));
              //  return $image;
            } else {
                if (!empty($displaySize)) {
                    //cf Upload plugin _resizePhp
                    //utilisation de php
                   // $srcFile = WWW_ROOT .'/medias/' . $category . '/' . $dir . '/'. $file;
                   //$srcFile = WWW_ROOT .'medias' .DS. $category . DS . $dir . $file;
                   $srcFile = WWW_ROOT .'medias/' . strtolower($category) . $dir . '/'. $file;
                    $imagesResizing = (array) Configure::read('ImagesResizing');
                    $geometry= $imagesResizing[$displaySize];
                    $pathInfo = pathinfo($file);
                    debug($pathInfo);
                    $thumbnailType = $pathInfo['extension'];
                    if (!$thumbnailType) {
			$thumbnailType = 'png';
                    }
                    
                    
                $supportsThumbnailQuality = false;
		$adjustedThumbnailQuality = 75 ;
		switch (strtolower($thumbnailType)) {
			case 'gif':
				$outputHandler = 'imagegif';
				break;
			case 'jpg':
			case 'jpeg':
				$outputHandler = 'imagejpeg';
				$supportsThumbnailQuality = true;
				break;
			case 'png':
				$outputHandler = 'imagepng';
				$supportsThumbnailQuality = true;
				// convert 0 (lowest) - 100 (highest) thumbnailQuality, to 0 (highest) - 9 (lowest) quality (see http://php.net/manual/en/function.imagepng.php)
				$adjustedThumbnailQuality = intval((100 - $adjustedThumbnailQuality)/ 100 * 9);
                                
				break;
			default:
				return false;
		}
                
		switch (strtolower($pathInfo['extension'])) {
			case 'gif':
				$src = imagecreatefromgif($srcFile);
                               
				break;
			case 'jpg':
			case 'jpeg':

				$src = imagecreatefromjpeg($srcFile);
				break;
			case 'png':
				$src = imagecreatefrompng($srcFile);
				break;
			default:
			
		}
                
                if ($src) {

			$srcW = imagesx($src);
			$srcH = imagesy($src);
                      //  debug($srcH);
                 if (preg_match('/^\\[[\\d]+x[\\d]+\\]$/', $geometry)) {
				// resize with banding
				list($destW, $destH) = explode('x', substr($geometry, 1, strlen($geometry) - 2));
				$resizeMode = 'band';
			} elseif (preg_match('/^[\\d]+x[\\d]+$/', $geometry)) {
				// cropped resize (best fit)
				list($destW, $destH) = explode('x', $geometry);
				$resizeMode = 'best';
			} elseif (preg_match('/^[\\d]+w$/', $geometry)) {
				// calculate heigh according to aspect ratio
				$destW = (int)$geometry;
				$resizeMode = false;
			} elseif (preg_match('/^[\\d]+h$/', $geometry)) {
				// calculate width according to aspect ratio
				$destH = (int)$geometry;
				$resizeMode = false;
			} elseif (preg_match('/^[\\d]+l$/', $geometry)) {
				// calculate shortest side according to aspect ratio
				if ($srcW > $srcH) {
					$destW = (int)$geometry;
				} else {
					$destH = (int)$geometry;
				}
				$resizeMode = false;
			} elseif (preg_match('/^[\\d]+mw$/', $geometry)) {
				// calculate heigh according to aspect ratio
				if ((int)$geometry < $srcW) {
					$destW = (int)$geometry;
				} else {
					$destW = $srcW;
				}
				$resizeMode = false;
			} elseif (preg_match('/^[\\d]+mh$/', $geometry)) {
				// calculate width according to aspect ratio
				if ((int)$geometry < $srcH) {
					$destH = (int)$geometry;
				} else {
					$destH = $srcH;
				}
				$resizeMode = false;
			} elseif (preg_match('/^[\\d]+ml$/', $geometry)) {
				// calculate shortest side according to aspect ratio
				if ($srcW > $srcH) {
					if ((int)$geometry < $srcW) {
						$destW = (int)$geometry;
					} else {
						$destW = $srcW;
					}
				} else {
					if ((int)$geometry < $srcH) {
						$destH = (int)$geometry;
					} else {
						$destH = $srcH;
					}
				}
				$resizeMode = false;
			}

			if (!isset($destW)) {
				$destW = ($destH / $srcH) * $srcW;
			}

			if (!isset($destH)) {
				$destH = ($destW / $srcW) * $srcH;
			}

			// determine resize dimensions from appropriate resize mode and ratio
			if ($resizeMode == 'best') {
				// "best fit" mode
				if ($srcW > $srcH) {
					if ($srcH / $destH > $srcW / $destW) {
						$ratio = $destW / $srcW;
					} else {
						$ratio = $destH / $srcH;
					}
				} else {
					if ($srcH / $destH < $srcW / $destW) {
						$ratio = $destH / $srcH;
					} else {
						$ratio = $destW / $srcW;
					}
				}
				$resizeW = $srcW * $ratio;
				$resizeH = $srcH * $ratio;
			} elseif ($resizeMode == 'band') {
				// "banding" mode
				if ($srcW > $srcH) {
					$ratio = $destW / $srcW;
				} else {
					$ratio = $destH / $srcH;
				}
				$resizeW = $srcW * $ratio;
				$resizeH = $srcH * $ratio;
			} else {
				// no resize ratio
				$resizeW = $destW;
				$resizeH = $destH;
			}       
                        $img = imagecreatetruecolor($destW, $destH);
			imagealphablending($img, false);
			imagesavealpha($img, true);
			imagefill($img, 0, 0, imagecolorallocate($img, 255, 255, 255));
			imagecopyresampled($img, $src, ($destW - $resizeW) / 2, ($destH - $resizeH) / 2, 0, 0, $resizeW, $resizeH, $srcW, $srcH);

			if ($supportsThumbnailQuality) {
				$outputHandler($img, $rootResizedSrcFile, $adjustedThumbnailQuality);
			} else {
				$outputHandler($img, $rootResizedSrcFile);
			}
                        $image = $this->Html->image('..' . $srcResizedFile, array('class' => $displaySize));
                }
		 
                }
            }
        }
        
        return $image;
    }
    

}
