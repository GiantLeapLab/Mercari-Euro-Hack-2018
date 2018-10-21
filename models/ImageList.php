<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "image".
 *
 * @property int $id
 * @property string $path
 *
 * @property CategoryToImage[] $categoryToImages
 * @property ImageToBuyRequest[] $imageToBuyRequests
 * @property ImageToSellRequest[] $imageToSellRequests
 */
class ImageList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path'], 'required'],
            [['path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryToImages()
    {
        return $this->hasMany(CategoryToImage::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageToBuyRequests()
    {
        return $this->hasMany(ImageToBuyRequest::className(), ['image_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImageToSellRequests()
    {
        return $this->hasMany(ImageToSellRequest::className(), ['image_id' => 'id']);
    }

    public function getImageUrl($thumb = false)
    {
       return '';
    }
}
