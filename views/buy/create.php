<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\Models\BuyRequest */
/* @var $categories array */

$this->title = 'What would you like to buy?';
$this->params['breadcrumbs'][] = ['label' => 'Buy Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="buy-request-create">-->

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

<!--</div>-->
