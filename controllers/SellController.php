<?php

namespace app\controllers;

use app\models\CheckDemandForm;
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
//        $model->load(Yii::$app->request->post());
        $model->classes = ['cup', 'car', 'boat'];

        Yii::$app->response->format = 'json';
        
        return $model->check();
    }
}
