<?php

namespace app\models;

use Yii;
use yii\base\Model;

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
        //TODO
        
        //bulk data
        return [
            'cell phone' => [
                'minCost' => 45,
                'maxCost' => 700,
                'people' => 12,
            ],
            'laptop' => [
                'minCost' => 300,
                'maxCost' => 1300,
                'people' => 5,
            ],
            'person' => [
                'minCost' => 35000,
                'maxCost' => 1000000,
                'people' => 123,
            ],
        ];
    }
}
