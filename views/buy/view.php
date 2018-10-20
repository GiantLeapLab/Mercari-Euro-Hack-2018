<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\assets\AppThemeAsset;

AppThemeAsset::register($this);
/* @var $this yii\web\View */
/* @var $model app\Models\BuyRequest */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Buy Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="buy-request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'title',
            'min_price',
            'max_price',
            'description',
            'category_id',
        ],
    ]) ?>

</div>
