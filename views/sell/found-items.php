<?php
/**
 * @var $this \yii\web\View
 * @var $models \app\models\SellRequest[]
 * @var $prices array
 */

use app\assets\AppThemeAsset;
use kartik\slider\Slider;
use yii\widgets\ActiveForm;

AppThemeAsset::register($this);

$form = ActiveForm::begin();
?>
<style>
    .found-items .row {
        margin-bottom: 0;
    }
    .found-items .form-group {
        margin-bottom: 0;
    }
    .found-items .sell-check input {
        width: 20px;
        height: 20px;
        margin: 0;
        vertical-align: middle;
    }
    .found-items .sell-check label {
        font-size: 18px;
    }
    .found-items .item {
        margin-bottom: 30px;
        border-bottom: 1px solid #ccc;
        padding-bottom: 20px;
    }
    .found-items .btn-primary {
        width: auto;
        margin: 0 auto;
        height: 54px;
    }
</style>
<h1>Choose items to sell and adjust their details</h1>
<div class="found-items">
    <?php
    foreach ($models as $index => $model) { ?>
        <div class="item">
            <div class="row">
                <?= $form->field($model,  '[' . $index . ']title', [
                    'options' => ['class' => 'col-md-6 required '],
                    'inputOptions' => ['class' => 'block']
                ]) ?>
                <div class="col-md-6 sell-check" style="margin-top: 30px;">
                    <?= $form->field($model, '[' . $index . ']sell')->checkbox() ?>
                </div>
            </div>
            <div class="row">
                <?= $form->field($model,  '[' . $index . ']description', [
                    'options' => ['class' => 'form-group col-md-12 required '],
                    'inputOptions' => ['class' => 'block']
                ]) ?>
            </div>
            <div class="row" style="padding: 0 15px;">
                <div class="form-group">
                    <label style="display: block;">Price</label>
                    <?php
                    $maxPrice = $prices[$model->title]['maxCost'] ? (int)($prices[$model->title]['maxCost'] * 1.3) : 300;
                    $minPrice = $prices[$model->title]['minCost'] ? (int)($prices[$model->title]['minCost'] * 2 / 3) : 0;
                    echo '<b class="badge">' . $minPrice . '</b> ' . Slider::widget([
                            'name' => 'price',
                            'sliderColor' => '#dce1e9',
                            'handleColor' => '#879cbe',
                            'pluginOptions' => [
                                'orientation' => 'horizontal',
                                'handle' => 'round',
                                'tooltip' => 'always',
                                'min' => $minPrice,
                                'max' => $maxPrice,
                                'step' => 1
                            ],
                        ]) . ' <b class="badge">' . $maxPrice . '</b>'; ?>
                </div>
            </div>
            <div class="row" style="padding: 0 15px;">
                <div class="form-group">
                    <label style="display: block;">Photo</label>
                    <img src="<?= $model->imageName ?>" style="display: block" />
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="row" style="text-align: center;">
        <button class="btn btn-primary btn-lg">Submit to marketplace</button>
    </div>
</div>
<?php
ActiveForm::end();

?>
