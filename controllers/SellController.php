<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class SellController extends Controller
{
    public function init() 
    {
        parent::init();
        $this->enableCsrfValidation = false;
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionScan()
    {
        return $this->render('scan');
    }
    
    public function actionCheckDemand()
    {
        $model = new \app\models\CheckDemandForm();
        $model->load(Yii::$app->request->post());
        
        Yii::$app->response->format = 'json';
        
        return $model->check();
    }
    
    public function actionFindOffers($product)
    {
        $categoryId = Category::find()
            ->select('id')
            ->where(['name' => $product])
            ->scalar();

        if (!$categoryId) {
            throw new NotFoundHttpException();
        }

        $result = BuyRequest::find()
            ->select(['MIN(min_price) as min', 'MAX(max_price) as max', 'COUNT(id) as count'])
            ->where(['category_id' => $categoryId])
            ->asArray()
            ->one();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return $result;
    }
}
