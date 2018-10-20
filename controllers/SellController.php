<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

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
}
