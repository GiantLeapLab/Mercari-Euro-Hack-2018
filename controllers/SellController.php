<?php

namespace app\controllers;

use app\models\CheckDemandForm;
use app\models\SellListForm;
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
        $model = new CheckDemandForm();
        $model->load(Yii::$app->request->post());

        Yii::$app->response->format = 'json';

        return $model->check();
    }

    public function actionStep2()
    {
        
        $model = new SellListForm();
        $model->load(Yii::$app->request->post());
        $models = $model->prepareData();

        return $this->render('found-items', [
            'models' => $models,
        ]);
    }
}
