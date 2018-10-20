<?php

use yii\helpers\Html;
use app\assets\AppThemeAsset;

AppThemeAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\Models\BuyRequest */

$this->title = 'Update Buy Request: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Buy Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="buy-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
