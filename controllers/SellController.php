<?php

namespace app\controllers;

use app\models\BuyRequest;
use app\models\Category;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class SellController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionScan()
    {
        return $this->render('scan');
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
