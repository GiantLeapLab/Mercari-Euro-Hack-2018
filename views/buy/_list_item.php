<?php
// _list_item.php
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var \app\models\BuyRequest $model
 * @var \app\models\ImageList $main_image
 */
?>

<div class="col-md-4 product">
    <div class="top">
        <?= Html::a(Html::encode(ucwords($model->title)), Url::toRoute(['buy/update', 'id' => $model->id]), ['title' => ucwords($model->title)])?>


    </div>
    <div class="center">
        <?php
            $image = '';
            if($index >= 0 && $index <=6) {
                $image = '/../image_gallery/laptops/laptop-'.($index+1).'.jpg';
            } else if ($index >=7 && $index <=8) {
                $image = '/../image_gallery/phones/phone-'.($index+1).'.jpg';
            }
        ?>
        <img src="<?= !empty($image) ? $image : '/../img/carousel-img.png' ?>" alt="image">
    </div>
    <div class="bottom">
        <div class="cost"><span class="cur">$</span><?= $model->min_price; ?>-<?= $model->max_price; ?></div>
        <div class="text">Expected price:</div>
    </div>
</div>

