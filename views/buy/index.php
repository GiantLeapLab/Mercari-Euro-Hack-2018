<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
//use yii\widgets\Pjax;
//use app\assets\AppThemeAsset;

app\assets\AppThemeAsset::register($this);

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Buy Requests';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buy-request-index content category">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php /*Pjax::begin(); */?>

    <p>
        <?= Html::a('Add', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'options' => [
            'tag' => false,
            'class' => 'list-wrapper',
            'id' => 'list-wrapper',
        ],
        'layout' => "{summary}\n<div class=\"row products\">{items}</div>\n{pager}",
        'itemView' => function ($model) {
            return $this->render('_list_item', ['model' => $model]);
        },
        'itemOptions' => [
                'tag' => false
        ]

    ]); ?>

    <?php /*Pjax::end(); */?>
</div>
