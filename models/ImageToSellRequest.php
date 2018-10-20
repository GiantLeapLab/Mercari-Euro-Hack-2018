<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "image_to_sell_request".
 *
 * @property int $image_id
 * @property int $sell_request_id
 *
 * @property Image $image
 * @property SellRequest $sellRequest
 */
class ImageToSellRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'image_to_sell_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image_id', 'sell_request_id'], 'required'],
            [['image_id', 'sell_request_id'], 'integer'],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
            [['sell_request_id'], 'exist', 'skipOnError' => true, 'targetClass' => SellRequest::className(), 'targetAttribute' => ['sell_request_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'image_id' => 'Image ID',
            'sell_request_id' => 'Sell Request ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSellRequest()
    {
        return $this->hasOne(SellRequest::className(), ['id' => 'sell_request_id']);
    }
}
