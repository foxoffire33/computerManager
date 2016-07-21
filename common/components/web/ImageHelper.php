<?php
/**
 * Created by PhpStorm.
 * User: reinier
 * Date: 05-07-16
 * Time: 10:08
 */

namespace common\components\web;

use Imagine\Gd;
use Imagine\Image\Box;
use yii\imagine\Image;

/**
 * Class ImageHelper
 * @package common\components\web
 * je moet het volgende paket toeveoegen aan composer "yiisoft/yii2-imagine": "*"
 */
class ImageHelper
{

    //settings
    private $imageFolder;
    private $imageTempFolder;
    private $tumpHeight = 360;
    private $tumpWidth = 1024;

    /**
     * ImageHelper constructor.
     * @param $imageName Array(String), String
     * als imageFilder en ImageTumpFolder niet gezet zijn wordt de default gebruikt
     * @param null $imageFolder
     * @param null $imageTempFolder
     */
    public function __construct($imageName, $imageFolder = null, $imageTempFolder = null)
    {
        if (!is_null($imageFolder)) {
            $this->imageFolder = $imageFolder;
        } else {
            $this->imageFolder = \Yii::getAlias('@frontend/themes/moderna/AssetsBundel') . '/img/slides/';
        }
        if (!is_null($imageFolder)) {
            $this->imageTempFolder = $imageTempFolder;
        } else {
            $this->imageTempFolder = \Yii::getAlias('@frontend/themes/moderna/AssetsBundel') . '/img/';
        }

        if (is_array($imageName)) {
            $returnArray = [];
            foreach ($imageName as $image) {
                $returnArray[] = $this->chackFileTump($image);
            }
        } elseif (is_string($imageName)) {
            return $this->chackFileTump($imageName);
        }

    }

    /**
     * hier wodt gekeken of de afbeelding bestaand en wordt er een tump van gemaakt.
     * Als de tump albestaad dan wordt er geen tump aangemaakt
     * @param $imageName
     * @return string
     */
    private function chackFileTump($imageName)
    {
        if (file_exists($this->imageFolder . $imageName)) {
            if (!file_exists($this->imageTempFolder . $imageName)) {
                Image::getImagine()->open($this->imageFolder . $imageName)->thumbnail(new Box($this->tumpWidth, $this->tumpHeight))->save($this->imageTempFolder . $imageName, ['quality' => 70]);
                return $this->imageTempFolder . $imageName;
            }
        }
    }
}