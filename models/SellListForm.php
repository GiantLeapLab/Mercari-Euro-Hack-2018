<?php

namespace app\models;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\Point;
use yii\base\Model;
use yii\web\UploadedFile;

class SellListForm extends Model
{
    public $images = [];
    public $items = [];

    const IMAGE_PATH = './uploads/';

    public function rules()
    {
        return [
            [['images', 'items'], 'safe']
        ];
    }

    public function prepareData()
    {
        $result = [];
        $images = [];
        $imagine = new Imagine();
        $this->images = UploadedFile::getInstances($this, 'images');

        foreach ($this->images as $image) {
            $imageName = uniqid() . $image->extension;
            $image->saveAs(self::IMAGE_PATH . $imageName);
            $images[] = $imageName;
        }


        foreach ($this->items as $item) {
            $image_name = $item['x'] . 'x' . $item['y'] . '_' . $item['height'] . 'x' . $item['width'] . $images[$item['imageIndex']];
            $imagine->open(self::IMAGE_PATH . $images[$item['imageIndex']])
                ->crop(new Point($item['x'], $item['y']), new Box($item['height'], $item['width']))
                ->save(self::IMAGE_PATH . $image_name);

            $model = new SellRequest();
            $model->title = $item['class'];
            $model->imageName = self::IMAGE_PATH . $image_name;
            $result[] = $model;
        }

        return $result;
    }
}
