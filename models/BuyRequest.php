<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "buy_request".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property double $min_price
 * @property double $max_price
 * @property string $description
 *
 * @property User $user
 */
class BuyRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'buy_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'min_price', 'max_price'], 'required'],
            [['user_id'], 'integer'],
            [['min_price', 'max_price'], 'number'],
            [['title', 'description'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'min_price' => 'Min Price',
            'max_price' => 'Max Price',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
