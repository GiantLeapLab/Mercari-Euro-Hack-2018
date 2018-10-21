<?php
// _list_item.php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="col-md-4 product">
    <div class="top">
        <?= Html::a(Html::encode(ucwords($model->title)), Url::toRoute(['buy/update', 'id' => $model->id]), ['title' => ucwords($model->title)])?>

        <!--Html::encode(ucwords($model->title) ); -->
    </div>
    <div class="center">
        <img src="/../img/carousel-img.png" alt="image">
    </div>
    <div class="bottom">
        <div class="cost"><span class="cur">$</span><?= $model->min_price; ?>-<?= $model->max_price; ?></div>
        <div class="text">Expected price:</div>
    </div>
</div>

