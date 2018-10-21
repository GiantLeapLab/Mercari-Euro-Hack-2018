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

        foreach ($this->images as $data) {
            if (preg_match('/^data:image\/([\w-]+);base64,/', $data)) {
                $data = substr($data, strpos($data, ',') + 1);
                $data = base64_decode($data);
            } else {
                throw new \Exception('did not match data URI with image data');
            }

            $fileName = uniqid() . '.jpeg';
            $images[] = $fileName;
            file_put_contents(self::IMAGE_PATH . $fileName, $data);
        }


        foreach ($this->items as $item) {
            $image_name = $item['x'] . 'x' . $item['y'] . '_' . $item['width'] . 'x' . $item['height'] . $images[$item['image']];
            $imagine->open(self::IMAGE_PATH . $images[$item['image']])
                ->crop(new Point($item['x'], $item['y']), new Box($item['width'], $item['height']))
                ->save(self::IMAGE_PATH . $image_name);

            $model = new SellRequest();
            $model->title = $item['class'];
            $model->imageName = '/uploads/' . $image_name;
            $result[] = $model;
        }

        return $result;
    }
}
