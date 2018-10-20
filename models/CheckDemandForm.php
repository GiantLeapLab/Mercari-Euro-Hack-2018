<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * CheckDemandForm is the model behind the login form.
 *
 */
class CheckDemandForm extends Model
{
    public $classes = [];
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['classes'], 'required'],
            [['classes'], 'each', 'rule' => ['string', 'length' => [2, 255]]],
        ];
    }

    public function check() {
        $data = Category::find()
            ->select(['category.name as category_name', 'MIN(min_price) as minCost', 'MAX(max_price) as maxCost', 'COUNT(buy_request.id) as people'])
            ->where(['IN', 'category.name', $this->classes])
            ->groupBy('category.id')
            ->leftJoin('buy_request', 'category.id = buy_request.category_id')
            ->asArray()
            ->all();

        return ArrayHelper::index($data, 'category_name');
    }
}
