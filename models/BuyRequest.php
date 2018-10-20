<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "buy_request".
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string $title
 * @property double $min_price
 * @property double $max_price
 * @property string $description
 * @property string $imageFile
 *
 * @property User $user
 */
class BuyRequest extends ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

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
            [['user_id', 'category_id'], 'integer'],
            [['min_price', 'max_price'], 'number'],
            [['title', 'description'], 'string', 'max' => 255],
            [['imageFile'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'category_id' => 'Product category',
            'title' => 'Product type',
            'min_price' => 'From',
            'max_price' => 'To',
            'description' => 'Additional details',
            'imageFile' => 'Upload your product picture if you have it',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
